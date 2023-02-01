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
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Transaction') }}</div>

                <table class="table table-responsive table-stripped">
                    <thead>
                        <td>#</td>
                        <td>Category</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Stock</td>
                        <td>Action</td>
                    </thead>
                 
                    <tr>
                    @if($item->isEmpty())
                        <tr>
                            <td class="text-center" colspan="5">There is no item in chart</td>
                        </tr>
                    @else
                    @foreach($item as $item)    
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->Category->name}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->stock}}</td>
                    <form action="{{route('Transaction.store')}}" method="POST" >
                        @csrf
                        <td>
                            <input type="hidden" name="item_id" value="{{$item->id}}" >
                            <input type="hidden" name="qty" value="1" >
                            <button type="submit" class="btn btn-success">Add to Cart</button>
                        </td>
                    </form>
                    </tr>
                    @endforeach 
                    @endif
                </table>
                
                

            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ __('Cart') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-responsive table-stripped">
                        <thead>
                            <td>#</td>
                            <td>Nama</td>   
                            <td>Qty</td>
                            <td>Subtotal</td>
                            <td>Action</td>
                        </thead>  

                        <tr>                 
                            @if($carts->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="5">There is no item in chart</td>
                                </tr>
                            @else
                            @foreach ($carts as $cart)            
                            <td>{{$loop->iteration}}</td>
                            <td>{{$cart->name}}</td>
                            <form action="{{route('Transaction.update', $cart->cart->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <td><input type="number" name="qty" id="qty" min="1" max="{{$cart->stock + $cart->cart->qty}}" class="form-control" value="{{$cart->cart->qty}}" onchange="ubah{{$loop->iteration}}()"></td>
                                <script>
                                    function ubah{{$loop->iteration}}(){
                                        document.getElementById("update{{$loop->iteration}}").style.display="inline";
                                        document.getElementById("hapus{{$loop->iteration}}").style.display="none";
                                    }
                                </script>
                                <td>{{number_format($cart->price*$cart->cart->qty)}}</td>
                                <td>
                                        <button type="submit" class="btn btn-sm btn-primary text-light" id="update{{$loop->iteration}}" style="display: none">Update</button>
                            </form>
                            <form action="{{route('Transaction.destroy', $cart->cart->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                               
                                <button type="submit" class="btn btn-sm btn-danger text-light" id="hapus{{$loop->iteration}}">Hapus</button>
                            </td>
                            </form>
                          
                                </tr> 
                                @endforeach
                                @endif   
                            
                            
                <form action="{{route('transaction.checkout')}}" method="POST">
                    @csrf                        
                    <tr>
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="">
                        <td colspan="3">Total :</td>
                        <td colspan="2"><input class="form-control" readonly type="number" name="total" value="{{$carts->sum(function ($item){
                            return $item->price * $item->cart->qty;
                        })}}" ></td>
                    </tr>
                    <tr>
                        <td colspan="3">Payment :</td>
                        <td colspan="2"><input class="form-control" type="number"  name="pay_total" value="" required ></td>
                    </tr>

                    <tr>
                        <td><input type="submit" class="btn btn-primary" value="Checkout"></td>
                      
                        <td><a type="reset" class="btn btn-danger" value="" href="{{route('transaction.reset')}}">Reset</a></td>
                    </tr>
                </form>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection