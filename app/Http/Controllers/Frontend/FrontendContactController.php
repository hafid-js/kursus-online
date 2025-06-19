<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class FrontendContactController extends Controller
{
    function index() {
        $contactCards = Contact::where('status', 1)->get();
        $contactSetting = ContactSetting::first();
        return view('frontend.pages.contact', compact('contactCards','contactSetting'));
    }

    function sendMail(Request $request) {
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255'],
            'subject' => ['required','string','max:255'],
            'message' => ['required','string','max:255'],
        ]);
    }
}
