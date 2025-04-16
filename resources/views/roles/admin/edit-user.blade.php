@extends('coba-template.try-temp') 

@section('content')
<form action="{{ route('user.update', $user->id_user) }}" method="POST" id = "formEditUser">
    @csrf
    @method('PUT')

    <!-- <button type="button" id="btnBack" class="btn btn-primary mb-3"> -->
    <button type="button" id="btnBack" class="btn btn-outline-secondary" data-back-url="{{ route('admin.manage-user') }}">
    Kembali
</button>

    <!-- </button> -->

    <div class="col-12">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name"
                class="form-control" name="name" value="{{ $user->name }}"
                placeholder="Name" disabled>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email"
                class="form-control" name="email"
                placeholder="Email" value="{{ $user->email }}">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="role">Role</label>
            <fieldset class="form-group">
                <select class="form-select" name="id_role" disabled>
                    @foreach($roles as $role)
                        <!-- <option value="{{ $role->id_role }}">{{ $role->role }}</option> -->
                        <option value="{{ $role->id_role }}" {{ $user->id_role == $role->id_role ? 'selected' : '' }}>
                            {{ $role->role }}
                        </option>
                    @endforeach
                </select>
            </fieldset>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="email-id-vertical">Program Studi</label>
            <fieldset class="form-group">
                <select class="form-select" name="id_prodi">
                    @foreach($programStudi as $program_studi)
                        <option value="{{ $program_studi->id_prodi }}" {{ $user->id_prodi == $program_studi->id_prodi ? 'selected' : '' }}>{{ $program_studi->program_studi }}</option>
                    @endforeach
                </select>
            </fieldset>
        </div>
    </div>
    <div class="col-12 d-flex justify-content-end">
        <button type="submit"
            class="btn btn-primary me-1 mb-1">Update User</button>
    </div>
</form>

@endsection
@section('js_bwh')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let isFormDirty = false;
        const form = document.getElementById('formEditUser');

        // Deteksi perubahan
        form.querySelectorAll('input, select, textarea').forEach((input) => {
            input.addEventListener('change', () => {
                isFormDirty = true;
            });
        });

        // Tombol kembali
        document.getElementById('btnBack').addEventListener('click', function (e) {
            const backUrl = e.currentTarget.getAttribute('data-back-url');

            if (isFormDirty) {
                Swal.fire({
                    title: 'Yakin mau kembali?',
                    text: "Perubahan belum disimpan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, kembali',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = backUrl;
                    }
                });
            } else {
                window.location.href = backUrl;
            }
        });
    });
</script>
@endsection
