<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = User::where('role', 'siswa')
            ->when($request->search, function($query, $search){
                $query->where(function ($q) use ($search){
                    $q->where('username', 'like', '%' . $search . '%')
                        ->orWhere('full_name', 'like', '%' . $search . '%')
                            ->orWhere('class', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('admin.students.index', compact('students'));
    }

    public function store(StudentRequest $request)
    {
        $data = $request->validated();
        $data['role'] = 'siswa';

        User::create($data);
        return redirect()->route('admin.siswa.index')->with('success', 'Akun siswa berhasil ditambahkan.');
    }

    public function update(StudentRequest $request, User $siswa)
    {
        $data = $request->validated();
        if(empty($data['password']))
            unset($data['password']);

        $siswa->update($data);
        return redirect()->route('admin.siswa.index')->with('success', 'Akun siswa berhasil diperbarui.');
    }

    public function destroy(User $siswa)
    {
        $siswa->delete();
        return redirect()->route('admin.siswa.index')->with('success', 'Akun siswa berhasil dihapus.');
    }
}
