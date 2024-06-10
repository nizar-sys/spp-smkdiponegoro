<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateSiswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{

    public function __construct()
    {
        $this->middleware(['roles:admin'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Siswa::orderByDesc('id');
        $students = $students->paginate(50);

        return view('dashboard.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Kelas::orderByDesc('id')->get();
        return view('dashboard.students.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateSiswa $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $student = Siswa::create($validated);

        return redirect(route('students.index'))->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Siswa::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Siswa::findOrFail($id);
        $classes = Kelas::orderByDesc('id')->get();

        return view('dashboard.students.edit', compact('student', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateSiswa $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $student = Siswa::findOrFail($id);

        $student->update($validated);

        return redirect(route('students.index'))->with('success', 'Siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Siswa::findOrFail($id);
        $student->delete();

        return redirect(route('students.index'))->with('success', 'Siswa berhasil dihapus.');
    }
}
