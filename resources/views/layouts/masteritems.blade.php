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
                <div class="card-header">{{ __('Master Item') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table table-responsive-striped">
                            <thead>
                                <td>#</td>
                                <td>Category</td>
                                <td>Name</td>
                                <td>Stock</td>
                                <td>Price</td>
                                <td>Action</td>
                            </thead>
                            <tr>
                                @foreach ($item as $item)
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->category->name}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->stock}}</td>
                                <td>{{number_format($item->price)}}</td>
                                <td>
                                <a href="Item/{{$item->id}}/edit" class="btn btn-warning">Edit</a>
                                <form action="{{route('Item.destroy',$item->id)}} " method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Hapus</button>    
                                </form>
                                </td>    
                               
                            </tr>
                            @endforeach
                        </table>
                  
                </div>
            </div>
        </div>
      
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Add Item') }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form method="POST" enctype="multipart/form-data" action="{{route('Item.store')}}" >
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label for="inputGroupSelect01" class="input-group-text">Category</label>
                                    </div>
                                    <select name="category_id" id="inputGroupSelect01" class="custom-select form-control">
                                        <option selected>-</option>                    
                                        @foreach ($category as $ctg)
                                        <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                                        @endforeach                   
                                    </select>
                                </div>
                            
                            <div class="form-group mb-1">
                                <label for="">Name</label>
                                <input class="form-control" type="text" name="name">
                            </div>
                          
                            <div class="form-group mb-3">
                                <label for="">Stock</label>
                                <input type="number" class="form-control" name="stock">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Price</label>
                                <input type="number" class="form-control" name="price">
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
