@extends('layouts.app')

@section('content')

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<section class="container">
  {{-- @section('title')
    <h1 class="mt-4 mb-5">Type Detail</h1>
    @endsection --}}
  <h1 class="my-4">Type: {{$type->label}}</h1>
  <div class="dettaglio-canzone row mt-1 mb-5">
    <div class="col-8 offset-2">
      <div class="card text-center">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
              <a class="nav-link active fw-bold" aria-current="true" href="#">Type Detail</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold" href="{{ route('admin.types.index') }}">Back to the types list</a>
            </li>
          </ul>
        </div>

        <div class="card-body">
          <h3 class="my-2 text-color">Framework:<span class="ms-2 badge rounded-pill" style="background-color: {{$type->color}}">{{$type->label}}</span></h3>
          <a href="https://www.simplilearn.com/top-web-frameworks-and-career-tips-in-web-development-article" class="btn btn-success mt-3">Search best frameworks</a>
        </div>
      </div>
    </div>
  </div>

  
</section>
@endsection