<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Pusher;

class NotifyClassController extends Controller
{
    public function index(){

    }

    public function sendMessage(){
        $data['title'] = "Chào mừng bạn đã tham gia lớp học";
        $data['class'] = "Nguyễn Mạnh Quân";

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
          );
          $pusher = new Pusher(
            'c99225feca5b539fb20f',
            '06f640a63b9f8a4397db',
            '1472142',
            $options
          );

          $pusher->trigger('Notify', 'send-message', $data);

          return back();
    }


}
