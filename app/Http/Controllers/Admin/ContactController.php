<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{

    use FileUpload;

    public function index()
    {
        $contactCards = Contact::all();
        return view('admin.contact.index',compact('contactCards'));
    }


    public function create()
    {
        $editMode = false;
        return response()->view('admin.contact.contact-modal', compact('editMode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required','image','max:3000'],
            'title' => ['required','string','max:255'],
            'line_one' => ['required','string','max:255'],
            'line_two' => ['required','string','max:255'],
            'status' => ['nullable','boolean'],
        ]);

        $icon = $this->uploadFile($request->file('icon'));

        $contact = new Contact();
        $contact->icon = $icon;
        $contact->title = $request->title;
        $contact->line_one = $request->line_one;
        $contact->line_two = $request->line_two;
        $contact->status = $request->status;
        $contact->save();

        notyf()->success('Created Successfully!');
        return redirect()->route('admin.contact.index');
    }

    public function edit(Contact $contact)
    {
        $editMode = true;
        return response()->view('admin.contact.contact-modal', compact('contact','editMode'));
    }


    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'icon' => ['nullable','image','max:3000'],
            'title' => ['required','string','max:255'],
            'line_one' => ['required','string','max:255'],
            'line_two' => ['required','string','max:255'],
            'status' => ['nullable','boolean'],
        ]);

        if($request->hasFile('icon')) {
            $icon = $this->uploadFile($request->file('icon'));
            $this->deleteFile($request->old_icon);
            $contact->icon = $icon;
        }

        $contact->title = $request->title;
        $contact->line_one = $request->line_one;
        $contact->line_two = $request->line_two;
        $contact->status = $request->status;
        $contact->save();

        Cache::forget('contact_cards');

        notyf()->success('Updated Successfully!');
        return redirect()->route('admin.contact.index');
    }


    public function destroy(Contact $contact)
    {
        try {
            $this->deleteFile($contact->icon);
            $contact->delete();
            Cache::forget('contact_cards');
            notyf()->success('Deleted Successfully!');
            return response(['message' => 'Deleted Successfully!']);
        } catch(Exception $e) {
            logger("Course Language Error>> ".$e);
            return response(['message' => 'Something went wrong!']);
        }
    }
}
