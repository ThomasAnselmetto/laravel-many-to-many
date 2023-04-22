@extends('layouts.app')

@section('content')
<section class="container">
  @section('title')
  <h1 class="mt-4 mb-5">Create and Edit Type</h1>
  @endsection

  @include('partials.errors')

  <div class="card col-5">
    <div class="card-body">
      {{-- rendo riutilizzabile il form sia per il create che per l'edit --}}
      {{-- aggiungo enctype perche avendo aggiunto le immagini al portfolio ho bisogno di enctype per i file
         --}}
      @if ($type->id)
      <form method="POST" action="{{route('admin.types.update', $type)}}" enctype="multipart/form-data" class="row">
      @method('PUT')
  @else
      <form method="POST" action="{{route('admin.types.store')}}" enctype="multipart/form-data" class="row">
  @endif 
      @csrf
      

          <div class="col-12 my-2">
            <label class="form-label" for="label">Label</label>
            <input type="text" name="label" id="label" class="@error('label') is-invalid @enderror form-control" value="{{old('label', $type->label)}}">
            @error('label')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-12 my-2">
            <label class="form-check ps-0" for="color">Color</label>
            <input type="color" name="color" id="color" class="@error('color') is-invalid @enderror form-check-control" value="{{old('color', $type->color)}}">
            @error('color')
            <div class="invalid-feedback">
              {{$message}}
            </div> 
            @enderror
        </div>
        
        <div class="col-8">
          <input type="submit" class="btn btn-primary align-self-end fw-bold col-3 mt-3" value="Save">
        </div>
      </form>
    </div>
  </div>
  </section>
  @endsection
            



  
        
           
        
             
        

      
    

      
        
        
      
        
        

      


      



