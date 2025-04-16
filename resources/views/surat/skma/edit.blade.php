@extends('coba-template.mahasiswa')

@section('title', 'Edit Surat Keterangan Mahasiswa Aktif')

@section('content')
<div class="page-heading">
    <h3>Edit Surat Keterangan Mahasiswa Aktif</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
          <form action="{{ route('surat.skma.update', $id_pengajuan) }}" method="POST">
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
        
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select name="semester" id="semester" class="form-select" required>
                            <option value="">Pilih Semester</option>
                            @for ($i = 1; $i <= 14; $i++)
                                <option value="{{ $i }}" {{ old('semester', $skma->semester ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
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
                                <option value="{{ $p->id_periode }}" {{ old('id_periode', $skma->id_periode ?? '') == $p->id_periode ? 'selected' : '' }}>
                                    {{ $p->nama_periode }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
        
                <div class="col-12">
                    <div class="form-group">
                        <label for="keperluan">Keperluan</label>
                        <input type="text" name="keperluan" id="keperluan" class="form-control" placeholder="Keperluan Pengajuan"
                            value="{{ old('keperluan', $skma->keperluan ?? '') }}" required>
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