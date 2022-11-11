<?php

namespace App\Http\Controllers;

use App\Models\Personal_access_tokens;
use App\Models\User;
use App\Models\user_transaction_history_table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\bank;

class UserController extends Controller
{
    //로그인 로직
    public function Auth_Check(Request $request)
    {
        $user_id = $request->input('user_id'); //사용자 아이디
        $user_password = $request->input('user_password'); //사용자 비밀번호

        if (empty($user_id) || empty($user_password)) {
            return Return_json('9999', 1, "입력되지 않은 항목이 있습니다.", 422, null);
        }

        if (!User::where('user_id', $user_id)->exists()) {
            return Return_json("9999", 1, "입력하신 정보를 다시 확인해주세요.", 422, null);
        }

        $user_password_sql = User::where('user_id', $user_id)->value('user_password'); //계정이 있다면 계정의 비밀번호를 가져옴

        if (Hash::check($user_password, $user_password_sql)) {
            $User_data = User::where('user_id', $user_id)->first(); //비밀번호가 일치하면 정보를 가져 온다.
            if ($User_data->user_state == 10) {
                return Return_json("9999", 1, "사용이 불가능한 계정입니다.", 422, null);
            }
        }

        if (!Personal_access_tokens::where('name', $User_data->identification)->exists()) {

            if ($User_data->user_state == 0) { //본사 일경우
                $Token = $User_data->createToken($User_data->identification, ['Auth:head'])->plainTextToken;
            } else if ($User_data->user_state == 1) { //지사 일경우
                $Token = $User_data->createToken($User_data->identification, ['Auth:branch'])->plainTextToken;
            } else if ($User_data->user_state == 2) { //가맹점 일경우
                $Token = $User_data->createToken($User_data->identification, ['Auth:franchisee'])->plainTextToken;
            }

        } else {
            $User_data->tokens()->where('name', $User_data->identification)->delete();

            if ($User_data->user_state == 0) { //본사 일경우
                $Token = $User_data->createToken($User_data->identification, ['Auth:head'])->plainTextToken;
            } else if ($User_data->user_state == 1) { //지사 일경우
                $Token = $User_data->createToken($User_data->identification, ['Auth:branch'])->plainTextToken;
            } else if ($User_data->user_state == 2) { //가맹점 일경우
                $Token = $User_data->createToken($User_data->identification, ['Auth:franchisee'])->plainTextToken;
            }

        }
        $HToken = base_64_end_code_en($User_data->identification, _key_, _iv_);

        return Return_json("0000", 0, "로그인 정상", 200, ['XToken' => $Token, 'HToken' => $HToken, 'user_name' => $User_data->user_name]);

    }

    //대시보드
    public function Index(Request $request)
    {
        $HToken = base_64_end_code_de($_COOKIE['H-Token'], _key_, _iv_); //헤더 H토큰 식별값  sha256암호화 한것 디코딩
        if (session('state') == 2) {
            $today_C = user_transaction_history_table::where([['identification', $HToken], ['trxtype', 'CO']])
                ->whereBetween('date_ymd',
                    [
                        date('Y-m-d'),
                        date('Y-m-d'),
                    ])
                ->sum('amount');
            $today_S = user_transaction_history_table::where([['identification', $HToken], ['trxtype', 'SO']])
                ->whereBetween('date_ymd',
                    [
                        date('Y-m-d'),
                        date('Y-m-d'),
                    ])
                ->sum('amount');
            $beforeDay = date("Y-m-d", strtotime(date(('Y-m-d')) . " -1 day"));
            $beforeDay_C = user_transaction_history_table::where([['identification', $HToken], ['trxtype', 'CO']])
                ->whereBetween('date_ymd',
                    [
                        $beforeDay,
                        $beforeDay,
                    ])
                ->sum('amount');
            if (user_transaction_history_table::where([['identification', $HToken]])->whereBetween('date_ymd', [date('Y-m-d'), date('Y-m-d')])->exists()) {
                $data = user_transaction_history_table::where([['identification', $HToken]])
                    ->whereBetween('date_ymd',
                        [
                            date('Y-m-d'),
                            date('Y-m-d'),
                        ])
                    ->select('id', 'tradeNumber', 'trxtype', 'company_name', 'user_name', 'virtual_account', 'amount', 'balance', 'date_ymd', 'date_time')
                    ->orderBy('id', 'desc')
                    ->limit(20)
                    ->get();
            } else {
                $data = null;
            }

            $user_money = User::where('identification', $HToken)->value('money'); //사용자 정보 불러오기
            return view('welcome', ['today_C' => $today_C, 'today_S' => $today_S, 'beforeDay_C' => $beforeDay_C, 'money' => $user_money, 'data' => $data]);
        } elseif (session('state') == 1) {
            $user_count = User::where('pk_id', $HToken)->count();
            $today_C = user_transaction_history_table::where([['pk_id', $HToken], ['trxtype', 'CO']])
                ->whereBetween('date_ymd',
                    [
                        date('Y-m-d'),
                        date('Y-m-d'),
                    ])
                ->sum('amount');
            $beforeDay = date("Y-m-d", strtotime(date(('Y-m-d')) . " -1 day"));
            $beforeDay_C = user_transaction_history_table::where([['pk_id', $HToken], ['trxtype', 'CO']])
                ->whereBetween('date_ymd',
                    [
                        $beforeDay,
                        $beforeDay,
                    ])
                ->sum('amount');
            if (user_transaction_history_table::where([['pk_id', $HToken]])->whereBetween('date_ymd', [date('Y-m-d'), date('Y-m-d')])->exists()) {
                $data = user_transaction_history_table::where([['pk_id', $HToken]])
                    ->whereBetween('date_ymd',
                        [
                            date('Y-m-d'),
                            date('Y-m-d'),
                        ])
                    ->select('id', 'tradeNumber', 'trxtype', 'company_name', 'user_name', 'virtual_account', 'amount', 'balance', 'date_ymd', 'date_time')
                    ->orderBy('id', 'desc')
                    ->limit(20)
                    ->get();
            } else {
                $data = null;
            }

            $user_money = User::where('identification', $HToken)->value('money'); //사용자 정보 불러오기
            return view('welcome', ['today_C' => $today_C, 'user_count' => $user_count, 'beforeDay_C' => $beforeDay_C, 'money' => $user_money, 'data' => $data]);
        } elseif (session('state') == 0) {

            $user_count = User::where('user_state', '1')->count();
            $user_count2 = User::where('user_state', '2')->count()
            ;
            $today_C = user_transaction_history_table::where([['trxtype', 'CO']])
                ->whereBetween('date_ymd',
                    [
                        date('Y-m-d'),
                        date('Y-m-d'),
                    ])
                ->sum('amount');
            $beforeDay = date("Y-m-d", strtotime(date(('Y-m-d')) . " -1 day"));
            $beforeDay_C = user_transaction_history_table::where([['trxtype', 'CO']])
                ->whereBetween('date_ymd',
                    [
                        $beforeDay,
                        $beforeDay,
                    ])
                ->sum('amount');
            if (user_transaction_history_table::whereBetween('date_ymd', [date('Y-m-d'), date('Y-m-d')])->exists()) {
                $data = user_transaction_history_table::whereBetween('date_ymd',
                    [
                        date('Y-m-d'),
                        date('Y-m-d'),
                    ])
                    ->select('id', 'tradeNumber', 'trxtype', 'company_name', 'user_name', 'virtual_account', 'amount', 'balance', 'date_ymd', 'date_time')
                    ->orderBy('id', 'desc')
                    ->limit(20)
                    ->get();
            } else {
                $data = null;
            }

            $user_money = User::where('identification', $HToken)->value('money'); //사용자 정보 불러오기

            return view('welcome', ['today_C' => $today_C, 'user_count' => $user_count, 'user_count2' => $user_count2, 'beforeDay_C' => $beforeDay_C, 'money' => $user_money, 'data' => $data]);
        }

    }

    //거래내역
    public function transaction_history(Request $request)
    {
        $HToken = base_64_end_code_de($_COOKIE['H-Token'], _key_, _iv_); //헤더 H토큰 식별값  sha256암호화 한것 디코딩
        $user_data = User::where('identification', $HToken)->first(); //사용자 정보 불러오기

        if (empty($_GET['start_date']) || empty($_GET['end_date'])) {
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d');
        } else {
            $start_date = $_GET['start_date'];
            $end_date = $_GET['end_date'];
        }

        //가맹점 조회시
        if (session('state') == 2) {
            $exits = user_transaction_history_table::where([['identification', $HToken]])->whereBetween('date_ymd', [$start_date, $end_date])->first();
            if ($exits) {
                $data = user_transaction_history_table::where([['identification', $HToken]])
                    ->whereBetween('date_ymd',
                        [
                            $start_date,
                            $end_date,
                        ])
                    ->select('id', 'tradeNumber', 'trxtype', 'company_name', 'user_name', 'virtual_account', 'amount', 'balance', 'date_ymd', 'date_time')
                    ->orderBy('id', 'desc')
                    ->get();
                return view('transaction_history', ['history' => $data]);
            } else {
                return view('transaction_history', ['history' => null]);
            }
        } elseif (session('state') == 1) {
            $exits = user_transaction_history_table::where([['pk_id', $HToken]])->whereBetween('date_ymd', [$start_date, $end_date])->first();
            if ($exits) {
                $data = user_transaction_history_table::where([['pk_id', $HToken]])
                    ->whereBetween('date_ymd',
                        [
                            $start_date,
                            $end_date,
                        ])
                    ->select('id', 'tradeNumber', 'trxtype', 'company_name', 'user_name', 'virtual_account', 'amount', 'balance', 'date_ymd', 'date_time')
                    ->orderBy('id', 'desc')
                    ->get();
                return view('transaction_history', ['history' => $data]);
            } else {
                return view('transaction_history', ['history' => null]);
            }

        } elseif (session('state') == 0) {
            $exits = user_transaction_history_table::whereBetween('date_ymd', [$start_date, $end_date])->first();
            if ($exits) {
                $data = user_transaction_history_table::whereBetween('date_ymd',
                    [
                        $start_date,
                        $end_date,
                    ])
                    ->select('id', 'tradeNumber', 'trxtype', 'company_name', 'user_name', 'virtual_account', 'amount', 'balance', 'date_ymd', 'date_time')
                    ->orderBy('id', 'desc')
                    ->get();
                return view('transaction_history', ['history' => $data]);
            } else {
                return view('transaction_history', ['history' => null]);
            }

        }

    }

    //출금 페이지
    public function remittance(Request $request)
    {
        $HToken = base_64_end_code_de($_COOKIE['H-Token'], _key_, _iv_); //헤더 H토큰 식별값  sha256암호화 한것 디코딩
        $user_data = User::where('identification', $HToken)->value('money'); //사용자 정보 불러오기

        return view('remittance', ['money' => $user_data]);
    }

    //가맹점 리스트
    public function franchisees(Request $request)
    {
        if (session('state') == 1) {
            $HToken = base_64_end_code_de($_COOKIE['H-Token'], _key_, _iv_); //헤더 H토큰 식별값  sha256암호화 한것 디코딩
            if (User::where('pk_id', $HToken)->exists()) {
                $Users = User::where('pk_id', $HToken)->get();
                foreach ($Users as $row) {
                    $row['pk_name'] = User::where('identification', $row->pk_id)->value('user_name');
                }
                return view('franchisees', ['Data' => $Users]);

            } else {
                return view('franchisees', ['Data' => null]);
            }
        } elseif (session('state') == 0) {
            $HToken = base_64_end_code_de($_COOKIE['H-Token'], _key_, _iv_); //헤더 H토큰 식별값  sha256암호화 한것 디코딩
            if (User::where([['user_state', '2']])->exists()) {
                $Users = User::where('user_state', '2')->get();
                foreach ($Users as $row) {
                    $row['pk_name'] = User::where('identification', $row->pk_id)->value('user_name');
                }
                return view('franchisees', ['Data' => $Users]);

            } else {
                return view('franchisees', ['Data' => null]);
            }
        }

    }

    //지사 리스트
    public function branchs(Request $request)
    {
        if (session('state') == 0) {
            $HToken = base_64_end_code_de($_COOKIE['H-Token'], _key_, _iv_); //헤더 H토큰 식별값  sha256암호화 한것 디코딩
            if (User::where([['user_state', '1']])->exists()) {
                $Users = User::where('user_state', '1')->get();
                foreach ($Users as $row) {
                    $row['count'] = User::where('pk_id', $row->pk_id)->count();
                }
                return view('branchs', ['Data' => $Users]);

            } else {
                return view('branchs', ['Data' => null]);
            }
        }
    }

    //계좌 수정 등록
    public function Bank_edit (Request $request){
        if(session('state') == 0){
            $data = bank::where('id','1')->first();
            return view('bank_edit',['data'=>$data]);
        }
    }


    //충전 페이자
    public function charge (Request $request){

            $data = bank::where('id','1')->first();
            return view('charge',['data'=>$data]);

    }



} //클래스 끝
