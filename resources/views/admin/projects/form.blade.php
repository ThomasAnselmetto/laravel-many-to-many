@extends('layouts.app')

@section('content')
<section class="container">
  @section('title')
  <h1 class="mt-4 mb-5">Create and Edit Project</h1>
  @endsection

  @include('partials.errors')

  <div class="card">
    <div class="card-body">
      {{-- rendo riutilizzabile ilform sia per il create che per l'edit --}}
      {{-- aggiungo enctype perche avendo aggiunto le immagini al portfolio ho bisogno di enctype per i file
         --}}
      @if ($project->id)
      <form method="POST" action="{{route('admin.projects.update', $project)}}" enctype="multipart/form-data" class="row">
      @method('PUT')
  @else
      <form method="POST" action="{{route('admin.projects.store')}}" enctype="multipart/form-data" class="row">
  @endif 
      @csrf
      <div class="col-8">

         {{-- ! Image  --}}
        <div class="col-10">
          <label class="form-label" for="project_preview_img">Image</label>

          <input type="file" name="project_preview_img" id="project_preview_img" class="@error('project_preview_img') is-invalid @enderror form-control">
          
          @error('project_preview_img')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror
        </div>
        {{-- ! Name  --}}
        <div class="col-6 my-4">
          <label class="form-label" for="name">Name</label>
          <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror form-control" value="{{old('name', $project->name)}}">
          @error('name')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
        {{-- ! Published  --}}
        <div class="col-1 my-4">
          <label class="form-check d-inline-block ps-0" for="published">Published</label>
          <input type="checkbox" name="published" id="published" value="1" class="@error('published') is-invalid @enderror form-check-control" @checked(old('published',$project->published))>
          @error('published')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
        {{-- ! Type  --}}
        <div class="col my-4">
        <label class="form-label d-inline-block ps-0" for="type_id">Type</label>
          <div class="col-12 my-4">
          
          <select name="type_id" id="type_id" class="form-select" @error('type_id') is-invalid @enderror>
            <option value="">Without Type</option>
            @foreach ($types as $type)
            <option @if (old('type_id',$project->type_id) == $type->id) selected @endif value="{{$type->id}}">{{$type->label}}</option>
            @endforeach
          </select>
          @error('type_id')
          <div class="invalid-feedback">
            {{$message}}
          </div>
           @enderror
          </div>
        </div>

        {{-- ! Tecnologies  --}}
        <div class="col">
          @foreach ($technologies as $technology)
            <input type="checkbox" id="technology-{{$technology->id}}" value="{{$technology->id}}" class="@error('technologies') is-invalid @enderror form-check-control" name="technologies[]" @if(in_array($technology->id,old('tecnologie',$project_technologies ?? [])))checked @endif>
            <label for="technology-{{$technology->id}}">{{$technology->label}}</label> 
            <br>
          @endforeach
          @error('technologies')
          <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>

        {{-- ! Contributors  --}}
        <div class="col-2 my-4">
          <label class="form-label" for="contributors">Contributors</label>
          <input type="number" name="contributors" id="contributors" class="@error('contributors') is-invalid @enderror form-control" value="{{old('contributors', $project->contributors)}}">
          @error('contributors')
          <div class="invalid-feedback">
            {{$message}}
          </div>
           @enderror
          </div>
          
         
         

        {{-- ! Description  --}}
        <div class="col-12 my-4">
          <label class="form-label" for="description">Description</label>
          <input type="text" name="description" id="description" class="@error('description') is-invalid @enderror form-control" value="{{old('description', $project->description)}}">
          @error('description')
          <div class="invalid-feedback">
            {{$message}}
          </div> 
          @enderror
        </div>
        {{-- ! Image Preview --}}
        <div class="col-4 d-flex flex-wrap justify-content-end my-4">
          <img src="{{$project->getImageUri()}}" class="img-fluid" alt="">
        </div>

        <input type="submit" class="btn btn-primary align-self-end fw-bold w-50" value="Save">
      </form>
    </div>
  </div>
</section>
@endsection





        
        
          

      
    
        
        
      
        
        

      


      



        
