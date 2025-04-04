@extends('coba-template.try-temp') 

@section('title', 'Manage Users')

@section('content')
<div class="page-heading">
    <h3>Manage Users</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>User List
            <a href='/admin/create-user' style="margin-left:90%;" class="btn btn-warning">Add User</a> </h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="userTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->role ?? 'Tidak Ada Role' }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id_user) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('user.destroy', $user->id_user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
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
