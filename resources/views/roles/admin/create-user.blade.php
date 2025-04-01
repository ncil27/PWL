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
                        <form class="form form-vertical">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Id User</label>
                                            <input type="text" id="first-name-vertical"
                                                class="form-control" name="fname"
                                                placeholder="Id User">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Name</label>
                                            <input type="text" id="first-name-vertical"
                                                class="form-control" name="fname"
                                                placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Email</label>
                                            <input type="email" id="email-id-vertical"
                                                class="form-control" name="email-id"
                                                placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Role</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" name="kode_surat">
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id_role }}">{{ $role->role }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Status</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" name="kode_surat">
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id_role }}">{{ $role->role }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Program Studi</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" name="kode_surat">
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id_role }}">{{ $role->role }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password-vertical">Password</label>
                                            <input type="password" id="password-vertical"
                                                class="form-control" name="contact"
                                                placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class='form-check'>
                                            <div class="checkbox">
                                                <input type="checkbox" id="checkbox3"
                                                    class='form-check-input' checked>
                                                <label for="checkbox3">Remember Me</label>
                                            </div>
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
