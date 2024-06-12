@extends('layouts.app')
@section('title', 'Data Spp')

@section('title-header', 'Data Spp')
@section('breadcrumb')
    <li class="breadcrumb-item active">Data Spp</li>
@endsection

@section('content')

    <div class="modal fade" id="modal-form-payment" tabindex="-1" role="dialog" aria-labelledby="modal-form-payment"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <form role="form text-left" method="post" action="{{ route('data-spp.payment') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-0">
                        <input type="hidden" name="siswa_id" value="">

                        <label for="nominal">Nominal SPP</label>
                        <div class="form-group input-group mb-3">
                            <div class="input-group-addon">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                            </div>
                            <input type="text" class="form-control @error('nominal') is-invalid @enderror" id="nominal"
                                placeholder="Nominal SPP" value="{{ old('nominal') }}" name="nominal" readonly>

                            @error('nominal')
                                <div class="d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group mb-3">
                                    <label for="bulan_dibayar">Bulan Dibayar SPP</label>
                                    <input type="text" class="form-control @error('bulan_dibayar') is-invalid @enderror"
                                        id="bulan_dibayar" placeholder="Bulan Dibayar SPP"
                                        value="{{ old('bulan_dibayar') }}" name="bulan_dibayar" readonly>

                                    @error('bulan_dibayar')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group mb-3">
                                    <label for="tahun_dibayar">Tahun Dibayar SPP</label>
                                    <input type="text" class="form-control @error('tahun_dibayar') is-invalid @enderror"
                                        id="tahun_dibayar" placeholder="Tahun Dibayar SPP"
                                        value="{{ old('tahun_dibayar', $yearSelected) }}" name="tahun_dibayar" readonly>

                                    @error('tahun_dibayar')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <label for="jumlah_bayar">Jumlah Bayar SPP</label>
                        <div class="form-group input-group mb-3">
                            <div class="input-group-addon">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                            </div>
                            <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror"
                                id="jumlah_bayar" placeholder="Jumlah Bayar SPP" value="{{ old('jumlah_bayar') }}"
                                name="jumlah_bayar" required>

                            @error('jumlah_bayar')
                                <div class="d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="bukti_pembayaran">Bukti Pembayaran</label>
                        <div class="form-group input-group mb-3">
                            <div class="input-group-addon">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-camera"></i></span>
                            </div>
                            <input type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror"
                                id="bukti_pembayaran" placeholder="Bukti Pembayaran" value="{{ old('bukti_pembayaran') }}"
                                name="bukti_pembayaran" required>

                            @error('bukti_pembayaran')
                                <div class="d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                class="btn btn-round btn-primary text-white btn-lg w-100 mt-4 mb-0">Bayar</button>
                        </div>
                    </div>
                </form>
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

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Spp Tahun {{ $yearSelected }}</h3>
                    <div class="pull-right">
                        <button class="btn btn-sm btn-info" data-toggle="modal"
                            data-target="#monthYearModal">Filter</button>
                        @if (request()->has('monthYear'))
                            <a href="{{ route('data-spp.index') }}" class="btn btn-sm btn-danger">Reset</a>
                        @endif
                    </div>
                </div>
                <div class="box-body">
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
                                    <th>Bukti Pembayaran</th>
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
                                            $paymentDate = $isLunas ? optional($spp->onePembayaran)->tgl_bayar : null;
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
                                        <td>@currency($student->kelas->nominal_spp)</td>
                                        <td>{!! $formattedDate !!}</td>
                                        <td>{{ $transactionCode }}</td>
                                        <td>
                                            @if ($isLunas)
                                                <a href="{{ asset('/uploads/images/' . optional($spp->onePembayaran)->bukti_pembayaran) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('/uploads/images/' . optional($spp->onePembayaran)->bukti_pembayaran) }}"
                                                        alt="Bukti Pembayaran" class="img-thumbnail" width="50">
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($isLunas)
                                                <span class="badge bg-green">Lunas</span>
                                            @else
                                                @if ($isDue)
                                                    <span class="badge bg-red">Jatuh Tempo</span>
                                                @else
                                                    <span class="badge bg-orange">Belum Bayar</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            {!! $isLunas
                                                ? '<a target="__blank" href="'.route('data-spp.kwitansi', ['kd_transaksi' => $transactionCode]).'" class="btn-sm btn-primary">Unduh Kwintasi</a>'
                                                : '<button class="btn btn-sm btn-primary btn-pay-spp" data-id="' .
                                                    $student->id .
                                                    '" data-month="' .
                                                    $month .
                                                    '" data-nomimal="' .
                                                    $student->kelas->nominal_spp .
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
@endsection

@section('script')
    {{-- <script src="{{ mix('/js/dashboard/spps/script.js') }}"></script> --}}

    <script>
        function deleteForm(id) {
            Swal.fire({
                title: "Hapus data",
                text: "Anda akan menghapus data!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Batal!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${id}`).submit();
                }
            });
        }

        function paySpp(id, month, nominal) {
            $("#modal-form-payment").modal("show");
            $('#modal-form-payment input[name="siswa_id"]').val(id);
            // simpan month dengan huruf kapital di awal untuk ditampilkan di modal
            const monthCapitalized = month.charAt(0).toUpperCase() + month.slice(1);
            $('#modal-form-payment input[name="bulan_dibayar"]').val(monthCapitalized);
            $('#modal-form-payment input[name="nominal"]').val(nominal);

            $('#modal-form-payment button[type="submit"]').click(function(e) {
                e.preventDefault();
                const nominal = $('#modal-form-payment input[name="nominal"]').val();
                const jumlah_bayar = $(
                    '#modal-form-payment input[name="jumlah_bayar"]'
                ).val();
                const buktiPembayaran = $(
                    '#modal-form-payment input[name="bukti_pembayaran"]'
                ).val();

                if (nominal !== jumlah_bayar) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Jumlah bayar tidak sesuai!",
                    });
                }

                if (buktiPembayaran === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Bukti pembayaran harus diisi!",
                    });
                }

                if (nominal === jumlah_bayar && buktiPembayaran !== "") {
                    $('#modal-form-payment form').submit();
                }
            });

            $("#modal-form-payment").on("hidden.bs.modal", function(e) {
                $('#modal-form-payment input[name="siswa_id"]').val("");
                $('#modal-form-payment input[name="bulan_dibayar"]').val("");
                $('#modal-form-payment input[name="jumlah_bayar"]').val("");
            });
        }

        $(document).ready(() => {
            $("#table-spp").DataTable({
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari Data",
                    lengthMenu: "Menampilkan _MENU_ data",
                    zeroRecords: "Data tidak ditemukan",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ data)",
                    paginate: {
                        previous: '<i class="fa fa-angle-left"></i>',
                        next: "<i class='fa fa-angle-right'></i>",
                    },
                },
                dom: "Bfrtip",
                buttons: [{
                    extend: "pdfHtml5",
                    title: "Data SPP Tahun " + new Date().getFullYear(),
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    className: "btn btn-sm btn-danger",
                    // set alignment option
                    customize: function(doc) {
                        // jika value dari kolom bulan adalah bayar maka ganti dengan kata belum bayar dan dirender dengan warna merah
                        doc.content[1].table.body.forEach((row, index) => {
                            row.forEach((cell, index) => {
                                cell.text =
                                    cell.text === "Bayar" ?
                                    "Belum Lunas" :
                                    cell.text;
                            });
                        });

                        // set warna text untuk data belum bayar
                        doc.content[1].table.body.forEach((row, index) => {
                            row.forEach((cell, index) => {
                                if (cell.text === "Belum Lunas") {
                                    cell.color = "#e74a3b";
                                }
                            });
                        });

                        // atur ukuran kertas menjadi a4
                        doc.pageOrientation = "landscape";
                        doc.pageSize = "A4";
                    },
                }, ],
            });

            $(".btn-pay-spp").click(function() {
                const id = $(this).data("id");
                const month = $(this).data("month");
                const nominal = $(this).data("nomimal");
                paySpp(id, month, nominal);
            });
        });
    </script>
@endsection
