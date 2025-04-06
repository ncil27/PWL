{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h3>Form Pengajuan Surat Keterangan Mahasiswa Aktif</h3>
    <form action="{{ route('surat.skma.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="keperluan" class="form-label">Keperluan</label>
            <input type="text" class="form-control" id="keperluan" name="keperluan">
        </div>
        <button type="submit" class="btn btn-primary">Ajukan</button>
    </form>
</div>
@endsection --}}

@extends('coba-template.mahasiswa')

@section('page-title', 'Surat Keterangan Mahasiswa Aktif')

@section('content')
<div class="page-heading">
    <h3>Surat Keterangan Mahasiswa Aktif</h3>
    <p>Form untuk mengajukan Surat Keterangan Mahasiswa Aktif</p>
    {{-- <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">Kembali</a> --}}
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
                                    <button type="submit" class="btn btn-primary me-1">Ajukan</button>
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
