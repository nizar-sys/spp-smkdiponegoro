@extends('layouts.app')
@section('title', 'Data Siswa')

@section('title-header', 'Data Siswa')
@section('breadcrumb')
    <li class="breadcrumb-item active">Data Siswa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Siswa</h3>
                    <div class="pull-right">
                        <a href="{{ route('students.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>NAMA</th>
                                <th>TAHUN AJARAN</th>
                                <th>TTL</th>
                                <th>JENIS KELAMIN</th>
                                <th>ALAMAT</th>
                                <th>KELAS</th>
                                <th>NO TELEPON</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->nis }}</td>
                                    <td>{{ $student->nama }}</td>
                                    <td>{{ $student->kelas->tahun_ajaran }}</td>
                                    <td>{{ $student->tempat_tanggal_lahir }}</td>
                                    <td>{{ $student->jenis_kelamin }}</td>
                                    <td>{{ $student->alamat }}</td>
                                    <td>{{ $student->nama_kelas }}</td>
                                    <td>{{ $student->no_hp }}</td>
                                    <td width="75">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Aksi</button>
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="{{ route('students.edit', $student->id) }}">
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form id="delete-form-{{ $student->id }}"
                                                        action="{{ route('students.destroy', $student->id) }}" class="d-none"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a href="javascript:void(0)" onclick="deleteForm({{ $student->id }})">
                                                        Hapus
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Tidak ada data</td>
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
    <script>
        function deleteForm(id) {
            Swal.fire({
                title: 'Hapus data',
                text: "Anda akan menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${id}`).submit()
                }
            })
        }

        $(document).ready(() => {
            $("#table").DataTable({
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
            });
        });
    </script>
@endsection
