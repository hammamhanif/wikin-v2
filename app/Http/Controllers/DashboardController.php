<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\pemas;
use App\Models\FormPemas;
use App\Models\Communities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RegistrasiPemas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\RegistrasiCommunities;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalPemas = FormPemas::where('user_id', $user->id)->count();
        $communities = RegistrasiCommunities::where('user_id', $user->id)->count();
        $news = News::where('user_id', $user->id)->count();
        $totalPemas2 = FormPemas::where('user_id', $user->id)->where('status', 'Diterima')->count();
        $registrasi = RegistrasiPemas::where('user_id', $user->id)->where('status', 'Diterima')->count();
        $memberPemas = $totalPemas2 + $registrasi;
        $pengmases = pemas::where('status_pemas', 'pencarian volunteer')->paginate(9);
        foreach ($pengmases as $pengmas) {
            $pengmas->short_content = Str::limit($pengmas->content, 100);
        }
        return view('tamplate.dashboard.welcome', compact('pengmases', 'totalPemas', 'memberPemas', 'communities', 'news'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:6144',
            'job' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,' . $id,
            'phone' => 'nullable|string|max:20',
            'facebook_profile' => 'nullable|url|max:255',
            'instagram_profile' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update job if provided
        if ($request->filled('job')) {
            $user->job = $request->job;
        }

        // Update name if provided
        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        // Update username if provided
        if ($request->filled('username')) {
            $user->username = $request->username;
        }

        // Update phone if provided
        if ($request->filled('phone')) {
            $user->phone = $request->phone;
        }

        // Update Facebook profile if provided
        if ($request->filled('facebook_profile')) {
            $user->facebook_profile = $request->facebook_profile;
        }

        // Update Instagram profile if provided
        if ($request->filled('instagram_profile')) {
            $user->instagram_profile = $request->instagram_profile;
        }

        // Update image if provided
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $allowedMimes = ['jpeg', 'png', 'jpg'];
            $validator = Validator::make($request->all(), [
                'image' => 'image|mimes:' . implode(',', $allowedMimes) . '|max:6144',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $name = md5(time() . $request->image->getClientOriginalName()) . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $name);
            $user->image = '/uploads/' . $name;
        }

        $user->save();

        return redirect()->route('profile')->withSuccess("Profile berhasil diperbaharui.");
    }



    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate the input fields
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Check if the current password matches the user's stored password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect back to the profile page with a success message
        return redirect()->route('profile')->withSuccess("Password berhasil diupdate.");
    }
}
