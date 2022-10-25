<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index($notifiable)
    {
        return view( 'notification')->with($notifiable);
   }
}
