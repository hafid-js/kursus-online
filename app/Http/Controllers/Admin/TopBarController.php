<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopBar;
use Illuminate\Http\Request;

class TopBarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topbar = TopBar::first();
        return view('admin.top-bar.index', compact('topbar'));
  }    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['nullable','email','max:255'],
            'phone' => ['nullable','max:255'],
            'offer_name' => ['nullable','string','max:255'],
            'offer_short_description' => ['nullable','string','max:255'],
            'offer_button_text' => ['nullable','string','max:255'],
            'offer_button_url' => ['nullable','url','max:255'],
        ]);

        TopBar::updateOrCreate([
                'id' => 1
            ], $validatedData);

        notyf()->success('Update Successfully!');

        return redirect()->back();
    }
}
