<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Group;

class CheckGroupsExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $groupsExist = Group::exists();

        if (!$groupsExist && $request->route()->named('users.create')) {
            return redirect()->route('groups.create');
        }

        return $next($request);
    }
}
