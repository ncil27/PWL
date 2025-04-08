@extends('coba-template.kaprodi') 

@section('title', 'Manage Pengajuan')

@section('content')
<div class="page-heading">
    <h3>Manage Pengajuan</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>List Pengajuan</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pengajuan</th>
                        <th>ID Mahasiswa</th>
                        <th>Jenis Surat</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuans as $pengajuan)
                    <tr data-bs-toggle="modal" data-bs-target="#modalDetail{{ $pengajuan->id_pengajuan }}" style="cursor: pointer;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pengajuan->id_pengajuan }}</td>
                        <td>{{ $pengajuan->id_mhs }}</td>
                        <td>{{ $pengajuan->jenisSurat->jenis_surat}}</td>
                        <td>{{ $pengajuan->created_at }}</td>
                        <td>
                            @php
                                $status = $pengajuan->statusSurat;
                            @endphp

                            <span class="badge bg-{{ $status['color'] }}">
                                {{ $status['label'] }}
                            </span>
                        </td>

                        <td>
                            @if ($pengajuan->status_pengajuan == 0)
                                <!-- Tombol checklist -->
                                <form action="{{ route('pengajuan.updateStatus', $pengajuan->id_pengajuan) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-success btn-sm" title="Setujui">
                                        <i class="bi bi-check-square-fill"></i>
                                    </button>
                                </form>

                                <!-- Tombol X -->
                                <form action="{{ route('pengajuan.updateStatus', $pengajuan->id_pengajuan) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="4">
                                    <button type="submit" class="btn btn-danger btn-sm" title="Tolak">
                                        <i class="bi bi-x-square-fill"></i>
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">{{ $status['label'] }}</span>
                            @endif
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
