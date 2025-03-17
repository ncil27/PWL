@extends('layouts.app')

@section('title', 'Table - Mazer Admin Dashboard')

@section('content')
<div class="page-heading">
    <h3>Table Example</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Basic Table</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
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
@endsection
