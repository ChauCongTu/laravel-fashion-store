<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function handle(UserRequest $request)
    {
        $user = $request->except('_token');
        $user['password'] = Hash::make($request->password);
        $rs = User::create($user);
        $user_reg = User::find($rs->id);
        Auth::login($user_reg);
        Mail::send('email.new', [], function ($message) use ($request){
            $message->from('no-reply@nzfashion.com', 'NZ Fashion');
            $message->to($request->email);
            $message->subject('Chào mừng '.$request->name.' đến với NZ Fashion');
        });
        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }
}
