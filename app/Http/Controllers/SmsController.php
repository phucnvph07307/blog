<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class SmsController extends Controller
{
    public function send(){
        Nexmo::message()->send([
            'to'   => '0342525777',
            'from' => '0376671373',
            'text' => 'Test send'
        ]);
        echo "gui thanh cong";
    }
}
