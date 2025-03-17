@extends('layouts.app')

@section('title', 'Input Form - Mazer Admin Dashboard')

@section('content')
<div class="page-heading">
    <h3>Input Example</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Input Form</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
    