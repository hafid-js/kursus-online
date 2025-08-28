<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DatabaseClearController extends Controller
{
    public function index()
    {
        return view('admin.database-clear.index');
    }

    public function destroy(Request $request)
    {
        try {
            Artisan::call('migrate:fresh --seed');
            Artisan::call('optimize:clear');

            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            logger($th);
            throw $th;
        }
    }
}
