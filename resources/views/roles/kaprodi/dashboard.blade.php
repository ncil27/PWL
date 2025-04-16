@extends('coba-template.kaprodi');
@section('page-title', "Dashboard")

@section('content')

{{-- header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3>Halo, {{ Auth::user()->name }}!</h3>
        <p class="text-muted">
            Kepala Program Studi |
            Program Studi: {{ Auth::user()->programStudi->program_studi ?? 'Tidak Diketahui' }}
        </p>
    </div>
</div>


{{-- ini tombol riwayat surat --}}
<div class="col-md-6 col-6">
    <div class="card mx-3">
        <div class="card-content">
            <div class="card-body">
                <div class="form-group">
                    <h4 class="card-title">Approval Pengajuan Surat</h4>
                        <p> Melihat dan finalisasi pengajuan surat yang telah disetujui Ketua Program Studi </p>
                        <a href="{{ route('kaprodi.manage-pengajuan') }}" class="btn btn-primary block">
                            Lihat Pengajuan Surat
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection