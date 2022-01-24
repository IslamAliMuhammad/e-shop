<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('client.contact');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Request $request)
    {
        //

        $validted = $request->validate([
            'email' => 'required|string|email',
            'msg' => 'required|string'
        ]);


        //send email from email to myself
        Mail::to('islam.ali.muhammad@gmail.com')->send(new ContactMail($request->email, $request->msg));

        return redirect()->route('products.index')->with('success', 'Email Successfully Sent !');

    }


}
