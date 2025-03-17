@extends('layouts.app')

@section('title', 'Radio Form - Mazer Admin Dashboard')

@section('content')
<div class="page-heading">
    <h3>Radio Button Example</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Radio Button Form</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <input type="radio" id="option1" name="options" value="1">
                    <label for="option1">Option 1</label>
                </div>
                <div class="form-group">
                    <input type="radio" id="option2" name="options" value="2">
                    <label for="option2">Option 2</label>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
