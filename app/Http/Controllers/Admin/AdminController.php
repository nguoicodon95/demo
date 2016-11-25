<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class AdminController extends Controller
{
    use AuthenticatesUsers;
    use SendsPasswordResetEmails;

    protected $redirectTo = '/admin';

    protected $guard = 'dev';
    protected $broker = 'members';

    public function __construct()
    {
        $this->middleware("guest:$this->guard", ['except' => 'logout']);
    }

    public function showLoginForm () {
    	return view('auth.admin.login');
    }

    protected function validateLogin(Request $request)
    {
    	$messages = [
            'required' => 'Vui lòng :attribute không được để trống.',
            'email' => 'Vui lòng nhập địa chỉ E-mail.',
        ];

        $this->validate($request, [
            $this->username() => ['required', 'email'],
            'password' => 'required',
        ], $messages);
    }

    public function logout(Request $request) {
        Auth::guard($this->guard)->logout();

        return redirect()->route('admin.login');
    }

    protected function guard() {
        return Auth::guard($this->guard);
    }

     public function broker()
    {
        return Password::broker($this->broker);
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }


}
