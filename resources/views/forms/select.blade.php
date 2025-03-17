@extends('layouts.app')

@section('title', 'Select Form - Mazer Admin Dashboard')

@section('content')
<div class="page-heading">
    <h3>Select Example</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Select Dropdown</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="options">Choose an option</label>
                    <select class="form-control" id="options" name="options">
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
