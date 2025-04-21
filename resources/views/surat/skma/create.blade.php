@extends('coba-template.mahasiswa')
@section('page-title', 'Surat Keterangan Mahasiswa Aktif')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/extensions/toastify-js/src/toastify.css') }}"> 



@endsection
@section('content')
<div class="page-heading">
    <h3>Surat Keterangan Mahasiswa Aktif</h3>
    <p>Form untuk mengajukan Surat Keterangan Mahasiswa Aktif</p>
    {{-- <a href="{{ route('pengajuan.destroyTemporary', $id_pengajuan) }}" class="btn btn-primary mb-3" id="back">Kembali</a> --}}
    <button type="button" id="btnBackDashboard" class="btn btn-primary mb-3">Kembali</button>
</div>

<section id="form-layouts">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Surat Keterangan Mahasiswa Aktif</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('surat.skma.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_pengajuan" value="{{ $id_pengajuan }}">

                            <div class="row">    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Nama Lengkap</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NRP</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->id_user }}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="semester">Semester</label>
                                        <select name="semester" id="semester" class="form-select" required>
                                            <option value="">Pilih Semester</option>
                                            @for ($i = 1; $i <= 14; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_periode">Periode</label>
                                        <select id="id_periode" class="form-select" name="id_periode" required>
                                            <option value="">Pilih Periode</option>
                                            @foreach ($periode as $p)
                                                <option value="{{ $p->id_periode }}">{{ $p->nama_periode }}</option>
                                            @endforeach

                                        </select>
                                        
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="keperluan">Keperluan</label>
                                        <input type="text" name="keperluan" id="keperluan" class="form-control" placeholder="Keperluan Pengajuan" required>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1" id="top-right" btn-outline-primary btn-block btn-lg>Ajukan</button>
                                    <button type="reset" class="btn btn-light-secondary">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js_bwh')
<script>
    document.getElementById('btnBackDashboard').addEventListener('click', function () {
        Swal.fire({
            title: 'Yakin kembali ke Dashboard?',
            text: "Data pengajuan akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, kembali dan hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke route yang akan menghapus data pengajuan
                window.location.href = "{{ route('pengajuan.destroyTemporary', $id_pengajuan) }}";
            }
        })
    });
</script>
@endsection