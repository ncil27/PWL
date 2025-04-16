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
            <a href="" class="btn btn-success float-end">Add Prodi</a></h4>
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
                            <a href="" class="btn btn-sm btn-primary">Edit</a>
                            <form action="" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus prodi ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

<!-- JENIS SURAT SECTION -->
<div class="card mt-4">
    <div class="card-header">
        <h4>Jenis Surat
        <a href="" class="btn btn-success float-end">Add Jenis Surat</a></h4>
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
                        <a href="" class="btn btn-sm btn-primary">Edit</a>
                        <form action="" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus jenis surat ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
