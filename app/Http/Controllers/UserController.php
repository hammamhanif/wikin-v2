<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $usersPerPage = 1;
        $totalUsers = User::count();
        $totalPages = ceil($totalUsers / $usersPerPage);
        $currentPage = request()->page ?? 1;

        $query = User::query()->latest();

        if (request()->filled('search')) {
            $search = request()->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('username', 'LIKE', '%' . $search . '%')
                    ->orWhere('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('type', 'LIKE', '%' . $search . '%');
            });
        }

        $users = $query->get();

        return view('tamplate.dashboard.menuadmin.menuUser', compact('users',  'currentPage', 'totalPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'type' => 'required',
            'username' => 'required|unique:users,username,' . $id,
        ];

        $messages = [
            'type.required' => 'The type field is required.',
            'username.required' => 'The username field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses penyuntingan data
        $user = User::find($id);

        // Memastikan user ditemukan
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Mengupdate type dan username
        $user->type = $request->input('type');
        $user->username = $request->input('username');
        $user->save();


        return redirect()->route('userdate')->withSuccess('Pengguna berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('userdate');
    }
}
