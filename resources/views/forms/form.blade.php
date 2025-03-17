@extends('layouts.app')

@section('title', 'Form Layout - Mazer Admin Dashboard')

@section('content')
<div class="page-heading">
    <h3>Form Layout Example</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Basic Form Layout</h4>
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
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Enter your message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>
@endsection
