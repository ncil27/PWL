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
                            <form action="#" method="POST" class="form form-vertical">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Penerima (Yang Dituju)</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="penerima" placeholder="Nama Penerima" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Tujuan</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="tujuan" placeholder="Tujuan" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Mata Kuliah</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="mata-kuliah" placeholder="Mata Kuliah" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Topik</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="topik" placeholder="Topik" required>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Individu
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Berkelompok
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Mahasiswa 1</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="nama-mahasiswa" placeholder="Nama Mahasiswa 1" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Mahasiswa 2</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="nama-mahasiswa" placeholder="Nama Mahasiswa 2">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Mahasiswa 3</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="nama-mahasiswa" placeholder="Nama Mahasiswa 3">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Mahasiswa 4</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="nama-mahasiswa" placeholder="Nama Mahasiswa 4">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Mahasiswa 5</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="nama-mahasiswa" placeholder="Nama Mahasiswa 5">
                                            </div>
                                        </div>

                                        
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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