<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterColumnTwo;
use Exception;
use Illuminate\Http\Request;

class FooterColumnTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columnTwo = FooterColumnTwo::paginate(20);
        return view('admin.footer.column-two.index', compact('columnTwo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.column-two.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','string','max:255'],
            'url' => ['required','max:255'],
            'status' => ['nullable','boolean'],
        ]);

        $columnTwo = new FooterColumnTwo();
        $columnTwo->title = $request->title;
        $columnTwo->url = $request->url;
        $columnTwo->status = $request->status ?? 0;
        $columnTwo->save();

        notyf()->success('Created Successfully');
        return to_route('admin.footer-column-two.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $column = FooterColumnTwo::findOrFail($id);
        return view('admin.footer.column-two.edit', compact('column'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'title' => ['required','string','max:255'],
            'url' => ['required','max:255'],
            'status' => ['nullable','boolean'],
        ]);

        $columnTwo = FooterColumnTwo::findOrFail($id);
        $columnTwo->title = $request->title;
        $columnTwo->url = $request->url;
        $columnTwo->status = $request->status;
        $columnTwo->save();

        notyf()->success('Updated Successfully');
        return to_route('admin.footer-column-two.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $column = FooterColumnTwo::findOrFail($id);
         try {
            $column->delete();
            notyf()->success('Delete Succesfully!');
            return response(['message' => 'Delete Successfully!'], 200);
        } catch(Exception $e) {
            logger("Footer Column Error >> ".$e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
