<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_transaction_history_table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $pk_id = User::where('identification', $request->user()->identification)->value('pk_id');
        foreach ($request->data as $row) {
            DB::beginTransaction();

            $insert = user_transaction_history_table::insert([
                'pk_id' => $pk_id,
                'identification' => $request->user()->identification,
                'tradeNumber' => get_uuid_v1(),
                'trxtype' => "CS",
                'user_name' => $row['bank_user'],
                'virtual_account' => "A",
                'amount' => $row['money'],
                'balance' => "충전신청시 측정불가",
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
                $up_money = $data->amount + User::where('identification', $data->identification)->value('money');
                User::where('identification', $data->identification)->update(['money' => $up_money]);
                return redirect('/management');
            } elseif ($data->trxtype == "SS") {
                user_transaction_history_table::where('id', $id)->update(['trxtype' => 'SO']);
                return redirect('/management');
            }

        }

    }
}
