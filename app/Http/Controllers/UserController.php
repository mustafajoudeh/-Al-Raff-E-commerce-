<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view("user.index", compact("users"));

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
        $validated = $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'string', Rule::in(['admin', 'customer'])],
            'status' => ['required', 'string', Rule::in(['active', 'de_active'])],
            'password' => ['required', 'string', 'min:8'],
            'confirmed_password' => ['required', 'string', 'min:8', 'same:password'],
        ]);

        User::create([
            'user_name' => $validated['user_name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'] ?? null,
            'role' => $validated['role'],
            'status' => $validated['status'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()->with('success', 'تم إضافة المستخدم بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

         return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'role' => ['required', Rule::in(['admin', 'customer'])],
            'status' => ['required', Rule::in(['active', 'de_active'])],
            'password' => ['nullable', 'string', 'min:8'],
            'confirmed_password' => [
                'nullable',
                'required_with:password',
                'same:password',
            ],
        ]);

        $user->user_name = $validated['user_name'];
        $user->email = $validated['email'];
        $user->phone_number = $validated['phone_number'] ?? null;
        $user->role = $validated['role'];
        $user->status = $validated['status'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'تم تحديث بيانات المستخدم بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()
            ->with('success', 'تم حذف المستخدم بنجاح!');
    }


    public function toggleStatus(string $id)
    {
        $user = User::findOrFail($id);

        $user->status = $user->status === 'active'
            ? 'de_active'
            : 'active';

        $user->save();

        return redirect()->back()
            ->with('success', 'تم تحديث حالة المستخدم بنجاح!');
    }

}