<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{

    public function index()
    {
        $footer = Footer::first();
        return view('admin.footer.index', compact('footer'));
  }    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => ['nullable','string','max:255'],
            'copyright' => ['required','string','max:255'],
            'phone' => ['nullable','string','max:255'],
            'email' => ['nullable','string','max:255'],
            'address' => ['nullable','string','max:255'],
        ]);

        Footer::updateOrCreate([
            'id' => 1
        ], $validatedData);

        notyf()->success('Update Successfully!');

        return redirect()->back();
    }
}
