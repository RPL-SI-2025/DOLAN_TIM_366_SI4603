<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Badge;

class BadgeController extends Controller
{
    public function index()
    {
        $badges = Auth::check() ? Auth::user()->badges : collect();
        return view('badge.index', compact('badges'));
    }
}
