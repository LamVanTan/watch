<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class AdminUserController extends Controller
{
	public function __construct(User $users){
		$this->users = $users;
	}
    public function index(){
    	$listUser = $this->users->getListUser();
    	return view('admin.users.index',compact('listUser'));
    }

    public function add(){
    	return view('admin.users.add');
    }

    public function postadd(Request $request){
    	$fullname = $request->fullname;
    	$phone = $request->phone;
    	$address = $request->address;
    	$gender = $request->gender;
    	$email = $request->email;
    	$password =  bcrypt($request->password);
    	$permission = $request->permission;
    	$birthday = $request->birthday;

    	$data = [
    				'fullname'=>$fullname,
    				'email'   => $email,
    				'password'=> $password,
    				'phone'   => $phone,
    				'address' => $address,
    				'gender'  => $gender,
    				'birthday'=> $birthday,
    				'permission'=>$permission
    			];

    	$result = $this->users->addItemUsers($data);
    	return redirect()->route('admin.users.index')->with('msg','Thêm người dùng thành công');

    }


    public function edit($id){
    	$itemUsers = $this->users->getItemUsers($id);
    	return view('admin.users.edit',compact('itemUsers'));
    }

    public function postedit(Request $request, $id){
    	$fullname = $request->fullname;
    	$phone = $request->phone;
    	$address = $request->address;
    	$gender = $request->gender;
    	$email = $request->email;
    	$permission = $request->permission;
    	$birthday = $request->birthday;
    	$password = $request->password;
    	if($password == null){
    		$data = [
    				'fullname'=>$fullname,
    				'email'   => $email,
    				'phone'   => $phone,
    				'address' => $address,
    				'gender'  => $gender,
    				'birthday'=> $birthday,
    				'permission'=>$permission
    			];
    	}else{
    		$password =  bcrypt($password);
    		//dd($password);
    		$data = [
    				'fullname'=>$fullname,
    				'email'   => $email,
    				'phone'   => $phone,
    				'address' => $address,
    				'gender'  => $gender,
    				'birthday'=> $birthday,
    				'permission'=>$permission
    			];
    	}
    	$result = $this->users->editItemUsers($data,$id);
    	return redirect()->route('admin.users.index')->with('msg','Cập nhập người dùng thành công');


    }


    public function delete($id){
        //$permission = Auth::user()->permission;
        $itemUsers = $this->users->getItemUsers($id);
        if($itemUsers->permission == 2){
            return redirect()->route('admin.users.index')->with('msg','Bạn không được xóa admin');
        }else if(Auth::user()->permission != $itemUser->permission && Auth::user()->permission != '2'){
            return redirect()->route('admin.users.index')->with('msg','Bạn Không được xóa thông tin người khác');
        }

    	$result = $this->users->deleteItemUsers($id);
    	return redirect()->route('admin.users.index')->with('msg','Xóa người dùng thành công');
    }
}
