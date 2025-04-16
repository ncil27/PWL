@extends('coba-template.mahasiswa')

@section('title', 'Riwayat Pengajuan')

@section('content')
<div class="page-heading">
    <h3>Riwayat Pengajuan Surat</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Riwayat Pengajuan Anda</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pengajuan</th>
                        <th>Jenis Surat</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuans as $pengajuan)
                    <tr>
                        <td>{{ $pengajuans->firstItem() + $loop->index }}</td>
                        <td>{{ $pengajuan->id_pengajuan }}</td>
                        <td>{{ $pengajuan->jenisSurat->jenis_surat }}</td>
                        <td>{{ $pengajuan->created_at->format('d-m-Y') }}</td>
                        <td>
                            @php $status = $pengajuan->statusSurat; @endphp
                            <span class="badge bg-{{ $status['color'] }}">
                                {{ $status['label'] }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $pengajuan->id_pengajuan }}">
                                <i class="bi bi-eye-fill"></i> Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            
            
            <div class="d-flex justify-content-center">
                {{ $pengajuans->links() }}
            </div>

            {{-- Modal --}}
            @foreach ($pengajuans as $p)
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

                            @switch($p->jenisSurat->kode_surat)

                                {{-- 0 = Surat Keterangan Mahasiswa Aktif --}}
                                @case(0)
                                    @if($p->skma)
                                        <hr>
                                        <h5 class="modal-title">Detail SKMA</h5>
                                        <p><strong>Semester:</strong> {{ $p->skma->semester }}</p>
                                        <p><strong>Keperluan:</strong> {{ $p->skma->keperluan }}</p>
                                        <p><strong>Periode:</strong> {{ $p->skma->id_periode }}</p>
                                        <a href="{{ route('surat.skma.edit', $p->id_pengajuan) }}" class="btn btn-warning btn-sm mt-2">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </a>
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
                                        <a href="{{ route('surat.sp.edit', $p->id_pengajuan) }}" class="btn btn-warning btn-sm mt-2">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </a>
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
                                        <a href="{{ route('surat.slhs.edit', $p->id_pengajuan) }}" class="btn btn-warning btn-sm mt-2">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </a>
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
                                        <a href="{{ route('surat.skl.edit', $p->id_pengajuan) }}" class="btn btn-warning btn-sm mt-2">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </a>
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
        </div>
    </div>
</section>
@endsection

@section('scripts')
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
    
@endsection
