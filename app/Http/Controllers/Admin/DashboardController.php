<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $aspirations = Aspiration::with('user')->latest()->paginate(5);
        $allAspirations = Aspiration::count();
        $pendingAspirations = Aspiration::where('status', 'Menunggu')->count();
        $processedAspirations= Aspiration::where('status', 'Proses')->count();
        $resolvedAspirations= Aspiration::where('status', 'Selesai')->count();

        return view('admin.dashboard', compact('aspirations', 'allAspirations', 'pendingAspirations', 'processedAspirations', 'resolvedAspirations'));
    }
}
