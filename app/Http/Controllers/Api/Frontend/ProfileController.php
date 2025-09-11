<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Events\User\UserProfileUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Http\Requests\Frontend\SocialUpdateRequest;
use App\Models\InstructorPayoutInformation;
use App\Models\PayoutGateway;
use App\Traits\ApiResponseTrait;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use FileUpload, ApiResponseTrait;

    public function index()
    {
        $user = Auth::user();

        return $this->sendResponse([
            'user' => $user,
        ], 'Profile data retrieved.');
    }

    public function show()
    {
        $user = Auth::user();

        if ($user->role === 'instructor') {
            $gateways = PayoutGateway::where('status', 1)->get();
            $gatewayInfo = InstructorPayoutInformation::where('instructor_id', $user->id)->first();

            return $this->sendResponse([
                'user' => $user,
                'gateways' => $gateways,
                'gateway_info' => $gatewayInfo,
            ], 'Instructor profile data retrieved.');
        }

        return $this->sendResponse(['user' => $user], 'Student profile data retrieved.');
    }

    public function updateProfile(ProfileUpdateRequest $request)
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

        return $this->sendResponse(['user' => $user], 'Profile updated successfully.');
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return $this->sendResponse(null, 'Password updated successfully.');
    }

    public function updateSocial(SocialUpdateRequest $request)
    {
        $user = Auth::user();
        $user->facebook = $request->facebook;
        $user->x = $request->x;
        $user->linkedin = $request->linkedin;
        $user->website = $request->website;
        $user->save();

        return $this->sendResponse(['user' => $user], 'Social links updated successfully.');
    }

    public function updateGatewayInfo(Request $request)
    {
        $user = Auth::user();

        InstructorPayoutInformation::updateOrCreate(
            ['instructor_id' => $user->id],
            [
                'gateway' => $request->gateway,
                'information' => $request->information,
            ]
        );

        return $this->sendResponse(null, 'Payout information updated successfully.');
    }
}
