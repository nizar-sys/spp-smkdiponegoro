@extends('layouts.app')
@section('title', 'Ubah Data Kelas')

@section('title-header', 'Ubah Data Kelas')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">Data Kelas</a></li>
    <li class="breadcrumb-item active">Ubah Data Kelas</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulir Ubah Data Kelas</h3>
                </div>
                <form action="{{ route('classes.update', $class->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group mb-3">
                                    <label for="kelas">Kelas / Tingkatan</label>
                                    <input type="text" class="form-control @error('kelas') is-invalid @enderror"
                                        id="kelas" name="kelas" value="{{ old('kelas', $class->kelas) }}">
                                    @error('kelas')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nominal_spp">Nominal SPP</label>
                                    <input type="number" class="form-control @error('nominal_spp') is-invalid @enderror"
                                        id="nominal_spp" name="nominal_spp" value="{{ old('nominal_spp', $class->nominal_spp) }}">
                                    @error('nominal_spp')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-6">

                                <div class="form-group mb-3">
                                    <label for="kompetensi_keahlian">Kompetensi Keahlian atau Jurusan</label>
                                    <input type="text"
                                        class="form-control @error('kompetensi_keahlian') is-invalid @enderror"
                                        id="kompetensi_keahlian" name="kompetensi_keahlian"
                                        value="{{ old('kompetensi_keahlian', $class->kompetensi_keahlian) }}">
                                    @error('kompetensi_keahlian')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="kode_kelas">Kode Kelas</label>
                                    <input type="text" class="form-control @error('kode_kelas') is-invalid @enderror"
                                        id="kode_kelas" name="kode_kelas" value="{{ old('kode_kelas', $class->kode_kelas) }}">
                                    @error('kode_kelas')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tahun_ajaran">Tahun Ajaran</label>
                            <input type="number" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran',$class->tahun_ajaran) }}">
                            @error('tahun_ajaran')
                                <div class="d-block text-danger">{{ $message }}</div>
                            @enderror
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
