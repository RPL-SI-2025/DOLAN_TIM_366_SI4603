<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller

{


public function index()
{
    $admins = User::where('role', 'admin')->get(); // asumsi kamu simpan role 'admin' di kolom `role`
    return view('dashboard.admin.index', compact('admins'));
}
    public function create()
    {
        return view('dashboard.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'phone'    => 'nullable|string|max:20',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'role'     => 'admin',

        ]);

        return redirect()->back()->with('success', 'Admin created successfully.');
    }

    public function destroy($id)
{
    $admin = User::findOrFail($id);

    // Optional: kalau kamu simpan role, pastikan hanya hapus admin
    if ($admin->role !== 'admin') {
        return redirect()->back()->with('error', 'User ini bukan admin.');
    }

    $admin->delete();

    return redirect()->route('dashboard.admin.index')->with('success', 'Admin berhasil dihapus.');
}

public function edit($id)
{
    $admin = User::findOrFail($id);
    return view('dashboard.admin.edit', compact('admin'));
}

public function update(Request $request, $id)
{
    $admin = User::findOrFail($id);

    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $admin->id,
        'phone' => 'nullable|string|max:20',
    ]);

    $admin->update([
        'name'  => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
    ]);

    return redirect()->route('dashboard.admin.index')->with('success', 'Admin berhasil diperbarui.');
}


}

