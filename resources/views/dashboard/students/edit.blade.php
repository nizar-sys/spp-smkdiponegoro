@extends('layouts.app')
@section('title', 'Ubah Data Siswa')

@section('title-header', 'Ubah Data Siswa')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Data Siswa</a></li>
    <li class="breadcrumb-item active">Ubah Data Siswa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulir Ubah Data Kelas</h3>
                </div>
                <form action="{{ route('students.update', $student->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="box-body">

                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group mb-3">
                                    <label for="nis">NIS</label>
                                    <input type="number" class="form-control @error('nis') is-invalid @enderror"
                                        id="nis" placeholder="NIS Siswa" value="{{ old('nis', $student->nis) }}" name="nis">

                                    @error('nis')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" placeholder="Nama Siswa" value="{{ old('nama', $student->nama) }}" name="nama">

                                    @error('nama')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="kelas_id">Kelas</label>
                            <select class="form-control @error('kelas_id') is-invalid @enderror" id="kelas_id"
                                name="kelas_id">
                                <option value="" selected>Pilih Kelas</option>
                                @foreach ($classes as $kelas)
                                    <option value="{{ $kelas->id }}" @if (old('kelas_id', $student->kelas_id) == $kelas->id) selected @endif>
                                        {{ $kelas->kompetensi_keahlian . ' ' . $kelas->kelas }}</option>
                                @endforeach
                            </select>

                            @error('kelas_id')
                                <div class="d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat Siswa"
                                        name="alamat" cols="30" rows="4">{{ old('alamat', $student->alamat) }}</textarea>

                                    @error('alamat')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group mb-3">
                                    <label for="no_hp">No Telepon</label>
                                    <input type="number" class="form-control @error('no_hp') is-invalid @enderror"
                                        id="no_hp" placeholder="No Telepon Siswa" name="no_hp"
                                        value="{{ old('no_hp', $student->no_hp) }}">

                                    @error('no_hp')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group mb-3">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                                        name="jenis_kelamin">
                                        <option value="" selected>Pilih Jenis Kelamin</option>
                                        @foreach (['Laki-laki', 'Perempuan'] as $jk)
                                            <option value="{{ $jk }}" @if (old('jenis_kelamin', $student->jenis_kelamin) == $jk) selected @endif>
                                                {{ $jk }}</option>
                                        @endforeach
                                    </select>

                                    @error('jenis_kelamin')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group mb-3">
                                    <label for="tempat_tanggal_lahir">Tempat, Tanggal Lahir</label>
                                    <input type="text" class="form-control @error('tempat_tanggal_lahir') is-invalid @enderror"
                                        id="tempat_tanggal_lahir" placeholder="Tempat, Tanggal Lahir Siswa" value="{{ old('tempat_tanggal_lahir', $student->tempat_tanggal_lahir) }}" name="tempat_tanggal_lahir">

                                    @error('tempat_tanggal_lahir')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group mb-3">
                                    <label for="password">Password <small class="text-danger">(jangan masukkan password jika tidak ingin merubah data)</small></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" placeholder="Password Siswa" value="{{ old('password') }}" name="password">

                                    @error('password')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
