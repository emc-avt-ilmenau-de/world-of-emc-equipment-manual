<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    public function setLocale($locale)
{
    // Check if the locale is valid
    if (in_array($locale, ['en', 'de'])) {
        session(['locale' => $locale]); // Set the locale in the session
        session()->save(); // Ensure the session is saved
        Log::info('Locale set via controller: ' . $locale);
        Log::info('Session after setting locale: ', session()->all()); // Log session content
    } else {
        Log::warning('Invalid locale attempted: ' . $locale);
    }

    return redirect()->back(); // Redirect back to the previous page
}



}
