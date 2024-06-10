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
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
            <i class="ni ni-tv-2 text-primary"></i>
            <span class="nav-link-text">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
            <i class="fas fa-users text-warning"></i>
            <span class="nav-link-text">Data Pengguna</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'classes.index' ? 'active' : '' }}" href="{{ route('classes.index') }}">
            <i class="fas fa-building text-danger"></i>
            <span class="nav-link-text">Data Kelas</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'students.index' ? 'active' : '' }}" href="{{ route('students.index') }}">
            <i class="fas fa-users text-primary"></i>
            <span class="nav-link-text">Data Siswa</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'data-spp.index' ? 'active' : '' }}" href="{{ route('data-spp.index') }}">
            <i class="fas fa-money-bill-wave text-warning"></i>
            <span class="nav-link-text">Data SPP</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
            <i class="fas fa-user-tie text-success"></i>
            <span class="nav-link-text">Profile</span>
        </a>
    </li>
@endif
