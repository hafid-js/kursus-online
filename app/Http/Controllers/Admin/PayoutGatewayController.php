<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayoutGateway;
use Exception;
use Illuminate\Http\Request;

class PayoutGatewayController extends Controller
{

    public function index()
    {
        $gateways = PayoutGateway::all();
        return view('admin.payout-gateway.index', compact('gateways'));
    }


    public function create()
    {
        return view('admin.payout-gateway.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'required|string|max:2000',
           'status' => 'required|boolean',
        ]);

        $gateway = new PayoutGateway();
        $gateway->name = $request->name;
        $gateway->description = $request->description;
        $gateway->status = $request->status;
        $gateway->save();
        notyf()->success("Created Successfully!");

        return redirect()->route('admin.payout-gateway.index');
    }



    public function edit(PayoutGateway $payout_gateway)
    {
        return view('admin.payout-gateway.edit', compact('payout_gateway'));
    }


    public function update(Request $request, PayoutGateway $payout_gateway)
    {
         $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'required|string|max:2000',
           'status' => 'required|boolean',
        ]);

        $payout_gateway->name = $request->name;
        $payout_gateway->description = $request->description;
        $payout_gateway->status = $request->status;
        $payout_gateway->save();
        notyf()->success("Updated Successfully!");

        return redirect()->route('admin.payout-gateway.index');
    }


    public function destroy(PayoutGateway $payout_gateway)
    {
        try {
            // throw ValidationException::withMessages(['you have error']);
            $payout_gateway->delete();
            notyf()->success('Delete Succesfully!');
            return response(['message' => 'Delete Successfully!'], 200);
        } catch(Exception $e) {
            logger("Course Level Error >> ".$e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
