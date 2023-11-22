<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\ResetPasswordRequest;
use Illuminate\Support\Facades\Session;
class ForgotController extends Controller
{
    public function forgotPassword(){
        return view('screens.frontend.auth.forgot-password');
    }

    public function processForgotPassword(Request $request){
        // dd($request->all());
        $rule = [
            'email' => 'required|email',
            
        ];
        $messages = [
            'email.required' => 'Email không được để chống',
            'email.email' => 'Không đúng định dạng email'
        ];
        $request->validate($rule,$messages);
        $user = User::where('email', $request->email)->first();
        if(!empty($user)){
            $passwordReset = PasswordReset::updateOrCreate([
                'email' => $user->email,
                'token' => Str::random(60),
                'created_at' => Carbon::now(),
            ],
            // [
            //     'token' => Str::random(60),
            // ]
            );


            if ($passwordReset) {
                $user->notify(new ResetPasswordRequest($user->id,$passwordReset->token));
            }
        }
        else{
            return back()->with('msg','Email không tồn tại trong hệ thống');
        }
        return redirect()->route('auth.login')->with('status', 'Chúng tôi đã gửi cho bạn một email. Vui lòng kiểm tra email của bạn');

        // return response()->json([
        //     'message' => 'We have e-mailed your password reset link!'
        //     ]);
    }

    public function resetPassword(Request $request){
        return view('screens.frontend.auth.resetpassword');
    }

    public function processResetPassword(Request $request){
        // dd($request->token);
        
        $passwordReset = PasswordReset::where('token', $request->token)->first();

        // // nếu token sai hoạc ko tồn tại sẽ trả về fail và trang ko tồn tại
        // $passwordReset = PasswordReset::where('token', $request->token)->firstOrFail();

        // dd($passwordReset);
        if(!empty($passwordReset)){
            $rule = [
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            ];
            $messages = [
                'password.required' => 'Password không được để chống',
                'password_confirm.required' => 'Password confirm không được để chống',
                'password_confirm.same' => 'Password không trùng nhau' 
            ];
            $request->validate($rule,$messages);

            if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
                $passwordReset = PasswordReset::where('token', $passwordReset->token)->delete();
                return response()->json([
                    'message' => 'This password reset token is invalid.',
                ], 422);
            }
            $user = User::where('email', $passwordReset->email)->firstOrFail();
            $updatePasswordUser = $user->update(['password' => bcrypt($request->password)]);
            $passwordReset = PasswordReset::where('token', $passwordReset->token)->delete();
            // $passwordReset->delete();
            return redirect()->route('auth.login')->with('status', 'Đổi mật khẩu thành công. Vui lòng đăng nhập lại');
            // return response()->json([
            //     'success' => $updatePasswordUser,
            // ]);
        }
        else{
            return redirect()->route('forgotPassword.forgotPasswordForm')->with('msg', 'Đường dẫn của bạn sai hoạc đã hết hạn. Vui lòng nhập lại email');
        }

        
        
    }
}
