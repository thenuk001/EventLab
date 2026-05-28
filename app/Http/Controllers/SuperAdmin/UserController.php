<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['company', 'roles'])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'ILIKE', "%{$search}%")
                        ->orWhere('email', 'ILIKE', "%{$search}%");
                });
            })
            ->when($request->role, function ($query, $role) {
                $query->role($role);
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('super-admin.users.index', compact('users'));
    }

    public function create()
    {
        $companies = Company::orderBy('name')->get();

        return view('super-admin.users.create', compact('companies'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', 'in:company_admin,support_staff'],
            'company_id' => ['nullable', 'exists:companies,id'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if ($validated['role'] === 'company_admin' && empty($validated['company_id'])) {
            return back()
                ->withInput()
                ->withErrors(['company_id' => 'Company is required for Company Admin users.']);
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company_id' => $validated['role'] === 'company_admin'
                ? $validated['company_id']
                : null,
            'password' => $validated['password'],
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $user->assignRole($validated['role']);

        return redirect()
            ->route('super.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $companies = Company::orderBy('name')->get();

        return view('super-admin.users.edit', compact('user', 'companies'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:company_admin,support_staff,super_admin'],
            'company_id' => ['nullable', 'exists:companies,id'],
        ]);

        if ($validated['role'] === 'company_admin' && empty($validated['company_id'])) {
            return back()
                ->withInput()
                ->withErrors(['company_id' => 'Company is required for Company Admin users.']);
        }

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company_id' => $validated['role'] === 'company_admin'
                ? $validated['company_id']
                : null,
        ]);

        $user->syncRoles([$validated['role']]);

        return redirect()
            ->route('super.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function activate(User $user): RedirectResponse
    {
        $user->update([
            'status' => 'active',
            'blocked_at' => null,
            'deactivated_at' => null,
        ]);

        return back()->with('success', 'User activated successfully.');
    }

    public function deactivate(User $user): RedirectResponse
    {
        abort_if($user->id === auth()->id(), 403, 'You cannot deactivate your own account.');

        $user->update([
            'status' => 'inactive',
            'deactivated_at' => now(),
            'blocked_at' => null,
        ]);

        return back()->with('success', 'User deactivated successfully.');
    }

    public function block(User $user): RedirectResponse
    {
        abort_if($user->id === auth()->id(), 403, 'You cannot block your own account.');

        $user->update([
            'status' => 'blocked',
            'blocked_at' => now(),
        ]);

        return back()->with('success', 'User blocked successfully.');
    }

    public function resetPassword(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'password' => $validated['password'],
        ]);

        return back()->with('success', 'Password reset successfully.');
    }
}