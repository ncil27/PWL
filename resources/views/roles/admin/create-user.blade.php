@extends('coba-template.try-temp') 

@section('title', 'Create User')

@section('content')
<div class="page-heading">
    <h3>Create User</h3>
</div>

<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="POST" class="form form-vertical">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="id_user">Id User</label>
                                            <input type="text" id="Id User"
                                                class="form-control" name="id_user"
                                                placeholder="Id User">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name"
                                                class="form-control" name="name"
                                                placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email"
                                                class="form-control" name="email"
                                                placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" name="role">
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id_role }}">{{ $role->role }}</option>
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
                                                <select class="form-select" name="program_studi">
                                                    @foreach($programStudi as $program_studi)
                                                        <option value="{{ $program_studi->id_prodi }}">{{ $program_studi->program_studi }}</option>
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
                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset"
                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
