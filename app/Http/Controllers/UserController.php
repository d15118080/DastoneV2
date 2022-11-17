<?php

namespace App\Http\Controllers;

use App\Models\bank;
use App\Models\Personal_access_tokens;
use App\Models\User;
use App\Models\user_transaction_history_table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
                    $row['count'] = User::where('pk_id', $row->identification)->count();
                }
                return view('branchs', ['Data' => $Users]);

            } else {
                return view('branchs', ['Data' => null]);
            }
        }
    }

    //계좌 수정 등록 페이지
    public function Bank_edit(Request $request)
    {
        if (session('state') == 0) {
            $data = bank::where('id', '1')->first();
            return view('bank_edit', ['data' => $data]);
        }
    }

    //계좌 수정 등록
    public function Bank_edit_req(Request $request)
    {
        if (session('state') == 0) {
            $bank_name = $request->bank_name;
            $bank_number = $request->bank_number;
            bank::where('id', 1)->update(['bank_name' => $bank_name]);
            bank::where('id', 1)->update(['bank_number' => $bank_number]);
            return redirect('/bank_edit');
        }
    }

    //충전 페이자
    public function charge(Request $request)
    {

        $data = bank::where('id', '1')->first();
        return view('charge', ['data' => $data]);

    }

    //가맹점 추가 페이지
    public function franchisees_add(Request $request)
    {
        $branchs = User::where('user_state', 1)->get();
        return view('franchisees_or_branch_add', ['mode' => 0, 'branchs' => $branchs]);
    }

    //가맹점 추가 로직
    public function franchisees_add_req(Request $request)
    {
        $pk_id = $request->pk_id; //연결 할 지사
        $user_name = $request->user_name; //가맹점 이름
        $user_id = $request->user_id;
        $user_password = $request->user_password; //가맹점 비밀번호
        $user_margin = $request->user_margin; //가맹점 마진

        if ($pk_id == "") {
            return Return_json("9999", 1, "연결할 지사를 선택해주세요.", 422, null);
        }
        if ($user_name == "") {
            return Return_json("9999", 1, "가맹점 이름을 ₩입력해주세요.", 422, null);
        }
        if ($user_password == "") {
            return Return_json("9999", 1, "가맹점 비밀번호 를 입력해주세요.", 422, null);
        }

        if ($user_margin == "") {
            return Return_json("9999", 1, "가맹점 마진을 입력해주세요.", 422, null);
        }
        if ($user_id == "") {
            return Return_json("9999", 1, "가맹점 아이디를 입력해주세요.", 422, null);
        }

        if (User::where('user_id', $user_id)->exists()) {
            return Return_json("9999", 1, "사용할수 없는 아이디 입니다.", 422, null);
        }

        User::insert([
            'fk_id' => '',
            'pk_id' => $pk_id,
            'ck_id' => get_uuid_v3(),
            'identification' => get_uuid_v4(),
            'user_id' => $user_id,
            'user_password' => Hash::make($user_password),
            'user_name' => $user_name,
            'user_state' => 2,
            'user_margin' => $user_margin / 100,
            'user_reg_date' => date('Y-m-d'),
            'user_reg_time' => date('H:i:s'),
            'money' => 0,
        ]);
        return Return_json("0000", 1, "가맹점 생성이 완료 되었습니다.", 200, null);

    }

    //지사 추가 로직
    public function branchs_add_req(Request $request)
    {
        $user_name = $request->user_name; //지사 이름
        $user_id = $request->user_id;
        $user_password = $request->user_password; //지사 비밀번호
        $user_margin = $request->user_margin; //지사 마진

        if ($user_name == "") {
            return Return_json("9999", 1, "지사 이름을 입력해주세요.", 422, null);
        }
        if ($user_password == "") {
            return Return_json("9999", 1, "지사 비밀번호 를 입력해주세요.", 422, null);
        }

        if ($user_margin == "") {
            return Return_json("9999", 1, "지사 마진을 입력해주세요.", 422, null);
        }
        if ($user_id == "") {
            return Return_json("9999", 1, "지사 아이디를 입력해주세요.", 422, null);
        }

        if (User::where('user_id', $user_id)->exists()) {
            return Return_json("9999", 1, "사용할수 없는 아이디 입니다.", 422, null);
        }

        User::insert([
            'fk_id' => 'DS_7b0d4a37-5552-49f1-9cfb-a466',
            'pk_id' => '',
            'ck_id' => get_uuid_v3(),
            'identification' => get_uuid_v4(),
            'user_id' => $user_id,
            'user_password' => Hash::make($user_password),
            'user_name' => $user_name,
            'user_state' => 1,
            'user_margin' => $user_margin / 100,
            'user_reg_date' => date('Y-m-d'),
            'user_reg_time' => date('H:i:s'),
            'money' => 0,
        ]);
        return Return_json("0000", 1, "지사 생성이 완료 되었습니다.", 200, null);

    }

    //유저 거래 상태변경
    public function user_state_change(Request $request)
    {
        $mode = $_GET['mode'];
        $s = $_GET['s']; //가맹점인지 지사인지
        $id = $_GET['id'];

        if ($mode == 1) { //차단
            if ($s == 2) {
                User::where('id', $id)->update(['state' => 10]);
                return redirect('/franchisees');
            } else {
                User::where('id', $id)->update(['state' => 10]);
                return redirect('/branchs');
            }

        } elseif ($mode == 0) {
            //가맹점
            if ($s == 2) {
                User::where('id', $id)->update(['state' => 0]);
                return redirect('/franchisees');
                //지사
            } elseif ($s == 1) {
                User::where('id', $id)->update(['state' => 0]);
                return redirect('/franchisees');
            }

        }

    }

} //클래스 끝
