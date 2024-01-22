<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $role = Role::tryFrom($role);

        if (! $role instanceof Role) {
            throw new InvalidArgumentException('Role does not exist');
        }

        if ($request->user()?->role !== $role) {
            abort(403, __('You do not have access to this page.'));
        }

        return $next($request);
    }
}
