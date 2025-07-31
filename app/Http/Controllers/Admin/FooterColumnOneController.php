<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterColumnOne;
use Exception;
use Illuminate\Http\Request;

class FooterColumnOneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columnOne = FooterColumnOne::paginate(20);
        return view('admin.footer.column-one.index', compact('columnOne'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.column-one.create');
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

        $columnOne = new FooterColumnOne();
        $columnOne->title = $request->title;
        $columnOne->url = $request->url;
        $columnOne->status = $request->status ?? 0;
        $columnOne->save();

        notyf()->success('Created Successfully');
        return to_route('admin.footer-column-one.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $column = FooterColumnOne::findOrFail($id);
        return view('admin.footer.column-one.edit', compact('column'));
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

        $columnOne = FooterColumnOne::findOrFail($id);
        $columnOne->title = $request->title;
        $columnOne->url = $request->url;
        $columnOne->status = $request->status;
        $columnOne->save();

        notyf()->success('Updated Successfully');
        return to_route('admin.footer-column-one.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $column = FooterColumnOne::findOrFail($id);
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
