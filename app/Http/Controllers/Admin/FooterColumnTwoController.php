<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterColumnTwo;
use Exception;
use Illuminate\Http\Request;

class FooterColumnTwoController extends Controller
{

    public function index()
    {
        $columnTwo = FooterColumnTwo::paginate(20);
        return view('admin.footer.column-two.index', compact('columnTwo'));
    }


     public function create()
    {
        $editMode = false;
        return response()->view('admin.footer.column-two.column-modal', compact('editMode'));
    }


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

    public function edit(string $id)
    {
        $editMode = true;
        $column = FooterColumnTwo::findOrFail($id);
        return response()->view('admin.footer.column-two.column-modal', compact('column','editMode'));
    }

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
