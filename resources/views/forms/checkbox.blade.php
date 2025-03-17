@extends('layouts.app')

@section('title', 'Checkbox Form - Mazer Admin Dashboard')

@section('content')
<div class="page-heading">
    <h3>Checkbox Example</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Checkbox Form</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <input type="checkbox" id="option1" name="option1">
                    <label for="option1">Option 1</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="option2" name="option2">
                    <label for="option2">Option 2</label>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
