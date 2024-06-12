<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem SPP SMK Diponegoro | Beranda</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: #217170;
            font-family: Lato, Helvetica, Arial, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        #navbar {
            background: #217170;
            color: rgb(13, 26, 38);
        }

        #navbar .nav-link:hover {
            color: #000;
        }

        .menuIcon {
            cursor: pointer;
            display: block;
            position: fixed;
            right: 15px;
            top: 20px;
            height: 23px;
            width: 27px;
            z-index: 12;
        }

        .icon-bars {
            background: rgb(13, 26, 38);
            height: 2px;
            width: 20px;
            position: absolute;
            left: 1px;
            top: 45%;
            transition: 0.4s;
        }

        .icon-bars::before,
        .icon-bars::after {
            content: '';
            background: rgb(13, 26, 38);
            position: absolute;
            height: 2px;
            width: 20px;
            transition: 0.4s;
        }

        .icon-bars::before {
            top: -8px;
        }

        .icon-bars::after {
            top: 8px;
        }

        .menuIcon.toggle .icon-bars {
            transform: translate3d(0, 5px, 0) rotate(135deg);
        }

        .menuIcon.toggle .icon-bars::before {
            top: 0;
            opacity: 0;
        }

        .menuIcon.toggle .icon-bars::after {
            top: 0;
            transform: translate3d(0, -10px, 0) rotate(-270deg);
        }

        .overlay-menu {
            background: lightblue;
            color: rgb(13, 26, 38);
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 0;
            right: 0;
            transform: translateX(-100%);
            width: 100vw;
            height: 100vh;
            transition: transform 0.2s ease-out;
        }

        .overlay-menu ul,
        .overlay-menu li {
            display: block;
        }

        .overlay-menu li a {
            font-size: 1.8em;
            letter-spacing: 4px;
            padding: 10px 0;
            text-transform: uppercase;
            transition: color 0.3s ease;
        }

        .overlay-menu li a:hover,
        .overlay-menu li a:active {
            color: rgb(28, 121, 184);
        }
    </style>
</head>

<body>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('/assets/img/logo.png') }}" alt="logo" width="200">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 9rem">
        <div class="row justify-content-center text-center">
            <div class="col-md-12">
                <img src="{{ asset('/assets/img/logo-2.png') }}" alt="illustration" width="170" class="mb-4">
                <h1 class="text-white">Aplikasi <br> SPP SMK Diponegoro</h1>
            </div>
        </div>
        <div class="row justify-content-center text-center mt-3">
            <div class="col-md-6">
                <form action="" method="GET">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="month" class="form-control" name="monthYear" placeholder="Bulan" required
                            value="{{ request()->filled('monthYear') ? request()->monthYear : '' }}">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nis"
                            placeholder="NIS: 1235567"value="{{ request()->filled('nis') ? request()->nis : '' }}"
                            required>
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row justify-content-center mt-3 {{ request()->filled('nis') ? '' : 'd-none' }}">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-flush table-bordered" id="table-spp">
                        <thead>
                            <tr class="text-dark">
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
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="text-white">
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

    <div class="menuIcon">
        <span class="icon icon-bars"></span>
        <span class="icon icon-bars overlay"></span>
    </div>

    <div class="overlay-menu">
        <ul class="menu">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        // Navigation
        // Responsive Toggle Navigation =============================================
        let menuIcon = document.querySelector('.menuIcon');
        let nav = document.querySelector('.overlay-menu');

        menuIcon.addEventListener('click', () => {
            if (nav.style.transform != 'translateX(0%)') {
                nav.style.transform = 'translateX(0%)';
                nav.style.transition = 'transform 0.2s ease-out';
            } else {
                nav.style.transform = 'translateX(-100%)';
                nav.style.transition = 'transform 0.2s ease-out';
            }
        });

        // Toggle Menu Icon ========================================
        let toggleIcon = document.querySelector('.menuIcon');

        toggleIcon.addEventListener('click', () => {
            if (toggleIcon.className != 'menuIcon toggle') {
                toggleIcon.className += ' toggle';
            } else {
                toggleIcon.className = 'menuIcon';
            }
        });

        $(document).ready(() => {
            $("#table-spp").DataTable({
                dom: 'rtip',
            });
        });
    </script>
</body>

</html>
