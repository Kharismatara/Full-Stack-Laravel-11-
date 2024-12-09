<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil API Key dari header
        $apiKey = $request->header('X-API-KEY');

        // Periksa apakah API Key ada dan valid
        if (!$apiKey || !ApiKey::where('key', $apiKey)->exists()) {
            // Jika tidak valid, kirimkan response Unauthorized
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Jika API Key valid, lanjutkan permintaan ke middleware berikutnya
        return $next($request); // Pastikan ada return di sini untuk melanjutkan request
    }
}