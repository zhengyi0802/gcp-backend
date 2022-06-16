<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{

    public function password()
    {
        $user = auth()->user();

        return view('profiles.password', [ 'password' => $user->password, ]);
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $current = ($request->input('password_current'));
        $confirm = ($request->input('password_confirm'));
        $new = ($request->input('password_new'));

        if (!Hash::check($current, $user->password)) {
            return redirect()->route('profile.password')
                             ->with('error1', 'error');
        }
        if (strlen($new) < 8) {
            return redirect()->route('profile.password')
                             ->with('error2', 'error');
        }
        if ($confirm != $new) {
            return redirect()->route('profile.password')
                             ->with('error3', 'error');
        }

        $user->password = bcrypt($new);

        try {
            $user->save();
        } catch(Exception $e) {
            return redirect()->route('profile.password')
                             ->with('error4', 'error');
        }
        return redirect()->route('profile.password')
                         ->with('success', 'OK');
    }

}
