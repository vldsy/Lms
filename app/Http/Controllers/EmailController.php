<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SubmissionSent;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $data['name'] = 'John';
        Mail::to('recipient@example.com')->send(new SubmissionSent($data));
        return response()->json(['message' => 'Email sent']);
    }
}
