@php
    $routeActive = Route::currentRouteName();
    $level = Auth::user()->role ?? 'siswa';
@endphp
@if ($level == 'siswa')
    <li class="{{ $routeActive == 'dashboard-siswa' ? 'active' : '' }}">
        <a href="{{ route('dashboard-siswa') }}">
            <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="{{ $routeActive == 'data-spp.index' ? 'active' : '' }}">
        <a href="{{ route('data-spp.index') }}">
            <i class="fa fa-money"></i> <span>Pembayaran SPP</span>
        </a>
    </li>
@else
    <li class="{{ $routeActive == 'home' ? 'active' : '' }}">
        <a href="{{ route('home') }}">
            <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="{{ $routeActive == 'classes.index' ? 'active' : '' }}">
        <a href="{{ route('classes.index') }}">
            <i class="fa fa-building"></i> <span>Data Kelas</span>
        </a>
    </li>
    <li class="{{ $routeActive == 'students.index' ? 'active' : '' }}">
        <a href="{{ route('students.index') }}">
            <i class="fa fa-users"></i> <span>Data Siswa</span>
        </a>
    </li>
    <li class="{{ $routeActive == 'data-spp.index' ? 'active' : '' }}">
        <a href="{{ route('data-spp.index') }}">
            <i class="fa fa-money"></i> <span>Data SPP</span>
        </a>
    </li>
    <li class="{{ $routeActive == 'laporan-spp.index' ? 'active' : '' }}">
        <a href="{{ route('laporan-spp.index') }}">
            <i class="fa fa-file"></i> <span>Laporan Data SPP</span>
        </a>
    </li>
@endif
<li class="{{ $routeActive == 'history-spp' ? 'active' : '' }}">
    <a href="{{ route('history-spp') }}">
        <i class="fa fa-recycle"></i> <span>History Pembayaran</span>
    </a>
</li>
