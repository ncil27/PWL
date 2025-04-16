@extends('coba-template.try-temp');
@section('page-title', "Dashboard")

@section('content')

{{-- header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3>Halo, {{ Auth::user()->name }}!</h3>
        <p class="text-muted">
            Admin |
            Program Studi: {{ Auth::user()->programStudi->program_studi ?? 'Tidak Diketahui' }}
        </p>
    </div>
</div>


{{-- ini tombol user manager --}}
<div class="col-md-6 col-6">
    <div class="card mx-3">
        <div class="card-content">
            <div class="card-body">
                <div class="form-group">
                    <h4 class="card-title">User Manager</h4>
                        <p> Menambah user baru, mengubah data user yang sudah ada, mengaktifkan ataupun menonaktifkan user </p>
                        <a href="{{ route('admin.manage-user') }}" class="btn btn-primary block">
                            Manage User
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- ini tombol user manager --}}
<div class="col-md-6 col-6">
    <div class="card mx-3">
        <div class="card-content">
            <div class="card-body">
                <div class="form-group">
                    <h4 class="card-title">Data Manager</h4>
                        <p> Menambah, mengubah data Program Studi, serta Jenis Surat </p>
                        <a href="{{ route('admin.manage-user') }}" class="btn btn-primary block">
                            Manage Data
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection