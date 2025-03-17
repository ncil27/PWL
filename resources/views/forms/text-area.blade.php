@extends('layouts.app')

@section('title', 'Textarea Form - Mazer Admin Dashboard')

@section('content')
<div class="page-heading">
    <h3>Textarea Example</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Textarea Form</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Enter your message"></textarea>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
