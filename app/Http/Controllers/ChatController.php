<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Chat;
use App\models\Medication2;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use App\models\Message;
class ChatController extends Controller
{
    public function getMessages($chat_id) //get messages

    {
        $messages = Chat::with('messages','patient','doctor')->findOrFail($chat_id);
        // $messages = $chat->doctor;
        // $messages = Message::with('chat')->where('chat_id',1)->get();
        return response()->json($messages, 200);
    }
    public function sendMessage(Request $request)
    {
        $data = $request->only(['chat_id', 'body','user_id']);

        if ($request->has('image')) {
            $data['image'] = Storage::disk('uploads')->put('chat', $request->image);
        }


        auth('patien')->check() ? $data['user_id'] = auth('patien')->user()->id : $data['user_id'] = auth('online_doctor')->user()->id;

        $message = Message::create($data);

        $redis = Redis::connection();
        $redis->publish('message', json_encode($message));

        return response()->json($message, 200);
    }

    public function getNurseMessages($chat_id) //get messages

    {
        $messages = Chat::with('messages','nurse','doctor')->findOrFail($chat_id);
        // $messages = $chat->doctor;
        // $messages = Message::with('chat')->where('chat_id',1)->get();
        return response()->json($messages, 200);
    }
    public function sendNurseMessage(Request $request)
    {
        $data = $request->only(['chat_id', 'body','user_id']);

        if ($request->has('image')) {
            $data['image'] = Storage::disk('uploads')->put('chat', $request->image);
        }



        $message = Message::create($data);

        $redis = Redis::connection();
        $redis->publish('message', json_encode($message));

        return response()->json($message, 200);
    }


    // public function getMedication2(Request $request){
    //     $search = $request->search;

    //   if($search == ''){
    //      $employees = Medication2::orderby('name','asc')->select('id','name')->get();
    //   }else{
    //      $employees = Medication2::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->get();
    //   }

    //   $response = array();
    //   foreach($employees as $employee){
    //      $response[] = array(
    //           "id"=>$employee->name,
    //           "text"=>$employee->name
    //      );
    //   }

    //   return response()->json($response);
    // }
}
