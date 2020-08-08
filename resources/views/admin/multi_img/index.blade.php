@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="col-md-8">
           
           <div class="card-deck">
            @foreach ($images as $multi_image)
            <div class="col-md-4 mt-5">
               <div class="card">
               <img src="{{asset($multi_image->image)}}" width="300px" height="300px" class="card-img-top" alt="...">
                 <div class="card-body">
                   <h5 class="card-title"></h5>
                   <p class="card-text"></p>
                 <p class="card-text"><small class="text-muted">Last upload {{$multi_image->created_at->diffForHumans()}} </small></p>
                 </div>
               </div>
            </div>
               @endforeach
           </div>

       </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add Multiple Images
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    {{-- {{ __('You are logged in!') }} --}}

                    <form action="{{route('store.image')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                          <label for="Add_Category">Multiple Image</label>
                          <input type="file" name="image[]" class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" multiple>

                          @error('image')
                        <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Images</button>
                      </form>



                </div>
            </div>
        </div>

        
@endsection
