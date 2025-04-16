@extends('coba-template.mahasiswa')
@section('page-title', 'Edit Surat Keterangan Lulus')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/extensions/toastify-js/src/toastify.css') }}"> 
@endsection

@section('content')
<div class="page-heading">
    <h3>Edit Surat Keterangan Lulus</h3>
    <p>Form untuk mengubah data pengajuan SKL</p>
    <a href="{{ route('mahasiswa.riwayat') }}" class="btn btn-primary mb-3">Kembali</a>
</div>

<section id="form-layouts">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Data SKL</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('surat.skl.update', $id_pengajuan) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="id_pengajuan" value="{{ $id_pengajuan }}">

                            <div class="row">    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NRP</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->id_user }}" disabled>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="tgl_lulus">Tanggal Lulus</label>
                                        <input type="date" name="tgl_lulus" id="tgl_lulus" class="form-control" value="{{ old('tgl_lulus', $skl->tgl_lulus) }}" required>
                                    </div>
                                </div>                                

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1">Simpan Perubahan</button>
                                    <a href="{{ route('mahasiswa.riwayat') }}" class="btn btn-light-secondary">Batal</a>
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
