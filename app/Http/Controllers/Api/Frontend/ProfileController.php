<?php

namespace App\Http\Controllers\Frontend;

use App\Events\User\UserProfileUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Http\Requests\Frontend\SocialUpdateRequest;
use App\Models\InstructorPayoutInformation;
use App\Models\PayoutGateway;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use FileUpload;

    public function index()
    {
        // Kalau untuk API, biasanya return data profile user saja
        $user = Auth::user();

        return response()->json($user);
    }

    public function instructorIndex()
    {
        $gateways = PayoutGateway::where('status', 1)->get();
        $gatewayInfo = InstructorPayoutInformation::where('instructor_id', Auth::id())->first();

        return response()->json([
            'gateways' => $gateways,
            'gatewayInfo' => $gatewayInfo,
        ]);
    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $avatarPath = $this->uploadFile($request->file('avatar'));
            $this->deleteFile($user->image);
            $user->image = $avatarPath;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->about;
        $user->headline = $request->headline;
        $user->gender = $request->gender;

        $changes = $user->getDirty();
        $user->save();

        if (!empty($changes)) {
            event(new UserProfileUpdated($user, $changes));
        }

        return response()->json(['message' => 'Update Successfully', 'user' => $user]);
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }

    public function updateSocial(SocialUpdateRequest $request)
    {
        $user = Auth::user();
        $user->facebook = $request->facebook;
        $user->x = $request->x;
        $user->linkedin = $request->linkedin;
        $user->website = $request->website;
        $user->save();

        return response()->json(['message' => 'Social profile updated successfully', 'user' => $user]);
    }

    public function updateGatewayInfo(Request $request)
    {
        $info = InstructorPayoutInformation::updateOrCreate(
            ['instructor_id' => Auth::id()],
            [
                'gateway' => $request->gateway,
                'information' => $request->information,
            ]
        );

        return response()->json(['message' => 'Payout info updated successfully', 'data' => $info]);
    }
}
