<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $today = now()->toDateString();

        // Cek apakah IP ini sudah berkunjung hari ini
        $sudahBerkunjung = Visitor::where('ip_address', $ip)
            ->whereDate('visit_date', $today)
            ->exists();

        // Jika belum, baru dicatat
        if (!$sudahBerkunjung) {
            Visitor::create([
                'ip_address' => $ip,
                'visit_date' => $today,
                'visited_at' => now(),
            ]);
        }

        return $next($request);
    }
}