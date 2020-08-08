@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">All Brands
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    {{-- {{ __('You are logged in!') }} --}}
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @endif

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Brand Name</th>
                            {{-- <th scope="col">User ID</th> --}}
                            <th scope="col">Brand Image</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                            <tr>
                            <th scope="row">{{$brands->firstItem()+$loop->index}}</th>
                              {{-- <td>{{$category->user_id}}</td> --}}
                            <td>{{$brand->brand_name}}</td>
                              <td>
                              <img src="{{asset($brand->brand_image)}}" style="width: 80px; height: 40px;" alt="">
                              </td>
                              <td>{{$brand->created_at->diffForHumans()}}</td>
                              <td>
                              <a href="{{url('Brand/Edit/'.$brand->id)}}" class="btn btn-primary">Edit</a>
                                <a href="{{url('Brand/delete/'.$brand->id)}}" onclick="return confirm('Are you Sure to delete?')" class="btn btn-danger">Delete</a>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{$brands->links()}}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Add Brands
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    {{-- {{ __('You are logged in!') }} --}}

                    <form action="{{route('store.brand')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="Add_Category">Add Brands</label>
                          <input type="text" name="brand_name" class="form-control @error('brand_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add Brand Name">

                          @error('brand_name')
                        <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label for="Add_Category">Brand Image</label>
                          <input type="file" name="brand_image" class="form-control @error('brand_image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">

                          @error('brand_image')
                        <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                      </form>



                </div>
            </div>
        </div>

        
@endsection
