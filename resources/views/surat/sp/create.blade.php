@extends('coba-template.mahasiswa');
@section('page-title', "Surat Pengantar Tugas")

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('surat.sp.store') }}" method="POST" class="form form-vertical">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Surat Ditujukan Kepada: </label>
                                                <label>Informasikan secara lengkap nama, jabatan, nama perusahaan, dan alamat perusahaan.</label>
                                                <label>(Contoh: Bapak John Doe, Kepala Personalia PT ABC, Jln. Cibogo No. 10 Bandung)</label>
                                                <input type="text" class="form-control" name="penerima" placeholder="Nama Penerima" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Kode Mata Kuliah</label>
                                                <input type="text" class="form-control" name="kode_matkul" placeholder="Kode Mata Kuliah" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Periode</label>
                                                <input type="text" class="form-control" name="periode" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Tujuan</label>
                                                <input type="text" class="form-control" name="tujuan" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Topik</label>
                                                <input type="text" class="form-control" name="topik" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Data Mahasiswa (Pisahkan dengan koma jika lebih dari satu)</label>
                                                <input type="text" class="form-control" name="data_mhs" required>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary">Reset</button>
                                        </div>
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