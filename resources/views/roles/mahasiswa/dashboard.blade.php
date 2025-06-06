@extends('coba-template.mahasiswa');
@section('page-title', "Dashboard")


@section('content')
{{-- 
<h3>Halo, {{ Auth::user()->name }}!</h3>
<p>Ini adalah halaman dashboard untuk kamu, {{ Auth::user()->name }}.</p>
<p>Selamat datang di sistem pengajuan surat akademik. Di sini, kamu bisa dengan mudah mengajukan berbagai jenis surat yang dibutuhkan, melihat riwayat pengajuan, serta memantau status proses persetujuan secara real-time.</p>

<br><br><br> --}}

{{-- header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3>Halo, {{ Auth::user()->name }}!</h3>
        <p class="text-muted">
            Program Studi: {{ Auth::user()->programStudi->program_studi ?? 'Tidak Diketahui' }} | 
            NRP: {{ Auth::user()->id_user }}
        </p>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    {{-- main --}}
{{-- ini tombol pengajuan surat --}}
<div class="col-md-6 col-6">
    <div class="card mx-3">
        <div class="card-content">
            <div class="card-body">
                <div class="form-group">
                    <h4 class="card-title">Pengajuan Surat</h4>
                    <p> Pengajuan surat dan dokumen keperluan Mahasiswa</p>
                    <!-- Button trigger for form modal -->
                    <button type="button" class="btn btn-primary block" data-bs-toggle="modal"
                        data-bs-target="#inlineForm">
                        + Ajukan Surat
                    </button>

                    <!-- form Modal -->
                    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">Pengajuan Surat</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ route('pengajuan.redirect') }}" method="POST">
                                    @csrf                                    
                                    <div class="modal-body">
                                        <div class="col-md-12 mb-12">
                                            <h6>Jenis Surat</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" name="kode_surat">
                                                    @foreach($jenisSurat as $surat)
                                                        <option value="{{ $surat->kode_surat }}">{{ $surat->jenis_surat }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Back</button>
                                        <button type="submit" class="btn btn-primary ms-1">Next</button>
                                    </div>
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ini tombol riwayat surat --}}
<div class="col-md-6 col-6">
<div class="card mx-3">
    <div class="card-content">
        <div class="card-body">
            <div class="form-group">
                <h4 class="card-title">Riwayat Pengajuan</h4>
                    <p> Pengajuan surat akademik yang pernah diajukan </p>
                    <!-- Button trigger for form modal -->
                    <a href="{{ route('mahasiswa.riwayat') }}" class="btn btn-primary block">
                        Lihat Riwayat
                    </a>
            </div>
        </div>
    </div>
</div>
</div>


</div>

@endsection
@section('js_bwh')
@if (session('success'))
<script>
    Toastify({
        text: "{{ session('success') }}",
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right", 
        backgroundColor: "#4CAF50",
        stopOnFocus: true,
    }).showToast();
</script>
@endif
    
@endsection