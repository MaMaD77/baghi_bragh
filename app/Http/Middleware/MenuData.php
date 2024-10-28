<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class MenuData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $verticalMenuJson = [
            [
                'navheader' => __('Dashboard'),
                'routeIs' => $request->routeIs(''),
                'permissions' => [null]
            ],
            [
                'route' => route('draw'),
                'name' => __('Draw'),
                'routeIs' => $request->routeIs('draw'),
                'icon' => 'fa fa-desktop',
                'permissions' => [null]
            ],
            [
                'route' => route('user.index'),
                'name' => __('Users'),
                'routeIs' => $request->routeIs('user.*'),
                'icon' => 'fa fa-users',
                'permissions' => [null]
            ],
            [
                'route' => route('project.index'),
                'name' => __('Projects'),
                'routeIs' => $request->routeIs('project.*'),
                'icon' => 'fa fa-desktop',
                'permissions' => [null]
            ],
            // [
            //     'route' => route('performance'),
            //     'name' => __('Performance'),
            //     'routeIs' => $request->routeIs('performance') || $request->routeIs('visit-performance') || $request->routeIs('order-performance') || $request->routeIs('sales-performance') || $request->routeIs('call-performance') || $request->routeIs('order-area-performance'),
            //     'icon' => 'fa fa-chart-line',
            //     'permissions' => ['user:activity-log', 'visit:all', 'call:all'],
            //     'submenu' => [
            //         [
            //             'route' => route('performance'),
            //             'name' => __('Activity'),
            //             'icon' => 'far fa-circle',
            //             'routeIs' => $request->routeIs('performance'),
            //             'permissions' => ['user:activity-log']
            //         ],
            //         [
            //             'route' => route('visit-performance'),
            //             'name' => __('Visit'),
            //             'icon' => 'far fa-circle',
            //             'routeIs' => $request->routeIs('visit-performance'),
            //             'permissions' => ['visit:all']
            //         ],
            //         [
            //             'route' => route('order-performance'),
            //             'name' => __('Order'),
            //             'icon' => 'far fa-circle',
            //             'routeIs' => $request->routeIs('order-performance'),
            //             'permissions' => ['order:all']
            //         ],
            //         [
            //             'route' => route('sales-performance'),
            //             'name' => __('Sales'),
            //             'icon' => 'far fa-circle',
            //             'routeIs' => $request->routeIs('sales-performance'),
            //             'permissions' => ['order:all']
            //         ],
            //         [
            //             'route' => route('call-performance'),
            //             'name' => __('Call'),
            //             'icon' => 'far fa-circle',
            //             'routeIs' => $request->routeIs('call-performance'),
            //             'permissions' => ['call:all']
            //         ],
            //         [
            //             'route' => route('order-area-performance'),
            //             'name' => __('Order Area'),
            //             'icon' => 'far fa-circle',
            //             'routeIs' => $request->routeIs('order-area-performance'),
            //             'permissions' => ['order:all']
            //         ],
            //     ]
            // ],

        ];

        // Share all menuData to all the views
        View::share('menuData', response()->json($verticalMenuJson));

        return $next($request);
    }
}
