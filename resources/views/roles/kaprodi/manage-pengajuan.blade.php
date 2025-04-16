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
                        <td>{{ $pengajuans->total() - ($pengajuans->firstItem() - 1 + $loop->index) }}</td>
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
            
            <div class="d-flex justify-content-center">
                {{ $pengajuans->links() }}
            </div>
            
            @foreach ($pengajuans as $p)
                <!-- Modal Detail Pengajuan -->
                <div class="modal fade" id="modalDetail{{ $p->id_pengajuan }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel{{ $p->id_pengajuan }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailLabel{{ $p->id_pengajuan }}">Detail Pengajuan</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nama:</strong> {{ $p->mahasiswa->name }}</p>
                                <p><strong>Jenis Surat:</strong> {{ $p->jenisSurat->jenis_surat }}</p>
                                <p><strong>Status:</strong> {{ $p->status_surat['label'] }}</p>

                                {{-- Switch berdasarkan kode jenis surat --}}
                                @switch($p->jenisSurat->kode_surat)

                                    {{-- 0 = Surat Keterangan Mahasiswa Aktif --}}
                                    @case(0)
                                        @if($p->skma)
                                            <hr>
                                            <h5 class="modal-title">Detail SKMA</h5>
                                            <p><strong>Semester:</strong> {{ $p->skma->semester }}</p>
                                            <p><strong>Keperluan:</strong> {{ $p->skma->keperluan }}</p>
                                            <p><strong>Periode:</strong> {{ $p->skma->id_periode }}</p>
                                        @else
                                            <p class="text-muted">Detail SKMA belum tersedia.</p>
                                        @endif
                                        @break

                                    {{-- 1 = Surat Pengantar Tugas --}}
                                    @case(1)
                                        @if($p->suratPengantar)
                                            <hr>
                                            <h5 class="modal-title">Detail Surat Pengantar</h5>
                                            <p><strong>Topik:</strong> {{ $p->suratPengantar->topik }}</p>
                                            <p><strong>Tujuan:</strong> {{ $p->suratPengantar->tujuan }}</p>
                                            <p><strong>Penerima:</strong> {{ $p->suratPengantar->penerima }}</p>
                                            <p><strong>Kode Matkul:</strong> {{ $p->suratPengantar->kode_matkul }}</p>
                                            <p><strong>Periode:</strong> {{ $p->suratPengantar->id_periode }}</p>
                                            <p><strong>Data Mahasiswa:</strong> {{ $p->suratPengantar->data_mhs }}</p>
                                        @else
                                            <p class="text-muted">Detail surat pengantar belum tersedia.</p>
                                        @endif
                                        @break

                                    {{-- 2 = Laporan Hasil Studi --}}
                                    @case(2)
                                        @if($p->lhs)
                                            <hr>
                                            <h5 class="modal-title">Detail Laporan Hasil Studi</h5>
                                            <p><strong>Keperluan:</strong> {{ $p->lhs->keperluan }}</p>
                                        @else
                                            <p class="text-muted">Detail LHS belum tersedia.</p>
                                        @endif
                                        @break

                                    {{-- 3 = Surat Keterangan Lulus --}}
                                    @case(3)
                                        @if($p->skl)
                                            <hr>
                                            <h5 class="modal-title">Detail Surat Keterangan Lulus</h5>
                                            <p><strong>Tangagal Lulus:</strong> {{ $p->skl->tgl_lulus }}</p>
                                        @else
                                            <p class="text-muted">Detail SKL belum tersedia.</p>
                                        @endif
                                        @break

                                    @default
                                        <p class="text-muted">Jenis surat tidak dikenali.</p>

                                @endswitch
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


            {{-- @foreach ($pengajuans as $p)
                <!-- Modal -->
                <div class="modal fade" id="modalDetail{{ $p->id_pengajuan }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel{{ $p->id_pengajuan }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailLabel{{ $p->id_pengajuan }}">Detail Pengajuan</h5>
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
            @endforeach     --}}

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
