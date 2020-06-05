<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use Illuminate\Support\Str;
use Mail;

class HomeController extends Controller
{
    public function index()
    {
    	return view('web.login.recomend');
    }

    public function showLogin()
    {
    	return view('web.login.login');
    }

    public function login(Request $req)
    {
        $data = [
            'email' => $req->email,
            'password' => $req->password,
            'type' => 2,
        ];
        if (Auth::attempt($data)) {
            return redirect()->route('user.infor',Auth::user()->id);
        }    
        else {
            return redirect()->back()->with('message','Mật khẩu hoặc email không đúng.Vui lòng thử lại');
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return view('web.login.login');
        }
    }

    public function showSignUp()
    {
    	return view('web.login.sign-up');
    }

    public function signUp(Request $req)
    {
        $pass = Str::random(10);
        $pass_bcr = bcrypt($pass);
        $email = $req->email;
        $data = array_merge($req->all(), ["password" => $pass]);
        Mail::send('web.login.sendPassword',$data,function($msg)use ($email){
            $msg->from('projectdemohung@gmail.com');
            $msg->to($email)->subject("Mật khẩu tài khoản Hoctot.com");
        });
        $data_bcr = array_merge($req->all(), ["password" => $pass_bcr]);
        UserRepository::createUser($data_bcr);

        return redirect()->back()->with('message','Bạn đã đăng kí thành công');
    }

    public function introduce()
    {
        return view('web.login.introduce');
    }

    public function showInfor($id)
    {
        return view('web.login.infor');
    }
}
