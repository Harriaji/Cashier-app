@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="container">
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                  
                </ul>
            </div>
        @endif  
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Edit     Item') }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form action="{{route('Item.update',['Item' => $item->id ])}}" method="POST">
                                @csrf
                              {{  @method_field('put')}}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label for="inputGroupSelect01" class="input-group-text">Category</label>
                                    </div>
                                    <select name="category_id" id="inputGroupSelect01" class="custom-select form-control">
                                                   
                                        @foreach ($category as $ctg)
                                        <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                                        @endforeach                   
                                    </select>
                                </div>  
                            
                            <div class="form-group mb-1">
                                <label for="">Name</label>
                                <input class="form-control" type="text" name="name" value="{{$item->name}}">
                            </div>
                          
                            <div class="form-group mb-3">
                                <label for="">Stock</label>
                                <input type="text" class="form-control" name="stock" value="{{$item->stock}}" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Price</label>
                                <input type="text" class="form-control" name="price" value="{{$item->price}}">
                            </div>
                                <button class="btn btn-primary" type="submit" name="" >Buat</button>
                                <input class="btn btn-danger" type="button" name="" value="Batal">
                            </form>
                            
                            
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection