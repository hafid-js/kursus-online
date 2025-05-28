<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    function index() {
        $withdraws = Withdraw::with('instructor')->paginate(25);
        return view('admin.withdraw-request.index', compact('withdraws'));
    }

    function show(Withdraw $withdraw) {
        return view('admin.withdraw-request.show', compact('withdraw'));
    }

    function updateStatus(Request $request, Withdraw $withdraw) : RedirectResponse {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $withdraw->status = $request->status;
        if($request->status == 'approved') {
            $withdraw->instructor->wallet = ($withdraw->instructor->wallet = $withdraw->amount);
            $withdraw->instructor->save();
        }
        $withdraw->save();

        notyf()->success('Updated Successfully');
        return redirect()->route('admin.withdraw-request.index');
    }
}
