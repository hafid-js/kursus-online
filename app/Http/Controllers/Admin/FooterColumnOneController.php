<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterColumnOne;
use Exception;
use Illuminate\Http\Request;

class FooterColumnOneController extends Controller
{

    public function index()
    {
        $columnOne = FooterColumnOne::paginate(20);
        return view('admin.footer.column-one.index', compact('columnOne'));
    }


    public function create()
    {
        $editMode = false;
        return response()->view('admin.footer.column-one.column-modal', compact('editMode'));
    }

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



    public function edit(string $id)
    {
        $editMode = true;
        $column = FooterColumnOne::findOrFail($id);
        return response()->view('admin.footer.column-one.column-modal', compact('column','editMode'));
    }


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
