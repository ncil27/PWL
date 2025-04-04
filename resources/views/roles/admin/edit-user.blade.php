@extends('coba-template.try-temp') 

@section('content')
<form action="{{ route('user.update', $user->id_user) }}" method="POST">
    @csrf
    @method('PUT')
<!-- 
    <input type="text" name="name" value="{{ $user->name }}" required>
    <input type="email" name="email" value="{{ $user->email }}" required>
    
    <select name="id_role">
        <option value="1" {{ $user->id_role == 1 ? 'selected' : '' }}>Admin</option>
        <option value="2" {{ $user->id_role == 2 ? 'selected' : '' }}>Kaprodi</option>
        dst -->
    <!-- </select>

    <select name="status">
        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Aktif</option>
        <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
    </select>

    <input type="text" name="program_studi" value="{{ $user->program_studi }}">

    <button type="submit">Update User</button> --> 

    <div class="col-12">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name"
                class="form-control" name="name" value="{{ $user->name }}"
                placeholder="Name" >
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
                <select class="form-select" name="id_role">
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
            <label for="status">Status</label>
            <fieldset class="form-group">
                <select class="form-select" name="status">
                    <!-- @foreach($roles as $role)
                        <option value="{{ $role->id_role }}">{{ $role->role }}</option>
                        @endforeach -->
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
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
    <div class="col-12">
        <div class="form-group">
            <label for="password-vertical">Password</label>
            <input type="password" id="password-vertical"
                class="form-control" name="password"
                placeholder="Password">
        </div>
    </div>
    <div class="col-12 d-flex justify-content-end">
        <button type="submit"
            class="btn btn-primary me-1 mb-1">Update User</button>
    </div>
</form>

@endsection