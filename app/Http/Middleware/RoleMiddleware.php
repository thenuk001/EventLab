<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if (! $user || ! $user->hasRole($role)) {
            abort(403);
        }

        if ($user->hasRole('company_admin')) {
            $company = $user->company;

            if (! $company || $company->status !== 'active' || $company->approval_status !== 'approved') {
                auth()->logout();

                return redirect()
                    ->route('login')
                    ->withErrors([
                        'email' => 'Your company account is not active or approved. Please contact EventLab support.',
                    ]);
            }
        }

        if (isset($user->status) && $user->status !== 'active') {
            auth()->logout();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Your account is inactive or blocked. Please contact EventLab support.',
                ]);
        }

        return $next($request);
    }
}