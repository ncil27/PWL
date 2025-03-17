@extends('layouts.app')

@section('title', 'DataTable - Mazer Admin Dashboard')

@section('content')
<div class="page-heading">
    <h3>DataTable Example</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Advanced Table</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>john@example.com</td>
                        <td>Admin</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>jane@example.com</td>
                        <td>User</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

@section('scripts')
<script src="{{ asset('assets/extensions/datatables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endsection
