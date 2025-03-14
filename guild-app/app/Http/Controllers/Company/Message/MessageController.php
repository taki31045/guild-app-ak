<?php

namespace App\Http\Controllers\Company\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;
use App\Http\Requests\MessageRequest;

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
}
