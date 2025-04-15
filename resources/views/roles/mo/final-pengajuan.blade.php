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
                    @foreach($pengajuan as $p)
                        <tr >
                            <td data-bs-toggle="modal" data-bs-target="#modalDetail{{ $p->id_pengajuan }}" style="cursor: pointer;">{{ $p->mahasiswa->name }}</td>
                            <td data-bs-toggle="modal" data-bs-target="#modalDetail{{ $p->id_pengajuan }}" style="cursor: pointer;">{{ $p->jenisSurat->jenis_surat }}</td>
                            <td>
                                <span class="badge bg-{{ $p->status_surat['color'] }}">
                                    {{ $p->status_surat['label'] }}
                                </span>
                            </td>
                            <td>
                                @if ($p->file_surat)
                                    <span class="text-success fw-bold">Done</span>
                                @else
                                    <form action="{{ route('mo.uploadSurat', $p->id_pengajuan) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="file_surat" class="form-control" accept="application/pdf" required>
                                        <button type="submit" class="btn btn-primary btn-sm mt-2">Upload</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @foreach ($pengajuan as $p)
                <!-- Modal -->
                <div class="modal fade" id="modalDetail{{ $p->id_pengajuan }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel{{ $p->id_pengajuan }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailLabel{{ $p->id_pengajuan }}">Detail Pengajuan Surat</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nama:</strong> {{ $p->mahasiswa->name }}</p>
                                <p><strong>Jenis Surat:</strong> {{ $p->jenisSurat->jenis_surat }}</p>

                                @if ($p->kode_surat == 0)
                                    @php
                                        $detail = $skma->where('id_pengajuan', $p->id_pengajuan)->first();
                                    @endphp
                                    @if ($detail)
                                        <p><strong>Semester:</strong> {{ $detail->semester }}</p>
                                        <p><strong>Keperluan:</strong> {{ $detail->keperluan }}</p>
                                        <p><strong>Periode:</strong> {{ $detail->id_periode }}</p>
                                    @endif

                                @elseif ($p->kode_surat == 1)
                                    @php
                                        $detail = $pengantar->where('id_pengajuan', $p->id_pengajuan)->first();
                                    @endphp
                                    @if ($detail)
                                        <p><strong>Tujuan:</strong> {{ $detail->penerima }}</p>
                                        <p><strong>Mata Kuliah:</strong> {{ $detail->kode_matkul }}</p>
                                        <p><strong>Keperluan:</strong> {{ $detail->keperluan }}</p>
                                        <p><strong>Topik:</strong> {{ $detail->topik }}</p>
                                        <p><strong>Data Mahasiswa:</strong> {{ $detail->data_mhs }}</p>
                                    @endif

                                @elseif ($p->kode_surat == 2)
                                    @php
                                        $detail = $laporan->where('id_pengajuan', $p->id_pengajuan)->first();
                                    @endphp
                                    @if ($detail)
                                        <p><strong>Keperluan:</strong> {{ $detail->keperluan }}</p>
                                    @endif

                                @elseif ($p->kode_surat == 3)
                                    @php
                                        $detail = $kelulusan->where('id_pengajuan', $p->id_pengajuan)->first();
                                    @endphp
                                    @if ($detail)
                                        <p><strong>Tanggal Lulus:</strong> {{ $detail->tgl_lulus }}</p>
                                    @endif
                                @endif
                                @if ($p->file_surat)
                                    <div class="mb-3">
                                        <h6>Preview Surat</h6>
                                        <iframe src="{{ asset('storage/' . $p->file_surat) }}" 
                                                width="100%" height="400px" frameborder="0"></iframe>
                                    </div>
                                @else
                                    <p class="text-muted">Belum ada file surat yang diupload.</p>
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
