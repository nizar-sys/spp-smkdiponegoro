@extends('layouts.app')
@section('title', 'Tambah Data Kelas')

@section('title-header', 'Tambah Data Kelas')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">Data Kelas</a></li>
    <li class="breadcrumb-item active">Tambah Data Kelas</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Kelas</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('classes.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row justify-content-center align-items-center">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="kelas">Kelas / Tingkatan</label>
                                    <input type="text" class="form-control @error('kelas') is-invalid @enderror"
                                        id="kelas" name="kelas" value="{{ old('kelas') }}">
                                    @error('kelas')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="kode_kelas">Kode Kelas</label>
                                    <input type="text" class="form-control @error('kode_kelas') is-invalid @enderror"
                                        id="kode_kelas" name="kode_kelas" value="{{ old('kode_kelas') }}">
                                    @error('kode_kelas')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="kompetensi_keahlian">Kompetensi Keahlian atau Jurusan</label>
                                    <input type="text"
                                        class="form-control @error('kompetensi_keahlian') is-invalid @enderror"
                                        id="kompetensi_keahlian" name="kompetensi_keahlian"
                                        value="{{ old('kompetensi_keahlian') }}">
                                    @error('kompetensi_keahlian')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nominal_spp">Nominal SPP</label>
                                    <input type="number"
                                        class="form-control @error('nominal_spp') is-invalid @enderror"
                                        id="nominal_spp" name="nominal_spp"
                                        value="{{ old('nominal_spp') }}">
                                    @error('nominal_spp')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row justify-content-center align-items-center">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{ route('classes.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
