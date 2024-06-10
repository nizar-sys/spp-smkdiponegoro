<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateKelas;
use Illuminate\Support\Facades\Hash;

class KelasController extends Controller
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
        $classes = Kelas::orderByDesc('id');
        $classes = $classes->paginate(50);

        return view('dashboard.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.classes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateKelas $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $class = Kelas::create($validated);

        return redirect(route('classes.index'))->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Kelas::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = Kelas::findOrFail($id);

        return view('dashboard.classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateKelas $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $class = Kelas::findOrFail($id);

        $class->update($validated);

        return redirect(route('classes.index'))->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Kelas::findOrFail($id);
        $class->delete();

        return redirect(route('classes.index'))->with('success', 'Kelas berhasil dihapus.');
    }
}
