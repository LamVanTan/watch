<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Mail;
class AuthController extends Controller
{

    public function __construct(User $user){
        $this->user = $user;
    }
    public function login(){
        return view('watch.auth.login');
    }

    public function postLogin(Request $request) {
        $email    = $request->username;
        $password = $request->password;

        if(Auth::attempt(['email' => $email, 'password' => $password])) {       
            return redirect()->route('watch.index.index')->with('login','Đăng Nhập Thành Công');
        }else {
            return redirect()->route('watch.auth.login')->with('msg', 'Sai email hoặc password!');
        }
    }

    public function Forgot_password(Request $request){
        $email = $request->email;
        $Codepassword = strtoupper(substr(md5(microtime()), rand(0, 26), 8));

        $mail =[
                        'header' => 'MẬT KHẨU MỚI CỦA BẠN',
                        'slot' => 'MẬT KHẨU MỚI CỦA BẠN ĐÃ ĐƯỢC CẬP NHẬP',
                        'subcopy' => 'ĐÂY LÀ MẬT KHẨU MỚI CỦA BẠN  : '.$Codepassword,
                        
                    ];
                    Mail::send('vendor.mail.html.layout', $mail, function($message) use($email){
                        $message->to($email)->subject('Mật Khẩu Mới');
                        $message->from('lamvantan03@mail',"Watch luxry");
                    });
        $password =bcrypt( $Codepassword);
        $data = [
                    'password'=>$password
                ];
        $Forgot_password = $this->user->forgotPassword($data,$email);
        if($Forgot_password){
            return redirect()->back()->with('msg', 'Phiền bạn vào email của mình để nhận Mật Khẩu đăng nhập website!');     
        }
    }

    public function register(){
        return view('watch.auth.register');
    }

    public function postRegister(UserRequest $request){
         $funllname = $request->fullname;
         $city = $request->city;
         $district = $request->district;
         $wards = $request->wards;
         $village = $request->village;
         $phone = $request->phone;
         $gender = $request->gender;
         $birthday = $request->birthday;
         $email = $request->email;
         $password = bcrypt($request->password);

         $address = $village.','.$wards.','.$district.','.$city;
         $data = [
                    'fullname' => $funllname,
                    'email'    => $email,
                    'password' => $password,
                    'phone'    => $phone,
                    'gender'   => $gender,
                    'birthday' => $birthday,
                    'address'  => $address,
                    'permission'=> 0
                ];
         $addRegister = $this->user->addRegister($data);
         if($addRegister){
            return redirect()->route('watch.auth.login')->with('msg','Chúc mừng bạn đăng ký thành công, Mời bạn Đăng nhập');
         }else{
            return redirect()->back()->with('msg', 'Đăng ký thất bại');
         }

    }

    public function logout(){
         Auth::logout();
         return redirect()->back();
    }



//admin
    public function loginAdmin(){
        return view('auth.auth.login');
    }
    
    public function postloginAdmin(Request $request){
        $username = $request->username;
        $password = $request->password;

        if (Auth::attempt( ['email'=>$username,'password'=>$password])) {
            
            return redirect()->route('admin.index.index');;

        }else{
            return redirect()->back()->with('msg', 'Sai mat khau hoac tai khoan');
        }
    }

    public function logoutAdmin(){
        
        Auth::logout();
        return redirect()->route('auth.auth.login');
    }
}
