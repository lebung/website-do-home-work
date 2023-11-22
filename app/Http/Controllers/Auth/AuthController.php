<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function index(){

    }

    // Hien thi man hinh login
    public function login(Request $request){
        $key = 'login.' .$request->ip();
        // dd($key);
        return view('screens.frontend.auth.login',[
            'key' => $key,
            'retries' => RateLimiter::retriesLeft($key,5),
            'secounds'=>RateLimiter::availableIn($key)
        ]);
    }

    // Xu ly login
    public function processLogin(Request $request){
        $rule = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $messages = [
            'email.required' => 'Email không được để chống',
            'password.required' => 'Password không được để chống',
            'email.email' => 'Kiểm tra lại email'
        ];
        $request->validate($rule,$messages);

        

        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt([
            'email'=> $email,
            'password' => $password
        ])){
            if(Auth::user()->status == 0){
                Auth::logout();
                return back()->with('message','Không thể login. Tài khoản của bạn hiện đã bị khoá');
            }
            RateLimiter::clear('login.' .$request->ip());
            return redirect()->route('frontend.home');
        }
        else{
            return back()->with('message','Kiểm tra lại email hoặc mật khẩu');
        }
    }

    //Hien thi ra man hinh dang ky
    public function register(){
        return view('screens.frontend.auth.register');
    }

    //Xu ly dang ky
    public function processRegister(UserRequest $request){
        // dd($request->all());
        $user = new User();
        if($request->hasFile('avatar')){
            // dd($request->avatar);
            $file = $request->avatar;
            $ext = $request->avatar->extension();
            $file_name = time().'-'.'user.'.$ext;
            $file->move(public_path('frontend/images/avatars'), $file_name);
        }
        // $request->merge(['avatar' => $file_name]);
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->avatar = $file_name;
        $user->save();
        $user->assignRole(4);

        event(new Registered($user));
        
        Auth::login($user);
        return redirect()->route('verification.notice');
        // return redirect()->route('auth.login')->with('status', 'Đăng kí thành công. Mời đăng nhập');
    }  
    
    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect()->route('frontend.home');
    }


    public function editUser(User $user, UserRequest $request){

        if($request->hasFile('avatar')){
            // dd($request->avatar);
            $file = $request->avatar;
            $ext = $request->avatar->extension();
            $file_name = time().'-'.'user.'.$ext;
            $file->move(public_path('frontend/images/avatars'), $file_name);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'avatar' => $file_name,
            ]);

        }
        else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        
    }
}
