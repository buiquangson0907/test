<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Auth;
use Validator;
class AuthAdminController extends Controller
{
    public function getLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin');
        } else {
            return view('admin.login');
        }
    }
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'txtEmail' => 'required',
            'txtPassword' => 'required'
        ],[
            'txtEmail.required' => 'Vui lòng nhập email',
            'txtPassword.required' => 'Vui lòng nhập password'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $login = [
            'email' => $request->txtEmail,
            'password' => $request->txtPassword,
            'status' => 1
        ];
        if (Auth::guard('admin')->attempt($login)) {
            return redirect('/admin');
        } else {
            return redirect()->back()->with('error', 'Email hoặc Password không chính xác');
        }
    }
    public function getLogout()
    {
        session()->forget('key');
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
