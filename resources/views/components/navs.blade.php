@extends('layouts.app')

@section('title', 'Navs Component')

@section('content')
<div class="page-heading">
    <h3>Navs Component</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
        </div>
    </div>
</section>
@endsection
