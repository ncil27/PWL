@extends('coba-template.try-temp');
@section('page-title', "Dashboard")


@section('content')


<h3>Welcome, {{ Auth::user()->name }}!</h3>
<p>Ini adalah halaman dashboard untuk Admin.</p>
@endsection