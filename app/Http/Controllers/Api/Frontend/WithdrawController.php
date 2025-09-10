<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        // Jika perlu data dasar, bisa return misal balance dan stats, atau list withdraw
        return $this->sendResponse(null, 'Endpoint ready');
    }

    public function requestPayoutIndex()
    {
        $user = auth()->user();

        $currentBalance = $user->wallet;
        $pendingBalance = Withdraw::where('instructor_id', $user->id)
            ->where('status', 'pending')
            ->sum('amount');
        $totalPayout = Withdraw::where('instructor_id', $user->id)
            ->where('status', 'approved')
            ->sum('amount');

        $data = [
            'currentBalance' => $currentBalance,
            'pendingBalance' => $pendingBalance,
            'totalPayout' => $totalPayout,
        ];

        return $this->sendResponse($data, 'Payout data retrieved successfully.');
    }

    public function requestPayout(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user = auth()->user();

        if ($user->wallet < $request->amount) {
            return $this->sendError('Insufficient Balance!', 400);
        }

        $pendingExists = Withdraw::where('instructor_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($pendingExists) {
            return $this->sendError('Withdraw Request Already Pending!', 400);
        }

        $withdraw = Withdraw::create([
            'instructor_id' => $user->id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return $this->sendResponse($withdraw, 'Withdraw Request Sent!');
    }
}
