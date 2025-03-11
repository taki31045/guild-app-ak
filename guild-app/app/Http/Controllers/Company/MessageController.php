<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Message;
use App\Models\Application;
use App\Models\Freelancer;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MessageRequest;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{

//freelancer and companyのmessageのやりとり
    public function index($user_id){
        $user = User::findOrFail($user_id);
        $all_users = User::where('id','!=',Auth::user()->id)
                          ->where(function($query){
                            $query->whereHas('sentMessages',function($subquery){
                                $subquery->where('receiver_id',Auth::user()->id);
                            })->orWhereHas('receiveMessages',function($subquery){
                                $subquery->where('sender_id',Auth::user()->id);
                            });
                          })->get();

       $messages = Message::where(function($query) use ($user_id){
        $query->where('sender_id', Auth::user()->id)->where('receiver_id',$user_id);
       })->orWhere(function($query) use ($user_id){
        $query->where('sender_id',$user_id)->where('receiver_id',Auth::user()->id);
       })->get();

        return view('companies.contact.with_freelancer',compact('all_users','messages','user'));
    }

//-----
    public function store(MessageRequest $request){
        Message::create([
            'sender_id'   => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'content'     => $request->content
        ]);

        return redirect()->back();
    }

//adminとcontactを取るためのpageに移動するだけもの
    public function contact(){
        return view('companies.contact.to_admin');
    }

//adminへのコンタクトはgmailを使用する。そのためのfunction
    public function sendMail(ContactRequest $request){
        $email = Auth::user()->email;
        $emailContent = "
        <p>You have receive a new inquiry.</p>
        <p><strong>Name: </strong>$request->name</p>
        <p><strong>Email: </strong>" . Auth::user()->email . "</p>
        <p><strong>Title: </strong> $request->title</p>
        <p><strong>Message: </strong>" . nl2br(e($request->content)) . "</p>
        ";
        Mail::send([], [], function($message) use ($request, $emailContent,$email){
            $message->from($email, $request->name)
                    ->to('guild20250106@gmail.com')
                    ->replyTo($email, $request->name)
                    ->subject('New Inquiry: ' . $request->title)
                    ->html($emailContent);
            if($request->hasFile('attachment')){
                $file = $request->file('attachment');
                $message->attach($file->getRealPath(), [
                    'as'   => $file->getClientOriginalName(),
                    'mime' => $file->getMimeType()
                ]);
            }
        });
        return redirect()->route('company.contact.contact')->with('success', 'Your inquiry has been sent successfully.');
    }

}

//freelancer and companyのmessageのやりとり
//-----
//adminとcontactを取るためのpageに移動するだけもの
//adminへのコンタクトはgmailを使用する。そのためのfunction
