<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirationController extends Controller
{
    public function index(Request $request)
    {
        $aspirations = Aspiration::with(['category:id,category_name', 'user:id,full_name,class'])
            ->when($request->search, function($query, $search){
                    $query->where(function ($q) use ($search){
                        $q->where('title', 'like', '%' . $search . '%')
                            ->orWhere('location', 'like', '%' . $search . '%')
                                ->orWhereHas('user', function($userQuery) use ($search){
                                    $userQuery->where('full_name', 'like', '%' . $search . '%')
                                                    ->orWhere('class', 'like', '%' . $search . '%');
                                });
                    });
            })->when($request->start_date, function($query, $startDate){
                $query->where('created_at', '>=', $startDate . ' 00:00:00');
            })->when($request->end_date, function($query, $endDate){
                $query->where('created_at', '<=', $endDate . ' 23:59:59');
            })->when($request->category_id, function($query, $categoryId){
                $query->where('category_id', $categoryId);
            })->when($request->status, function($query, $status){
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

            $categories = Category::all();
            $users = User::all();

        return view('admin.aspirations.index', compact('aspirations', 'categories', 'users'));
    }

    public function show($id)
    {
        $aspiration = Aspiration::with(['user', 'category', 'feedbacks'])->findOrFail($id);
        return view('admin.aspirations.detail', compact('aspiration'));
    }

    public function storeFeedback(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|string',
            'status' => 'nullable|string'
        ]);

        $aspiration = Aspiration::findOrFail($id);

        if($aspiration->status === 'Ditolak'){
            return back()->withErrors(['error' => 'Aspirasi dengan status yang sudah Ditolak tidak dapat diubah.']);
        }else if($aspiration->status === 'Selesai'){
            return back()->withErrors(['error' => 'Aspirasi dengan status yang sudah Selesai tidak dapat diubah.']);
        }

        if($request->filled('status')){
            $aspiration->update([
                'status' => ucfirst($request->status)
            ]);
        }

        Feedback::create([
            'user_id' => Auth::id(),
            'aspiration_id' => $aspiration->id,
            'description' => $request->feedback
        ]);

        return redirect()->back()->with('success', 'Umpan balik berhasil dikirim.');
    }
}
