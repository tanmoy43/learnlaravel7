@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">All Category
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
                            <th scope="col">Category Name</th>
                            {{-- <th scope="col">User ID</th> --}}
                            <th scope="col">Added</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                
                            <tr>
                              <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                            <td>{{$category->category_name}}</td>
                              {{-- <td>{{$category->user_id}}</td> --}}
                              <td>{{$category->user->name}}</td>
                              <td>{{$category->created_at->diffForHumans()}}</td>
                              @if($category->updated_at==NULL)
                              <td>---</td>
                              @else
                              <td>{{$category->updated_at->diffForHumans()}}</td>
                              @endif
                              <td>
                                <a href="{{url('Category/Edit/'.$category->id)}}" class="btn btn-primary">Edit</a>
                                <a href="{{url('Softdelete/Category/delete/'.$category->id)}}" class="btn btn-danger">Delete</a>
                              </td>
                            </tr>
                            @endforeach

                        </tbody>
                      </table>
                      {{$categories->links()}}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Add Category
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    {{-- {{ __('You are logged in!') }} --}}

                    <form action="{{route('store.category')}}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="Add_Category">Add Category</label>
                          <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add Category">

                          @error('category_name')
                        <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                      </form>



                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
          <div class="card">
              <div class="card-header">Trash List
              </div>

              <div class="card-body">
                  {{-- @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif --}}

                  {{-- {{ __('You are logged in!') }} --}}
                  {{-- @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>{{session('success')}}</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif --}}

                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Category Name</th>
                          {{-- <th scope="col">User ID</th> --}}
                          <th scope="col">Added</th>
                          <th scope="col">Created at</th>
                          <th scope="col">Updated at</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($trash_category as $category)
                              
                          <tr>
                            <th scope="row">{{$trash_category->firstItem()+$loop->index}}</th>
                          <td>{{$category->category_name}}</td>
                            {{-- <td>{{$category->user_id}}</td> --}}
                            <td>{{$category->user->name}}</td>
                            <td>{{$category->created_at->diffForHumans()}}</td>
                            @if($category->updated_at==NULL)
                            <td>---</td>
                            @else
                            <td>{{$category->updated_at->diffForHumans()}}</td>
                            @endif
                            <td>
                              <a href="{{url('Category/Restore/'.$category->id)}}" class="btn btn-primary">Restore</a>
                            <a href="{{url('Category/Parmanent_delete/'.$category->id)}}" class="btn btn-danger">Parmanent Delete</a>
                            </td>
                          </tr>
                          @endforeach

                      </tbody>
                    </table>
                    {{$trash_category->links()}}
              </div>
          </div>
      </div>
      {{-- <div class="col-md-4"></div> --}}
    </div>
</div>
@endsection
