@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="container">
            @if (count($errors)>0)
            <div class="alert alert-danger md-6">
                <ul>@foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                  
                </ul>
            </div>
        @endif  
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Edit Category') }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form method="POST" action="{{route('Category.update', ['Category' => $category->id])}}"  enctype="multipart/form-data" >
                                @csrf
                                {{method_field('put')}}
                                <label for="name">Category Name</label>
                                <input class="form-control mb-2" type="text" name="name" value="{{$category->name}}" >
                                <br>
                                <button class="btn btn-success" type="submit" name="" value="">Simpan</button>
                                <a class="btn btn-danger" type="button" name=""  href="/Category">Batal</a>
                            </form>    
                               
                      
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection