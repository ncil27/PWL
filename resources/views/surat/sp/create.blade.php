
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@extends('coba-template.mahasiswa');
@section('page-title', "Surat Pengantar Tugas")

@section('content')
<div class="page-heading d-flex justify-content-between">
  <div>
    <h3>Surat Pengantar Tugas</h3>
    <p>Form untuk mengajukan Surat Pengantar Tugas Mata Kuliah</p>
    <a href="{{ route('pengajuan.destroyTemporary', $id_pengajuan) }}" class="btn btn-primary mb-3">Kembali</a>
  </div>
</div>

<section id="multiple-column-form">
    <div class="row match-height">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Surat Pengantar Tugas</h4>
          </div>
          <div class="card-content">
            <div class="card-body">
              <form action="{{ route('surat.sp.store') }}" method="POST" class="form">
                @csrf
                <input type="hidden" name="id_pengajuan" value="{{ $id_pengajuan }}">

                <div class="row">
                  <div class="col-md-6 col-12 p-3">
                    <div class="form-group mandatory">
                      <label for="penerima" class="card-title">Penerima Surat</label><br>
                      <label for="penerima" class="form-label small">Informasikan secara lengkap: nama, jabatan, perusahaan, alamat</label><br>
                      <label for="penerima" class="form-label small">Contoh: Bapak John Doe, Kepala Bagian Teknologi, PT ABC, Jln. Surya Sumantri No. 999, Bandung</label>

                      <input
                        type="text"
                        id="penerima"
                        class="form-control"
                        placeholder="Penerima Surat"
                        name="penerima"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12 p-3">
                    <div class="form-group">
                    <label for="kode_matkul" class="card-title">Kode Mata Kuliah - Nama Mata Kuliah</label><br>
                    <label for="kode_matkul" class="form-label small">Informasikan Kode dan Nama Mata Kuliah yang memberi tugas ini</label><br>
                    <label for="kode_matkul" class="form-label small">Contoh: IN240 - Pemrograman Web Lanjut</label>
                      <input
                        type="text"
                        id="kode_matkul"
                        class="form-control"
                        placeholder="Kode Mata Kuliah - Nama Mata Kuliah"
                        name="kode_matkul"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12 p-3">
                    <div class="form-group">
                        <label for="id_periode" class="card-title">Periode</label><br>
                        <label for="id_periode" class="form-label small">Pilih dengan semester yang ditempuh saat ini</label><br>
                        <label for="id_periode" class="form-label small">Contoh: Reguler Genap 24/25</label>
                      <select id="id_periode" class="form-select" name="id_periode" required>
                          <option value="">Pilih Periode</option>
                          @foreach($periode as $item)
                              <option value="{{ $item->id_periode }}">{{ $item->nama_periode }}</option>
                          @endforeach
                      </select>
                      
                    </div>
                  </div>
                  <div class="col-md-6 col-12 p-3">
                    <div class="form-group">
                        <label for="data_mhs" class="card-title">Data Mahasiswa</label><br>
                        <label for="data_mhs" class="form-label small">Informasikan NRP dan Nama tiap mahasiswa</label><br>
                        <label for="data_mhs" class="form-label small">Contoh: 2372999 - John Doe; 2472888 - Steve John; dst</label>
                      <input
                        type="text"
                        id="data_mhs"
                        class="form-control"
                        name="data_mhs"
                        placeholder="Data Mahasiswa"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12 p-3">
                    <div class="form-group">
                        <label for="tujuan" class="card-title">Tujuan Surat</label><br>
                        <label for="tujuan" class="form-label small">Informasikan tujuan pembuatan surat ini</label><br>
                        <label for="tujuan" class="form-label small">Contoh: Surat untuk melakukan wawancara kepada perusahaan </label>
                      <input
                        type="text"
                        id="tujuan"
                        class="form-control"
                        name="tujuan"
                        placeholder="Tujuan"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-12 p-3">
                    <div class="form-group mandatory">
                        <label for="first-name-column" class="card-title">Topik Tugas</label><br>
                        <label for="first-name-column" class="form-label small">Informasikan topik tugas</label><br>
                        <label for="first-name-column" class="form-label small">Contoh: Pembuatan Sistem dan Website Perusahaan PT ABC XYZ</label>
                      <input
                        type="text"
                        id="topik"
                        class="form-control"
                        name="topik"
                        placeholder="Topik"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <div class="form-check mandatory">
                        <input
                          type="checkbox"
                          id="checkbox5"
                          class="form-check-input"
                          required
                          data-parsley-error-message="You have to accept our terms and conditions to proceed."
                        />
                        <label
                          for="checkbox5"
                          class="form-check-label form-label"
                          >Data di atas sudah benar apa adanya</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-1 mb-1">
                      Submit
                    </button>
                    <button
                      type="reset"
                      class="btn btn-light-secondary me-1 mb-1">
                      Reset
                    </button>
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
