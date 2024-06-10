@extends('layouts.app')
@section('title', 'Ubah Data SPP')

@section('title-header', 'Ubah Data SPP')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('data-spp.index') }}">Data SPP</a></li>
    <li class="breadcrumb-item active">Ubah Data SPP</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Ubah Data SPP</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('data-spp.update', $spp->id) }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="siswa_id">Siswa</label>
                                    <select class="form-control @error('siswa_id') is-invalid @enderror" id="siswa_id"
                                        name="siswa_id">
                                        <option value="" selected>---Siswa---</option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}"
                                                @if (old('siswa_id', $spp->siswa_id) == $student->id) selected @endif>
                                                {{ $student->nama . ' | ' . $student->namaKelas }}</option>
                                        @endforeach
                                    </select>

                                    @error('siswa_id')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="nominal">Nominal Spp</label>
                                    <input type="number" class="form-control @error('nominal') is-invalid @enderror"
                                        id="nominal" placeholder="Nominal Spp Siswa" value="{{ old('nominal', $spp->nominal) }}"
                                        name="nominal">

                                    @error('nominal')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <label for="tanggal">Tangal Spp Siswa</label>
                                    <select class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                        name="tanggal">
                                        <option value="" selected>---Tangal---</option>
                                        @foreach (range(1, $daysInThisMonth) as $tanggal)
                                            <option value="{{ $tanggal }}"
                                                @if (old('tanggal', $spp->tanggal) == $tanggal || date('d') == $tanggal) selected @endif>
                                                {{ ucfirst($tanggal) }}</option>
                                        @endforeach
                                    </select>

                                    @error('tanggal')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <label for="bulan">Bulan Spp Siswa</label>
                                    <select class="form-control @error('bulan') is-invalid @enderror" id="bulan"
                                        name="bulan">
                                        <option value="" selected>---Bulan---</option>
                                        @php
                                            $months = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];
                                        @endphp
                                        @foreach ($months as $bulan)
                                            <option value="{{ $bulan }}"
                                                @if (old('bulan', $spp->bulan) == $bulan) selected @endif>
                                                {{ ucfirst($bulan) }}</option>
                                        @endforeach
                                    </select>

                                    @error('bulan')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <label for="tahun">Tahun Spp</label>
                                    <select class="form-control @error('tahun') is-invalid @enderror" id="tahun"
                                        name="tahun">
                                        <option value="" selected>---Tahun---</option>
                                        @for ($year = (int) date('Y'); 1900 <= $year; $year--)
                                            <option value="{{ $year }}"
                                                @if ($year == (int) date('Y') || old('year', $spp->tahun) == $year) selected @endif>{{ $year }}
                                            </option>
                                        @endfor
                                    </select>

                                    @error('tahun')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                                <a href="{{ route('data-spp.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
