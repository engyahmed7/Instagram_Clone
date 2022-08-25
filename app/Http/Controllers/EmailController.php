<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendEmail(Request $request)

{
        /* This method will call SendEmailJob Job*/
        dispatch(new SendEmailJob($request));
    }
}
