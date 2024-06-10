@extends('layouts.app')
@section('title', 'Data Spp')

@section('title-header', 'Data Spp')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Spp</li>
@endsection

@section('action_btn')
    <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#monthYearModal">Filter</button>
    @if (request()->has('monthYear'))
        <a href="{{ route('data-spp.index') }}" class="btn btn-sm btn-danger">Reset</a>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Data Spp Tahun {{ $yearSelected }}</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover" id="table-spp">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Nis</th>
                                    @foreach ($months as $month)
                                        <th>Bulan</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Bayar</th>
                                        <th>ID Transaksi</th>
                                        <th>Keterangan</th>
                                        <th></th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    use Carbon\Carbon;
                                    use App\Helpers\TranslateMonth;

                                    // Precompute due dates and labels
                                    $currentYear = $yearSelected;
                                    $dueDates = [];
                                    foreach ($months as $month) {
                                        $dueDates[$month] = Carbon::parse(
                                            '01-' . TranslateMonth::translate($month),
                                        )->addDay(7);
                                    }
                                @endphp

                                @forelse ($students as $student)
                                    <tr>
                                        <td>{{ $student->nama }}</td>
                                        <td>{{ $student->nis }}</td>
                                        @foreach ($months as $month)
                                            @php
                                                // Precompute values for the current month
                                                $isLunas =
                                                    isset($sppsByMonth[$student->nama][$month]) &&
                                                    $sppsByMonth[$student->nama][$month] == 'lunas';
                                                $spp = $student
                                                    ->spps()
                                                    ->whereBulan($month)
                                                    ->whereTahun($currentYear)
                                                    ->whereStatus('lunas')
                                                    ->first();
                                                $paymentDate = $isLunas
                                                    ? optional($spp->onePembayaran)->tgl_bayar
                                                    : null;
                                                $formattedDate = $paymentDate
                                                    ? Carbon::parse($paymentDate)->format('Y-m-d')
                                                    : '';

                                                // Calculate due status
                                                $dueDate = $dueDates[$month];
                                                $isDue = !$isLunas && Carbon::now()->greaterThanOrEqualTo($dueDate);

                                                // Transaction code (optional)
                                                $transactionCode = $isLunas
                                                    ? optional($spp->onePembayaran)->kd_transaksi
                                                    : '';
                                            @endphp
                                            <td>{!! '<div class="text-dark">' . ucfirst($month) . ' ' . $currentYear . '</div>' !!}</td>
                                            <td>{{ $dueDate->format('Y-m-d') }}</td>
                                            <td>@currency(400000)</td>
                                            <td>{!! $formattedDate !!}</td>
                                            <td>{{ $transactionCode }}</td>
                                            <td>
                                                @if ($isLunas)
                                                    <span class="badge badge-success">Lunas</span>
                                                @else
                                                    @if ($isDue)
                                                        <span class="badge badge-danger">Jatuh Tempo</span>
                                                    @else
                                                        <span class="badge badge-warning">Belum Bayar</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                {!! $isLunas
                                                    ? ''
                                                    : '<button class="btn btn-sm btn-primary btn-pay-spp" data-id="' .
                                                        $student->id .
                                                        '" data-month="' .
                                                        $month .
                                                        '">Bayar</button>' !!}
                                            </td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ 2 + count($months) * 6 }}">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-form-payment" tabindex="-1" role="dialog" aria-labelledby="modal-form-payment"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-default text-gradient">Bayar SPP</h3>
                        </div>
                        <div class="card-body">
                            <form role="form text-left" method="post" action="{{ route('data-spp.payment') }}">
                                @csrf
                                <input type="hidden" name="siswa_id" value="">

                                <div class="row">
                                    <div class="col-12">
                                        <label for="nominal">Nominal SPP</label>
                                        <div class="form-group input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                            </div>
                                            <input type="text"
                                                class="form-control @error('nominal') is-invalid @enderror" id="nominal"
                                                placeholder="Nominal SPP" value="{{ old('nominal', 400000) }}"
                                                name="nominal" readonly>

                                            @error('nominal')
                                                <div class="d-block invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <label for="bulan_dibayar">Bulan Dibayar SPP</label>
                                            <input type="text"
                                                class="form-control @error('bulan_dibayar') is-invalid @enderror"
                                                id="bulan_dibayar" placeholder="Bulan Dibayar SPP"
                                                value="{{ old('bulan_dibayar') }}" name="bulan_dibayar" readonly>

                                            @error('bulan_dibayar')
                                                <div class="d-block invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <label for="tahun_dibayar">Tahun Dibayar SPP</label>
                                            <input type="text"
                                                class="form-control @error('tahun_dibayar') is-invalid @enderror"
                                                id="tahun_dibayar" placeholder="Tahun Dibayar SPP"
                                                value="{{ old('tahun_dibayar', $yearSelected) }}" name="tahun_dibayar"
                                                readonly>

                                            @error('tahun_dibayar')
                                                <div class="d-block invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="jumlah_bayar">Jumlah Bayar SPP</label>
                                        <div class="form-group input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                            </div>
                                            <input type="number"
                                                class="form-control @error('jumlah_bayar') is-invalid @enderror"
                                                id="jumlah_bayar" placeholder="Jumlah Bayar SPP"
                                                value="{{ old('jumlah_bayar') }}" name="jumlah_bayar">

                                            @error('jumlah_bayar')
                                                <div class="d-block invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-round bg-gradient-default text-white btn-lg w-100 mt-4 mb-0">Bayar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="monthYearModal" tabindex="-1" role="dialog" aria-labelledby="monthYearModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="monthYearModalLabel">Filter Bulan - Tahun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="GET" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="monthYear">Pilih Bulan - Tahun</label>
                            <input type="month" class="form-control" id="monthYear" name="monthYear" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ mix('/js/dashboard/spps/script.js') }}"></script>
@endsection
