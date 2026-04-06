<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $aspirations = Aspiration::with('category')->where('user_id', Auth::id())->latest()->paginate(3);
        $allAspirations = Aspiration::where('user_id', Auth::id())->count();
        $pendingAspirations = Aspiration::where('user_id', Auth::id())->where('status', 'Menunggu')->count();
        $processedAspirations = Aspiration::where('user_id', Auth::id())->where('status', 'Proses')->count();
        $resolvedAspirations = Aspiration::where('user_id', Auth::id())->where('status', 'Selesai')->count();

        return view('student.homepage', compact('aspirations', 'allAspirations', 'pendingAspirations', 'processedAspirations', 'resolvedAspirations'));
    }
}
