<?php

namespace App\Http\Controllers\Watch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
class ContactController extends Controller
{
	public function __construct(Contact $contact){
		$this->contact = $contact;
	}

    public function contact(){
    	return view('watch.contact.contact');
    }

    public function postcontact(Request $request){
    	//dd($request->all());
    	$name = $request->name;
    	$lastname = $request->lastname;
    	$email = $request->email;
    	$subject = $request->subject;
    	$content = $request->message;

    	$data = [
    				'fullname'=>$lastname.' '.$name,
    				'email'=>$email,
    				'subject'=>$subject,
    				'content'=>$content,
    			];
    	
    	$result = $this->contact->addContact($data);
    	//dd($result);
    	if($result){
    		return redirect()->back()->with('msg', 'Cảm ơn bạn đã liên hệ với chúng tôi, chúng tôi sẽ sớm phản phồi lại cho bạn!');
    	}
    }
}
