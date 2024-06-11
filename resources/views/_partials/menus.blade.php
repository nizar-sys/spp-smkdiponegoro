@php
    $routeActive = Route::currentRouteName();
    $level = Auth::user()->role ?? 'siswa';
@endphp
@if ($level == 'siswa')
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'dashboard-siswa' ? 'active' : '' }}" href="{{ route('dashboard-siswa') }}">
            <i class="ni ni-tv-2 text-primary"></i>
            <span class="nav-link-text">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'history-spp' ? 'active' : '' }}" href="{{ route('history-spp') }}">
            <i class="fas fa-money-bill-wave text-warning"></i>
            <span class="nav-link-text">History Pembayaran</span>
        </a>
    </li>
@else
    <li class="{{ $routeActive == 'home' ? 'active' : '' }}">
        <a href="{{ route('home') }}">
            <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="{{ $routeActive == 'users.index' ? 'active' : '' }}">
        <a href="{{ route('users.index') }}">
            <i class="fa fa-users"></i> <span>Data Pengguna</span>
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
@endif
