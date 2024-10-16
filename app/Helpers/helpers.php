<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('hasInternetConnection')) {
    function hasInternetConnection()
    {
        try {
            // Ping Google or another reliable service
            Http::get('https://www.google.com');

            // Return true if successful
            return true;
        } catch (\Exception $e) {
            // Return false if the request fails
            return false;
        }
    }
}
