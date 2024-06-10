@extends('layouts.app')
@section('title', 'Tambah Data Siswa')

@section('title-header', 'Tambah Data Siswa')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Data Siswa</a></li>
    <li class="breadcrumb-item active">Tambah Data Siswa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Siswa</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('students.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="nisn">NISN</label>
                                    <input type="number" class="form-control @error('nisn') is-invalid @enderror" id="nisn"
                                        placeholder="NISN Siswa" value="{{ old('nisn') }}" name="nisn">

                                    @error('nisn')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="nis">NIS</label>
                                    <input type="number" class="form-control @error('nis') is-invalid @enderror"
                                        id="nis" placeholder="NIS Siswa" value="{{ old('nis') }}"
                                        name="nis">

                                    @error('nis')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                        placeholder="Nama Siswa" value="{{ old('nama') }}" name="nama">

                                    @error('nama')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="kelas_id">Kelas</label>
                                    <select class="form-control @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id">
                                        <option value="" selected>---Kelas---</option>
                                        @foreach ($classes as $kelas)
                                            <option value="{{ $kelas->id }}" @if (old('kelas_id') == $kelas->id) selected @endif>
                                                {{ $kelas->kompetensi_keahlian . ' ' . $kelas->kelas }}</option>
                                        @endforeach
                                    </select>

                                    @error('kelas_id')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    placeholder="Alamat Siswa" name="alamat" cols="30" rows="4">{{old('alamat')}}</textarea>

                                    @error('alamat')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="no_hp">No Telepon</label>
                                    <input type="number" class="form-control @error('no_hp') is-invalid @enderror"
                                        id="no_hp" placeholder="No Telepon Siswa"
                                        name="no_hp" value="{{old('no_hp')}}">

                                    @error('no_hp')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{route('students.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
