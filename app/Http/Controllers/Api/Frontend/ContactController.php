<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\ContactSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $contactCards = Cache::rememberForever('contact_cards', function () {
            return Contact::where('status', 1)->get();
        });

        $contactSetting = Cache::rememberForever('contact_setting', function () {
            return ContactSetting::first();
        });

        return $this->sendResponse([
            'contactCards' => $contactCards,
            'contactSetting' => $contactSetting,
        ], 'Contact data retrieved successfully');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:255'],
        ]);

        try {
            if (config('mail_queue.is_queue')) {
                Mail::to(config('settings.receiver_email'))->queue(new ContactMail(
                    $request->name,
                    $request->email,
                    $request->subject,
                    $request->message
                ));
            } else {
                Mail::to(config('settings.receiver_email'))->send(new ContactMail(
                    $request->name,
                    $request->email,
                    $request->subject,
                    $request->message
                ));
            }
        } catch (\Throwable $th) {
            return $this->sendError('Failed to send email', 500);
        }

        return $this->sendResponse(null, 'Message sent successfully');
    }
}
