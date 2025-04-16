@extends('coba-template.mahasiswa')

@section('title', 'Edit Surat Pengantar')

@section('content')
<div class="page-heading">
    <h3>Edit Surat Pengantar</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('surat.sp.update', $id_pengajuan) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_pengajuan" value="{{ $id_pengajuan }}">

                <div class="row">
                    <div class="col-md-6 col-12 p-3">
                        <div class="form-group mandatory">
                            <label for="penerima" class="card-title">Penerima Surat</label><br>
                            <label class="form-label small">Informasikan secara lengkap: nama, jabatan, perusahaan, alamat</label>
                            <input type="text" id="penerima" class="form-control" name="penerima" placeholder="Penerima Surat"
                                value="{{ old('penerima', $sp->penerima ?? '') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-12 p-3">
                        <div class="form-group">
                            <label for="kode_matkul" class="card-title">Kode Mata Kuliah - Nama Mata Kuliah</label><br>
                            <label class="form-label small">Contoh: IN240 - Pemrograman Web Lanjut</label>
                            <input type="text" id="kode_matkul" class="form-control" name="kode_matkul"
                                placeholder="Kode Mata Kuliah - Nama Mata Kuliah"
                                value="{{ old('kode_matkul', $sp->kode_matkul ?? '') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-12 p-3">
                        <div class="form-group">
                            <label for="id_periode" class="card-title">Periode</label><br>
                            <label class="form-label small">Contoh: Reguler Genap 24/25</label>
                            <select id="id_periode" class="form-select" name="id_periode" required>
                                <option value="">Pilih Periode</option>
                                @foreach($periode as $item)
                                    <option value="{{ $item->id_periode }}"
                                        {{ old('id_periode', $sp->id_periode ?? '') == $item->id_periode ? 'selected' : '' }}>
                                        {{ $item->nama_periode }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-12 p-3">
                        <div class="form-group">
                            <label for="data_mhs" class="card-title">Data Mahasiswa</label><br>
                            <label class="form-label small">Contoh: 2372999 - John Doe; dst</label>
                            <input type="text" id="data_mhs" class="form-control" name="data_mhs"
                                placeholder="Data Mahasiswa"
                                value="{{ old('data_mhs', $sp->data_mhs ?? '') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-12 p-3">
                        <div class="form-group">
                            <label for="tujuan" class="card-title">Tujuan Surat</label><br>
                            <label class="form-label small">Contoh: Surat untuk melakukan wawancara kepada perusahaan</label>
                            <input type="text" id="tujuan" class="form-control" name="tujuan"
                                placeholder="Tujuan"
                                value="{{ old('tujuan', $sp->tujuan ?? '') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-12 p-3">
                        <div class="form-group mandatory">
                            <label for="topik" class="card-title">Topik Tugas</label><br>
                            <label class="form-label small">Contoh: Pembuatan Sistem dan Website Perusahaan PT ABC XYZ</label>
                            <input type="text" id="topik" class="form-control" name="topik"
                                placeholder="Topik"
                                value="{{ old('topik', $sp->topik ?? '') }}" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <div class="form-check mandatory">
                                <input type="checkbox" id="checkbox5" class="form-check-input" required>
                                <label for="checkbox5" class="form-check-label form-label">Data di atas sudah benar apa adanya</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-success me-1">Simpan Perubahan</button>
                        <button type="button" id="btnBackDashboard" class="btn btn-light-secondary">Batal</button>
                    </div>
                </div>
            </form>
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

<script>    
    document.getElementById('btnBackDashboard').addEventListener('click', function () {
        Swal.fire({
            title: 'Yakin kembali?',
            text: "Perubahan yang telah kamu buat tidak akan disimpan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, kembali'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('mahasiswa.riwayat') }}";
            }
        })
    });
</script>
@endsection
