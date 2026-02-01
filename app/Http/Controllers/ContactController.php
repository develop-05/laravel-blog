<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('page.contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'subject' => ['required'],
            'message' => ['required' ],
        ]);
        // dd($request->all());

        Mail::to('admin@mail.com')->send(new Contact($request));
        return redirect()->route('contact')->with('success', 'Thanks for mailing!');
    }
}
