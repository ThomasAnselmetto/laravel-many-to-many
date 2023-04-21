@extends('layouts.app')

@section('content')
<section class="container">
  @section('title')
  <h1 class="mt-4 mb-5">Create and Edit</h1>
  @endsection

  @include('partials.errors')

  <div class="card">
color    <div class="card-body">
      {{-- rendo riutilizzabile ilform sia per il create che per l'edit --}}
      {{-- aggiungo enctype perche avendo aggiunto le immagini al portfolio ho bisogno di enctype per i file
         --}}
      @if ($type->id)
      <form method="POST" action="{{route('admin.types.update', $type)}}" enctype="multipart/form-data" class="row">
      @method('PUT')
  @else
      <form method="POST" action="{{route('admin.types.store')}}" enctype="multipart/form-data" class="row">
  @endif 
      @csrf
      
      <div class="col-8">
          <div class="col-6 my-2">
            <label class="form-label" for="label">Label</label>
            <input type="text" name="label" id="label" class="@error('label') is-invalid @enderror form-control" value="{{old('label', $type->label)}}">
            @error('label')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="col-3 my-2">
            <label class="form-label" for="color">color</label>
            <input type="color" name="color" id="color" class="@error('color') is-invalid @enderror form-control" value="{{old('color', $type->color)}}">
            @error('color')
            <div class="invalid-feedback">
              {{$message}}
            </div> 
            @enderror
        </div>
        <div class="col-3">
          <input type="submit" class="btn btn-primary align-self-end fw-bold w-50" value="Save">
        </div>
      </div>
      
    

      
    </form>
        
        
      
        
        

      

    </div>
  </div>
</section>
@endsection

      



