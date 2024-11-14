<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SubmissionSent;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $randomUser = User::inRandomOrder()->first();
        $data['name'] = $randomUser->name;
        Mail::to('recipient@example.com')->send(new SubmissionSent($data));
        return response()->json(['message' => 'Email sent']);
    }
}
