@extends('coba-template.try-temp') 

@section('title', 'Manage Data')

@section('content')
<div class="page-heading">
    <h3>Manage Data</h3>
</div>

<section class="section">
    <!-- PROGRAM STUDI SECTION -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Program Studi
            <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalAddProdi">Tambah Prodi</button>
            </h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="prodiTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Program Studi</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($programStudi as $index => $prodi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $prodi->program_studi }}</td>
                    <td>
                        <!-- Tombol Edit pakai modal -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditProdi{{ $prodi->id_prodi }}">
                            Edit
                        </button>

                        <!-- Tombol Delete -->
                        <form action="{{ route('program-studi.destroy', $prodi->id_prodi) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus prodi ini?')">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit Program Studi -->
                <div class="modal fade" id="modalEditProdi{{ $prodi->id_prodi }}" tabindex="-1" aria-labelledby="modalEditProdiLabel{{ $prodi->id_prodi }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('program-studi.update', $prodi->id_prodi) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditProdiLabel{{ $prodi->id_prodi }}">Edit Program Studi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="program_studi_{{ $prodi->id_prodi }}" class="form-label">Nama Program Studi</label>
                                        <input type="text" class="form-control" name="program_studi" id="program_studi_{{ $prodi->id_prodi }}" value="{{ $prodi->program_studi }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Tambah Program Studi -->
<div class="modal fade" id="modalAddProdi" tabindex="-1" aria-labelledby="modalAddProdiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('program-studi.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddProdiLabel">Tambah Program Studi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="program_studi" class="form-label">Nama Program Studi</label>
                        <input type="text" class="form-control" name="program_studi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- JENIS SURAT SECTION -->
<div class="card mt-4">
    <div class="card-header">
        <h4>Jenis Surat
        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalAddSurat">
            Tambah Jenis Surat
        </button>
        <!-- <a href="{{ route('admin.jenis-surat.create') }}" class="btn btn-success float-end">Add Jenis Surat</a></h4> -->
    </div>
    <div class="card-body">
        <table class="table table-striped" id="suratTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jenis Surat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenisSurat as $index => $surat)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $surat->jenis_surat }}</td>
                        <td>
                            <!-- Tombol Edit Modal -->
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditSurat{{ $surat->kode_surat }}">
                                Edit
                            </button>

                            <!-- Tombol Delete -->
                            <form action="{{ route('admin.jenis-surat.destroy', $surat->kode_surat) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus jenis surat ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit (di luar <tr>, tapi tetap di loop) -->
                    <div class="modal fade" id="modalEditSurat{{ $surat->kode_surat }}" tabindex="-1" aria-labelledby="modalEditSuratLabel{{ $surat->kode_surat }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('admin.jenis-surat.update', $surat->kode_surat) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditSuratLabel{{ $surat->kode_surat }}">Edit Jenis Surat</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="jenis_surat_{{ $surat->kode_surat }}" class="form-label">Nama Jenis Surat</label>
                                            <input type="text" class="form-control" id="jenis_surat_{{ $surat->kode_surat }}" name="jenis_surat" value="{{ $surat->jenis_surat }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

<div class="modal fade" id="modalAddSurat" tabindex="-1" aria-labelledby="modalAddSuratLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.jenis-surat.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAddSuratLabel">Tambah Jenis Surat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="jenis_surat" class="form-label">Nama Jenis Surat</label>
            <input type="text" class="form-control" id="jenis_surat" name="jenis_surat" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>


</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#userTable').DataTable();
    });
</script>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Sukses!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif
