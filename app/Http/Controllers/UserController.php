<?php
namespace App\Http\Controllers;

use Exception;
use Log;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userRef = null;
        $testData = [
            'name' => 'le.thi.thu',
            'email' => 'le.thi.thu@sun-asterisk.com',
        ];
        try {
            $this->database->getReference('users')->push($testData);
            $userRef = $this->database->getReference('users')
                ->orderByKey()
                ->getSnapshot();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        print_r($userRef->getValue());
    }
}
