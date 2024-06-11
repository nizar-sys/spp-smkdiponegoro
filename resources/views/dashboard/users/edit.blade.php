@extends('layouts.app')
@section('title', 'Ubah Data Pengguna')

@section('title-header', 'Ubah Data Pengguna')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Data Pengguna</a></li>
    <li class="breadcrumb-item active">Ubah Data Pengguna</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulir Ubah Data Pengguna</h3>
                </div>
                <form role="form" action="{{ route('users.update', $user->id) }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" placeholder="Nama Pengguna" value="{{ old('name', $user->name) }}"
                                        name="name">

                                    @error('name')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" placeholder="Email Pengguna" value="{{ old('email', $user->email) }}"
                                        name="email">

                                    @error('email')
                                        <div class="d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" placeholder="Username Pengguna" value="{{ old('username', $user->username) }}"
                                name="username">

                            @error('username')
                                <div class="d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
                                @php
                                    $roles = ['admin', 'petugas'];
                                @endphp
                                <option value="" selected>Pilih Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" @if (old('role', $user->role) == $role) selected @endif>
                                        {{ ucfirst($role) }}</option>
                                @endforeach
                            </select>

                            @error('role')
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
