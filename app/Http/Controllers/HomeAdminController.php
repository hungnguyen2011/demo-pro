<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Mail;
use Str;
use Auth;

class HomeAdminController extends Controller
{

    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $req)
    {
        $data = [
            'email' => $req->email,
            'password' => $req->password,
            'type' => 1,
        ];
        if (Auth::attempt($data)) {
            return redirect()->route('admin.list');
        }    
        else {
            return redirect()->back()->with('message','Mật khẩu hoặc email không đúng.Vui lòng thử lại');
        }
    }

    public function logout(Request $req)
    {
        if (Auth::check()) {
            Auth::logout();
            return view('admin.login');
        }
    }

    public function index()
    {
    	$users = UserRepository::allUser();
    	return view('admin.user.list',compact('users'));
    }

    public function add()
    {
    	return view('admin.user.add');
    }

    public function addUser(Request $req)
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

        return redirect()->route('admin.list')->with('message','Bạn đã thêm thành công');
    }

    public function checkExistedMail(Request $request)
    {
        return response()->json(UserRepository::checkMail($request));
    }

    public function edit($id)
    {
    	$user = UserRepository::findUser($id);
    	return view('admin.user.edit',compact('user'));
    }

    public function editUser(Request $req,$id)
    {
    	UserRepository::findUser($id)->update($req->all());
    	return redirect()->route('admin.list')->with('message','Bạn đã sửa thành công');
    }

    public function deleteUser($id)
    {
    	UserRepository::findUser($id)->delete();
    	return redirect()->back()->with('message','Bạn đã xóa thành công');
    }

}
