@extends('layouts.app')
@section('cdn')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css"> 
@endsection
@section('content')
{{-- @dump($sort) --}}
@if (session('message'))
<div class="alert alert-danger">
    {{ session('message') }}
</div>
@endif
  <div class="container">
    @section('title')
    <h1 class="mt-4 mb-5">Trashed Projects</h1>
    @endsection
    
    <div class="row">
     
      <div class="col-12 d-flex justify-content-end">
        <a type="button" class="btn btn-success fw-bold" href="{{route('admin.projects.index')}}">Back to the list</a>
      </div>
    </div>
    
        
    
    <table class="table table-light table-striped  mt-5 p-3">
      <thead class="table-head">
        <tr>
          <th scope="col">
            <a href="{{route('admin.projects.trash')}}?sort=id&order={{ $sort == 'id' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
              @if ($sort == 'id')
              <i class="bi bi-arrow-down d-inline-block @if ($order == 'DESC') rotate-180 @endif"></i>
              @endif
              Id
              
            </a>
          </th>
          <th scope="col">
            <a href="{{route('admin.projects.trash')}}?sort=name&order={{$sort == 'name' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
              Name
              @if ($sort == 'name')
              <i class="bi bi-arrow-down d-inline-block @if($order == 'DESC')rotate-180 @endif"></i>
              @endif
              
              
            </a>
          </th>
          <th scope="col">
            <a href="{{route('admin.projects.trash')}}?sort=commits&order={{$sort == 'commits' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
              Commits
              @if ($sort == 'commits')
              <i class="bi bi-arrow-down d-inline-block @if($order == 'DESC')rotate-180 @endif"></i>
              @endif
              
              
            </a>
          </th>
          <th scope="col">
            <a href="{{route('admin.projects.trash')}}?sort=contributors&order={{$sort == 'contributors' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
              Contributors
              @if ($sort == 'contributors')
              <i class="bi bi-arrow-down d-inline-block @if($order == 'DESC')rotate-180 @endif"></i>
              @endif
            </a>
          </th>
          <th scope="col">
            <a href="{{route('admin.projects.trash')}}?sort=description&order={{$sort == 'description' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
              Description
              @if ($sort == 'description')
              <i class="bi bi-arrow-down d-inline-block @if($order == 'DESC')rotate-180 @endif"></i>
              @endif
            </a>
          </th>
          <th scope="col">
            <a href="{{route('admin.projects.trash')}}?sort=created_at&order={{$sort == 'created_at' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
              Created At
              @if ($sort == 'created_at')
              <i class="bi bi-arrow-down d-inline-block @if($order == 'DESC')rotate-180 @endif"></i>
              @endif
            </a>
          </th>
          <th scope="col">
            <a href="{{route('admin.projects.trash')}}?sort=updated_at&order={{$sort == 'updated_at' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
              Updated At
              @if ($sort == 'updated_at')
              <i class="bi bi-arrow-down d-inline-block @if($order == 'DESC')rotate-180 @endif"></i>
              @endif
            </a>
          </th>
          <th scope="col">
            <a href="{{route('admin.projects.trash')}}?sort=deleted_at&order={{$sort == 'deleted_at' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
              Deleted At
              @if ($sort == 'deleted_at')
              <i class="bi bi-arrow-down d-inline-blodeletedck @if($order == 'DESC')rotate-180 @endif"></i>
              @endif
            </a>
          </th>
          {{-- <th scope="col">Actions</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach ($projects as $project)
            
        <tr class="table-dark">
          <th scope="row">{{$project->id}}</th>
          <td>{{$project->name}}</td>
          <td>{{$project->contributors}}</td>
          <td class="description">{{$project->getAbstract()}}</td>
          <td>{{$project->created_at}}</td>
          <td>{{$project->updated_at}}</td>
          <td>{{$project->deleted_at}}</td>
          <td class="d-flex flex-row align-items-center justify-content-between">

            {{-- <a class="" href="{{ route('admin.projects.show', ['project' => $project ])}}"><i class="bi bi-aspect-ratio-fill text-primary fs-3 "></i></a>
            <a class="" href="{{ route('admin.projects.edit', ['project' => $project ])}}"><i class="bi bi-pencil text-primary fs-3 "></i></a> --}}

            <button class="bi bi-clipboard2-x-fill text-danger delete-icon fs-3{{route('admin.projects.trash')}}?sort=" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$project->id}}"></button>

            <button class="bi bi-arrow-up-left-square-fill text-success delete-icon fs-3{{route('admin.projects.trash')}}?sort=" data-bs-toggle="modal" data-bs-target="#restore-modal-{{$project->id}}"></button>
          </td>
          
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $projects->links('') }}
  </div>
            
            


  @section('modals')
@foreach($projects as $project)
<div class="modal fade" id="delete-modal-{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4  fw-bold" id="exampleModalLabel">Attention</h1>
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body fs-2 fw-bold">
        Are you sure you want to delete the project with Name {{$project->name}}?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info text-light border fw-bold" data-bs-dismiss="modal">Close</button>
        <form class="" action="{{ route('admin.projects.force-delete', $project )}}" method="POST">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger border fw-bold">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="restore-modal-{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4  fw-bold" id="exampleModalLabel">Attention</h1>

        {{-- per i button possiamo usare i tooltips 
          <button type="button" class="btn btn-secondary"
        data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-custom-class="custom-tooltip"
        data-bs-title="This top tooltip is themed via CSS variables.">
  Custom tooltip
</button> --}}


        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body fs-2 fw-bold">
        Are you sure you want to restore the project with Name {{$project->name}}?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info text-light border fw-bold" data-bs-dismiss="modal">Close</button>
        <form class="" action="{{ route('admin.projects.restore',$project)}}" method="POST">
          @csrf
          @method('PUT')
          <button type="submit" class="btn btn-success border fw-bold">Restore</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection 

@endsection

      
      
      
      

              
              
              
              
          