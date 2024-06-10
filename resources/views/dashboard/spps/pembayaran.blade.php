@extends('layouts.app')
@section('title', 'Pembayaran Data SPP')

@section('title-header', 'Pembayaran Data SPP')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('data-spp.index') }}">Data SPP</a></li>
    <li class="breadcrumb-item active">Pembayaran Data SPP</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Pembayaran Data SPP</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('data-spp.pembayaran-store', ['sppId' => $spp->id]) }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="siswa_id">Siswa</label>
                                    <select class="form-control @error('siswa_id') is-invalid @enderror" id="siswa_id"
                                        name="siswa_id">
                                        <option selected value="{{$spp->siswa->id}}">{{ $spp->siswa->nama . ' | ' . $spp->siswa->namaKelas }}</option>
                                    </select>

                                    @error('siswa_id')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="bulan_dibayar">Bulan Spp Dibayar</label>
                                    <input type="text" class="form-control @error('bulan_dibayar') is-invalid @enderror"
                                        id="bulan_dibayar" placeholder="Bulan Spp Dibayar Siswa" value="{{$spp->bulan}}"
                                        name="bulan_dibayar" disabled>

                                    @error('bulan_dibayar')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="tahun_dibayar">Tahun Spp Dibayar</label>
                                    <input type="text" class="form-control @error('tahun_dibayar') is-invalid @enderror"
                                        id="tahun_dibayar" placeholder="Tahun Spp Dibayar Siswa" value="{{$spp->tahun}}"
                                        name="tahun_dibayar" disabled>

                                    @error('tahun_dibayar')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="nominal">Nominal Spp</label>
                                    <input type="text" class="form-control @error('nominal') is-invalid @enderror"
                                        id="nominal" placeholder="Nominal Spp Siswa" value="Rp. {{ number_format($spp->nominal, 0, ',', '.') }}"
                                        name="nominal" disabled>

                                    @error('nominal')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="jumlah_bayar">Jumlah Bayar</label>
                                    <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror"
                                        id="jumlah_bayar" placeholder="Jumlah Bayar Spp" value="Rp. {{ number_format($spp->nominal, 0, ',', '.') }}"
                                        name="jumlah_bayar">

                                    @error('jumlah_bayar')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Bayar</button>
                                <a href="{{ route('data-spp.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
