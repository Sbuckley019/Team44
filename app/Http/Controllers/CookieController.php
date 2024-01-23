<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

class CookieController extends Controller
{
    public function index()
    {
        if (!Cookie::get('guest_id') && !Auth::check()) {
            $uuid = Uuid::uuid4();
            $uniqueId = $uuid->toString();
            Cookie::queue('guest_id', $uniqueId,  time() + (7 * 24 * 60 * 60), '/');
        }
        return view('home');
    }
}
