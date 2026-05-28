<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'ILIKE', "%{$search}%")
                        ->orWhere('email', 'ILIKE', "%{$search}%")
                        ->orWhere('contact_person', 'ILIKE', "%{$search}%");
                });
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->approval_status, function ($query, $approvalStatus) {
                $query->where('approval_status', $approvalStatus);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('super-admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('super-admin.companies.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:companies,email'],
            'whatsapp_number' => ['nullable', 'string', 'max:50'],
        ]);

        $company = Company::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . strtolower(Str::random(5)),
            'contact_person' => $validated['contact_person'] ?? null,
            'email' => $validated['email'],
            'whatsapp_number' => $validated['whatsapp_number'] ?? null,
            'status' => 'inactive',
            'approval_status' => 'pending',
        ]);

        return redirect()
            ->route('super.companies.index')
            ->with('success', "Company '{$company->name}' created successfully.");
    }

    public function edit(Company $company)
    {
        return view('super-admin.companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:companies,email,' . $company->id],
            'whatsapp_number' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'in:active,inactive,blocked'],
            'approval_status' => ['required', 'in:pending,approved,rejected'],
        ]);

        $company->update([
            'name' => $validated['name'],
            'contact_person' => $validated['contact_person'] ?? null,
            'email' => $validated['email'],
            'whatsapp_number' => $validated['whatsapp_number'] ?? null,
            'status' => $validated['status'],
            'approval_status' => $validated['approval_status'],
        ]);

        return redirect()
            ->route('super.companies.index')
            ->with('success', "Company '{$company->name}' updated successfully.");
    }

    public function approve(Company $company): RedirectResponse
    {
        $company->update([
            'approval_status' => 'approved',
            'status' => 'active',
        ]);

        return back()->with('success', "Company '{$company->name}' approved and activated successfully.");
    }

    public function reject(Company $company): RedirectResponse
    {
        $company->update([
            'approval_status' => 'rejected',
            'status' => 'inactive',
        ]);

        return back()->with('success', "Company '{$company->name}' rejected successfully.");
    }

    public function activate(Company $company): RedirectResponse
    {
        $company->update([
            'status' => 'active',
        ]);

        return back()->with('success', "Company '{$company->name}' activated successfully.");
    }

    public function deactivate(Company $company): RedirectResponse
    {
        $company->update([
            'status' => 'inactive',
        ]);

        return back()->with('success', "Company '{$company->name}' deactivated successfully.");
    }

    public function block(Company $company): RedirectResponse
    {
        $company->update([
            'status' => 'blocked',
        ]);

        return back()->with('success', "Company '{$company->name}' blocked successfully.");
    }
}