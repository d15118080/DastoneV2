<?php

namespace App\Http\Controllers;

use App\Models\deposit;
use App\Models\Telegarm_set;
use App\Models\User;
use App\Models\user_transaction_history_table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RTPay;

class TransactionController extends Controller
{
    //거래 기록

    //충전 요청
    public function Charge_Request(Request $request)
    {

        if (!$request->user()->tokenCan('Auth:franchisee')) {
            return Return_json('9999', 1, "잘못된 접근입니다.", 422, null);
        }
        $data = $request->data;
        if ($data = null || empty($data)) {
            return Return_json('9999', 1, "값이 존재하지 않습니다.", 422, null);
        }

        foreach ($request->data as $row){
            if(deposit::where([['user_name',$row['bank_user']],['money',$row['money']]])->exists()){
                Telegram_send('1878145914', "입금자 존재함");
            }
        }
        // $pk_id = User::where('identification', $request->user()->identification)->value('pk_id');
        // $user_name = $request->user()->user_name;
        // if (Telegarm_set::where('ck_id', 'admin')->exists()) {
        //     $chat_id = Telegarm_set::where('ck_id', 'admin')->value('chat_id');
        //     Telegram_send($chat_id, "*[다스톤 충전 요청]*\n*거래 요청점* : $user_name\n관리자에서 확인해주세요.");
        // }

        // foreach ($request->data as $row) {
        //     DB::beginTransaction();

        //     $insert = user_transaction_history_table::insert([
        //         'pk_id' => $pk_id,
        //         'identification' => $request->user()->identification,
        //         'tradeNumber' => get_uuid_v1(),
        //         'trxtype' => "CS",
        //         'user_name' => $row['bank_user'],
        //         'virtual_account' => "A",
        //         'amount' => $row['money'],
        //         'balance' => "충전신청시 측정불가",
        //         'date_ymd' => date('Y-m-d'),
        //         'date_time' => date('H:i:s'),
        //         'company_name' => $request->user()->user_name,
        //     ]);
        //     if ($insert) {
        //         DB::commit();
        //     }
        // }

        return Return_json('0000', 1, "정상처리", 200, null);
    }

    //예금주 확인
    public function Bank_Check(Request $request)
    {

        $bank_code = $request->input('bank_code');
        $bank_number = $request->input('bank_number');
        $user_name = $request->input('bank_user');
        $money = $request->input('money');

        $data = json_encode(['accnt' => [
            "account" => $bank_number,
            "bankCd" => $bank_code,
        ],
        ]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://svcapi.mtouch.com/api/settle/accnt',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: pk_e64f-4900fb-c35-ea436',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $res = json_decode($response);
        $res_data = ['user_name' => $res->accnt->holder, 'money' => number_format($money), 'bankName' => $res->accnt->bankName];
        if ($res->result->resultCd != "0000") {
            return Return_json('9999', 1, $res->result->advanceMsg, 422, null);
        }

        return Return_json('0000', 0, "조회 완료", 200, $res_data);

    }

    //출금 요청
    public function Remittance_Request(Request $request)
    {

        if (!$request->user()->tokenCan('Auth:franchisee')) {
            return Return_json('9999', 1, "잘못된 접근입니다.", 422, null);
        }
        $data = $request->data;
        if ($data = null || empty($data)) {
            return Return_json('9999', 1, "값이 존재하지 않습니다.", 422, null);
        }
        $pk_id = User::where('identification', $request->user()->identification)->value('pk_id');
        $money = User::where('identification', $request->user()->identification)->value('money');
        $user_name = User::where('identification', $request->user()->identification)->value('user_name');

        if (User::where('identification', $request->user()->identification)->value('state') == 10) {
            return Return_json('9999', 1, "거래 할수없는 계정입니다.", 422, null);
        }
        $r_m = 0;
        foreach ($request->data as $row) {
            $r_m = $r_m + $row['money'];
        }
        $up_money = $money - $r_m;

        if ($money < $r_m) {
            return Return_json('9999', 1, "출금 가능액 보다 클수없습니다 현재 출금하려는 금액은 " . number_format($r_m) . " 원 입니다", 400, null);
        }

        foreach ($request->data as $row) {
            DB::beginTransaction();
            $bank_number = $row['bank_number'];
            $bank_name = $row['bank_name'];
            $money = $money - $row['money'];
            $insert = user_transaction_history_table::insert([
                'pk_id' => $pk_id,
                'identification' => $request->user()->identification,
                'tradeNumber' => get_uuid_v1(),
                'trxtype' => "SS",
                'user_name' => $row['bank_user'] . "(은행: $bank_name 계좌: $bank_number)",
                'virtual_account' => "S",
                'amount' => $row['money'],
                'balance' => $money,
                'date_ymd' => date('Y-m-d'),
                'date_time' => date('H:i:s'),
                'company_name' => $request->user()->user_name,
            ]);
            if ($insert) {
                DB::commit();
            } else {
                DB::rollBack();
                return Return_json('9999', 1, "데이터 오류 가 발생하였습니다.", 400, null);
            }
        }

        if (Telegarm_set::where('ck_id', 'admin')->exists()) {
            $chat_id = Telegarm_set::where('ck_id', 'admin')->value('chat_id');
            Telegram_send($chat_id, "*[다스톤 출금요청]*\n*거래 요청점* : $user_name\n출금요청 을 하였습니다 관리자에서 확인해주세요.");
        }

        User::where('identification', $request->user()->identification)->update(['money' => $up_money]);
        return Return_json('0000', 1, "정상처리", 200, null);
    }

    public function management_list(Request $request)
    {
        $data = user_transaction_history_table::where('trxtype', 'CS')->orWhere('trxtype', 'SS')
            ->whereBetween('date_ymd',
                [
                    date('Y-m-d'),
                    date('Y-m-d'),
                ])
            ->select('id', 'tradeNumber', 'trxtype', 'company_name', 'user_name', 'virtual_account', 'amount', 'balance', 'date_ymd', 'date_time')
            ->orderBy('id', 'desc')
            ->get();

        return view('charge_state_change', ['data' => $data]);
    }

    public function state_change(Request $request)
    {
        $mode = $_GET['mode'];
        $id = $_GET['id'];

        if ($mode == 1) {
            $data = user_transaction_history_table::where('id', $id)->first();
            if ($data->trxtype == "CS") {
                user_transaction_history_table::where('id', $id)->update(['trxtype' => 'CX']);
                return redirect('/management');
            } elseif ($data->trxtype == "SS") {
                user_transaction_history_table::where('id', $id)->update(['trxtype' => 'SX']);
                $up_money = $data->amount + User::where('identification', $data->identification)->value('money');
                User::where('identification', $data->identification)->update(['money' => $up_money]);
                return redirect('/management');
            }
        } elseif ($mode == 0) {
            $data = user_transaction_history_table::where('id', $id)->first();
            if ($data->trxtype == "CS") {
                user_transaction_history_table::where('id', $id)->update(['trxtype' => 'CO']);
                $f_mar = User::where('identification', $data->identification)->value('user_margin'); //가맹점 마진
                $pk_id = User::where('identification', $data->identification)->value('pk_id'); //가맹점 연결 지사
                $p_mar = User::where('identification', $pk_id)->value('user_margin'); //지사 마진

                $f_money_re = $data->amount * $f_mar; // 가맹점 수수료 빼기
                $f_money = $data->amount - $f_money_re; //가맹점 실 적립 금액

                $p_money_re = $data->amount * $p_mar; // 지사 수수료 (본사에게 올려줘야 할것)
                $p_money = $f_money_re - $p_money_re; //실 지사 적립금

                //가맹점 금액 업데이트
                $up_money = $f_money + User::where('identification', $data->identification)->value('money');
                User::where('identification', $data->identification)->update(['money' => $up_money]);
                $f_ck_id = User::where('identification', $data->identification)->value('ck_id'); //가맹점 키
                if (Telegarm_set::where('ck_id', $f_ck_id)->exists()) {
                    $chat_id = Telegarm_set::where('ck_id', $f_ck_id)->value('chat_id');
                    $money_nu = number_format($data->amount);
                    $up_money_nu = number_format($up_money);
                    $f_money_re_nu = number_format($f_money_re);
                    Telegram_send($chat_id, "*[다스톤 충전완료]*\n*입금자* : $data->user_name\n*입금 금액* : $money_nu 원\n*수수료*:$f_money_re_nu 원\n*입금후 잔액* : $up_money_nu 원");
                }

                //지사 금액 업데이트
                $up_money = $p_money + User::where('identification', $pk_id)->value('money');
                User::where('identification', $pk_id)->update(['money' => $up_money]);
                $p_ck_id = User::where('identification', $pk_id)->value('ck_id'); //지사 키
                if (Telegarm_set::where('ck_id', $p_ck_id)->exists()) {
                    $f_name = User::where('identification', $data->identification)->value('user_name'); //가맹점 이름
                    $chat_id = Telegarm_set::where('ck_id', $f_ck_id)->value('chat_id');
                    $money_nu = number_format($data->amount);
                    $p_money_nu = number_format($p_money);
                    $up_money_nu = number_format($up_money);
                    Telegram_send($chat_id, "*[다스톤 수수료 정산]*\n*거래 가맹점* : $f_name\n*거래 금액* : $money_nu 원\n*거래 수수료* : $p_money_nu 원\n*수수료 정산후 잔액* : $up_money_nu 원");
                }

                //본시 금액 업데이트
                $up_money = $p_money_re + User::where('identification', 'DS_7b0d4a37-5552-49f1-9cfb-a466')->value('money');
                User::where('identification', 'DS_7b0d4a37-5552-49f1-9cfb-a466')->update(['money' => $up_money]);
                $e_ck_id = User::where('identification', 'DS_7b0d4a37-5552-49f1-9cfb-a466')->value('ck_id'); //본사 키
                if (Telegarm_set::where('ck_id', $e_ck_id)->exists()) {
                    $p_name = User::where('identification', $pk_id)->value('user_name'); //지사 이름
                    $chat_id = Telegarm_set::where('ck_id', $f_ck_id)->value('chat_id');
                    $money_nu = number_format($data->amount);
                    $p_money_nu = number_format($p_money_re);
                    $up_money_nu = number_format($up_money);
                    Telegram_send($chat_id, "*[다스톤 수수료 정산]*\n*거래 지사* : $p_name\n*거래 금액* : $money_nu 원\n*거래 수수료* : $p_money_nu 원\n*수수료 정산후 잔액* : $up_money_nu 원");
                }

                return redirect('/management');
            } elseif ($data->trxtype == "SS") {
                user_transaction_history_table::where('id', $id)->update(['trxtype' => 'SO']);
                return redirect('/management');
            }

        }

    }
    public function Payment_noti(Request $request)
    {

        $RTPay= new RTPay;
        $RTPay->RTP_KEY = "a543e7ab-534d-40c1-9f9c-a786bbd09933"; //인증키값 설정

        $resultArray = array();
        $resultArray['PCHK'] = "NO";

        if ($_POST['regPkey'] == $RTPay->RTP_KEY) {
            if ($RTPay->checkCURL()) {
                if ($_POST['ugrd'] < 20) {
                    $RTPay->RTP_URL = "https://rtpay.net/CheckPay/test_checkpay.php";
                } else {
                    $RTPay->RTP_URL = "https://rtpay.net/CheckPay/checkpay.php";
                }

                $retRTP = $RTPay->getRTPay();

                if ($retRTP->RCODE == '200') {
                    $pbank = $retRTP->RBANK; //은행명
                    $pname = $retRTP->RNAME; //입금자명
                    $pmoney = $retRTP->RPAY; //입금금액
                    $tall = $retRTP->RTEXT; //전송 데이터 전문

                    deposit::insert([
                        'user_name'=>$pname,
                        'money'=>$pmoney,
                        'state'=>0,
                        'date_ymd'=>date('Y-m-d'),
                        'date_time'=>date('H:i:s')
                    ]);
                    $resultArray['PCHK'] = "OK";
                    //========================== 인증키값 설정과 이 부분만 고쳐주세요. =======================

                    //입금신청을 기록하신 기존 DB 데이터와 비교하는 코드 입력부분
                    //입금자명과 금액이 일치하는 갯수를 비교하여 한개 이상이면 입금완료 처리 보류

                    //입금데이터와 비교하여 매칭이 되었을 경우 $resultArray['PCHK'] =  "OK";
                    //입금데이터와 비교하여 매칭이 되지 않았을 경우 $resultArray['PCHK'] =  "NO";

                    //========================== 인증키값 설정과 이 부분만 고쳐주세요. =======================
                }

                $resultArray['RCODE'] = $retRTP->RCODE;
            } else {
                $resultArray['RCODE'] = "300";
            }
        } else {
            if (!$_POST['regPkey']) {
                $_POST['regPkey'] = $RTPay->RTP_KEY;
                $RTPay->RTP_URL = "https://rtpay.net/CheckPay/setPurl.php";
                $retRTP = $RTPay->getRTPay();
            }
            $resultArray['RCODE'] = "400";
        }

        echo json_encode($resultArray);

    }
}
