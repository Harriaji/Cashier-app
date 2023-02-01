@extends('layouts.app')

@section('content')
<div class="container">
    @if (count($errors)>0)
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          
        </ul>
    </div>
@endif  
@if (session()->has('succes'))
<div class="row">
<div class="col-5">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('succes')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
</div>
</div>
@endif
    <div class="row justify-content-center">


        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Master Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table table-responsive-striped">
                         
                            <thead>
                                <td>#</td>
                                <td>Nama Kategory</td>
                                <td>Action</td>
                            </thead>
                            @foreach ($category as $categories) 
                            <tr>
                              
                                <td>{{$loop->iteration}}</td>
                                <td>{{$categories->name}}</td>
                                <td>
                                    <a href="Category/{{$categories->id}}/edit" class="btn btn-warning">Edit</a>
                            <form class="d-inline" method="POST" action="{{route('Category.destroy',$categories->id)}}">  
                                @method('delete')
                                @csrf          
                                <button type="submit" class="btn btn-danger btn-circle ">Hapus</button>  
                                </td>    
                            </form>   
                            </tr>
                            @endforeach
                        </table>
                  
                </div>
            </div>
        </div>
      
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Add Category') }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form method="POST" enctype="multipart/form-data" action="{{route('Category.store')}}" >
                                @csrf
                                <label for="name">Nama Category</label>
                                <input class="form-control mb-2" type="text" name="name" id="">
                               
                                <input class="btn btn-success" type="submit" name="" value="Simpan">
                                <input class="btn btn-danger" type="button" name="" value="Batal">     
                            </form>    
                    </div>                   
                    </div>
                </div>
            </div>
       
    </div>
</div>
@endsection
