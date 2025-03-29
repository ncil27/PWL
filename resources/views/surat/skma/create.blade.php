@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Form Pengajuan Surat Keterangan Mahasiswa Aktif</h3>
    <form action="{{ route('surat.skma.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="keperluan" class="form-label">Keperluan</label>
            <input type="text" class="form-control" id="keperluan" name="keperluan">
        </div>
        <button type="submit" class="btn btn-primary">Ajukan</button>
    </form>
</div>
@endsection
