@extends('coba-template.mo') 

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
                        <th>Nama</th>
                        <th>Jenis Surat</th>
                        <th>Status</th>
                        <th>Upload Surat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan as $p)
                    <tr data-bs-toggle="modal" data-bs-target="#modalDetail{{ $p->id_pengajuan }}" style="cursor: pointer;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->id_pengajuan }}</td>
                        <td>{{ $p->id_mhs }}</td>
                        <td>{{ $p->jenisSurat->jenis_surat}}</td>
                        <td>{{ $p->created_at }}</td>
                        <td>
                            @php
                                $status = $p->statusSurat;
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
            @foreach ($pengajuans as $p)
                <!-- Modal -->
                <div class="modal fade" id="modalDetail{{ $p->id_pengajuan }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel{{ $p->id_pengajuan }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailLabel{{ $p->id_pengajuan }}">Detail Pengajuan SKMA</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if ($p->skma)
                                    <p><strong>Nama:</strong> {{ $p->mahasiswa->name }}</p>
                                    <p><strong>Jenis Surat:</strong> {{ $p->jenisSurat->jenis_surat }}</p>
                                    <p><strong>Status:</strong> {{ $p->status_surat['label'] }}</p>
                                    <p><strong>Semester:</strong> {{ $p->skma->semester }}</p>
                                    <p><strong>Keperluan:</strong> {{ $p->skma->keperluan }}</p>
                                    <p><strong>Periode:</strong> {{ $p->skma->id_periode }}</p>
                                @else
                                    <p>Data belum tersedia.</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach    

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
