@extends('layouts.app')

@section('content')

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<section class="container">
  @section('title')
    <h1 class="mt-4 mb-5">Project Detail</h1>
    @endsection
  <h1 class="my-4">Project: {{$project->name}}</h1>
  <div class="dettaglio-canzone row mt-1 mb-5">
    <div class="col-8 offset-2">
      <div class="card text-center">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
              <a class="nav-link active fw-bold" aria-current="true" href="#">Your Song</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold" href="{{ route('admin.projects.index') }}">Back to the Projects list</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <img class="my-4 img-fluid" src="{{$project->getImageUri()}}" >
          <h2 class="card-title mb-3">Project Name:</h2>
          <h3 class="mb-3 text-color"> {{$project->name}}</h3>
          <h3 class="mb-3 text-color">Type:<span class="badge rounded-pill" style="background-color: {{$project->type?->color}}">{{$project->type?->label}}</span></h3>
          <h4 class="card-title mb-3">Contributors:  {{$project->contributors}}</h4>
          <h4 class="card-text mb-3 border border-dark p-2">Description:  {{$project->description}}</h4>
          <a href="https://github.com/ThomasAnselmetto?tab=repositories" class="btn btn-primary mt-3">Apri la Repo su Github</a>
        </div>
      </div>
    </div>
  </div>

  
</section>
@endsection