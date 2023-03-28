<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\DeliveryCost;
use Closure;
use Illuminate\Http\Request;

class SendAdditionalDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $categories = Category::all();
        $districts = DeliveryCost::orderBy('name_en', 'asc')->get();
        $request->merge(['categories' => $categories, 'districts' => $districts]);
        return $next($request);
    }
}
