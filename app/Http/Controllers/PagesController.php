<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;

/**
*  
*/
class PagesController extends Controller
{
	

	public function getIndex()
	{
		$posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
		$tags = Tag::all();
		return view('pages.welcome', compact('posts', 'tags'));
	}

	public function getAbout() 
	{

		$first = 'Caleb';
		$last = 'Oki';
		$full = $first . " " . $last;
		$email = 'caleboki@gmail.com';
		return view('pages.about')->with("fullname", $full)->with("email", $email);
	}

	public function getContact()
	{
		return view('pages.contact');
	}

	public function postContact(Request $request)
	{
		$this->validate($request, [
									'email' => 'required|email',
									'subject' => 'min:3',
									'message' => 'min:10']);

		$data = array(
			'email' => $request->email,
			'subject' => $request->subject,
			'bodyMessage' => $request->message
			);
		Mail::to('caleboki@gmail.com')->send(new ContactMessage($data));
		Session::flash('success', 'Your email was sent');

		return redirect()->route('home');
	}
}