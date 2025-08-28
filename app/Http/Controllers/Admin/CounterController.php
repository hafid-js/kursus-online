<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CounterController extends Controller
{
    public function index()
    {
        $counter = Counter::first();

        return view('admin.sections.counter.index', compact('counter'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'counter_one' => ['nullable', 'numeric'],
            'title_one' => ['nullable', 'string', 'max:255'],
            'counter_two' => ['nullable', 'numeric'],
            'title_two' => ['nullable', 'string', 'max:255'],
            'counter_three' => ['nullable', 'numeric'],
            'title_three' => ['nullable', 'string', 'max:255'],
            'counter_four' => ['nullable', 'numeric'],
            'title_four' => ['nullable', 'string', 'max:255'],
        ]);

        Cache::forget('aboutpage_counter');
        Counter::updateOrCreate([
            'id' => 1,
        ], $validatedData);

        notyf()->success('Updated Successfully!');

        return redirect()->back();
    }
}
