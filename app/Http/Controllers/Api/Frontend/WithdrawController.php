<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index()
    {
        return view('frontend.instructor-dashboard.withdraw.index');
    }

    public function requestPayoutIndex()
    {
        $currentBalance = user()->wallet;
        $pendingBalance = Withdraw::where('instructor_id', user()->id)->where('status', 'pending')->sum('amount');
        $totalPayout = Withdraw::where('instructor_id', user()->id)->where('status', 'approved')->sum('amount');

        return view('frontend.instructor-dashboard.withdraw.request-payout', compact('currentBalance', 'pendingBalance', 'totalPayout'));
    }

    public function requestPayout(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        if (user()->wallet < $request->amount) {
            notyf()->error('Insufficient Balance!');

            return redirect()->back();
        }

        if (Withdraw::where('instructor_id', user()->id)->where('status', 'pending')->exists()) {
            notyf()->error('Withdraw Request Already Pending!');

            return redirect()->back();
        }

        Withdraw::create([
            'instructor_id' => user()->id,
            'amount' => $request->amount,
        ]);

        notyf()->success('Withdraw Request Sent!');

        return redirect()->back();
    }
}
