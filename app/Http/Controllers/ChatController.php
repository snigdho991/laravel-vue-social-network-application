<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use Auth;
use App\Events\NewIncomingMessage;

class ChatController extends Controller
{
    public function chatfriends()
    {
    	$friends = Auth::user()->friends();

    	return view('chat.messages')->with('friends', $friends);
    }

    public function getUsers()
    {
        $contacts = User::where('id', '!=', Auth::id())->get();
        
        $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as message_count'))
             ->where('to', Auth::id())
             ->where('read', false)
             ->groupBy('from')
             ->get(); 

        $unreadMsg = Message::select(\DB::raw('`from` as sender_id, `text` as message'))
             ->where('to', Auth::id())
             ->where('read', false)
             ->orderBy('created_at', 'desc')
             ->get(); 

        $unreadMsgCreated = Message::select(\DB::raw('`from` as sender_id, `created_at` as messageCreated'))
             ->where('to', Auth::id())
             ->where('read', false)
             ->orderBy('created_at', 'desc')
             ->get(); 

        
        $contacts = $contacts->map(function($contact) use ($unreadIds, $unreadMsg, $unreadMsgCreated) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();
            $msgUnread = $unreadMsg->where('sender_id', $contact->id)->first();
            $msgUnreadCreated = $unreadMsgCreated->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->message_count : 0;
            $contact->msgunread = $msgUnread ? $msgUnread->message : '';
            $contact->msgunreadcreated = $msgUnreadCreated ? $msgUnreadCreated->messageCreated : '';
            return $contact;
        });

        return response()->json($contacts);
    }

    public function getConversationFor($id)
    {
    	Message::where('from', $id)->where('to', Auth::id())->update(['read' => true]);

        $messages = Message::where(function($q) use ($id) {
            $q->where('from', Auth::id());
            $q->where('to', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', Auth::id());
        })->get(); //(a = 1 and b=2) or (a = 2 and b=1)

    	return $messages;
    }

    public function sendMessage(Request $request)
    {
    	$message = Message::create([
    		'from' => auth()->id(),
    		'to'   => $request->contact_id,
    		'text' => $request->text
    	]);

        broadcast(new NewIncomingMessage($message));
        
    	return response()->json($message);
    }
}
