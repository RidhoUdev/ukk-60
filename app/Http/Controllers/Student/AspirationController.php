<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\AspirationRequest;
use App\Models\Aspiration;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AspirationController extends Controller
{
    public function index(Request $request)
    {
        $aspirations = Aspiration::with('category')
            ->where('user_id', Auth::id())
                ->when($request->search, function($query, $search){
                    $query->where(function ($q) use ($search){
                        $q->where('title', 'like', '%' . $search . '%')
                            ->orWhere('description', 'like', '%' . $search . '%')
                                ->orWhere('location', 'like', '%' . $search . '%')
                                    ->orWhereHas('category', function ($categoryQuery) use ($search){
                                        $categoryQuery->where('category_name', 'like', '%' . $search . '%');
                                    });
                    });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $categories = Category::all();

        return view('student.aspirations.index', compact('aspirations', 'categories'));
    }

    public function show($id)
    {
        $aspiration = Aspiration::with(['user', 'category', 'feedbacks'])->findOrFail($id);
        if($aspiration->user_id !== Auth::id())
            abort(403, 'Anda tidak memiliki izin untuk mengakses data berikut.');

        return view('student.aspirations.detail', compact('aspiration'));
    }

    public function store(AspirationRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['status'] = 'Menunggu';

        if($request->hasFile('photo')){
            $data['photo'] = $request->file('photo')->store('aspirations', 'public');
        }

        $aspiration = Aspiration::create($data);
        $userAdmin = User::where('role', 'admin')->first();

        $aspiration->feedbacks()->create([
            'user_id' => $userAdmin->id,
            'aspiration_id' => $aspiration->id,
            'description' => 'Laporan sudah diteruskan dan sedang menunggu untuk di verifikasi.'
        ]);

        return redirect()->route('siswa.aspirasi.index')->with('success', 'Laporan berhasil ditambahkan!');

    }

    public function update(AspirationRequest $request, Aspiration $aspirasi)
    {
        if($aspirasi->user_id !== Auth::id())
            abort(403, 'Anda tidak memiliki izin untuk memperbarui data berikut.');
        if($aspirasi->status !== 'Menunggu')
            return back()->withErrors(['error' => 'Laporan yang telah ditindak lanjuti tidak dapat diperbarui.']);

        $data = $request->validated();

        if($aspirasi->photo){
            Storage::disk('public')->delete($aspirasi->photo);
            if($request->hasFile('photo')){
                $data['photo'] = $request->file('photo')->store('aspirations', 'public');
            }
        }

        $aspirasi->update($data);

        return redirect()->route('siswa.aspirasi.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy(Aspiration $aspirasi)
    {
        if($aspirasi->user_id !== Auth::id())
            abort(403, 'Anda tidak memiliki izin untuk menghapus data berikut.');
        if($aspirasi->status !== 'Menunggu')
            return back()->withErrors(['error' => 'Laporan yang telah ditindak lanjuti tidak dapat dihapus.']);
        if($aspirasi->photo){
            Storage::disk('public')->delete($aspirasi->photo);
        }

        $aspirasi->delete();

        return redirect()->route('siswa.aspirasi.index')->with('success', 'Laporan berhasil dihapus!');
    }
}
