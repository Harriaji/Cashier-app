@extends('layouts.app')
@section('content')

    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <a href="/Transaction" class="btn btn-primary">Back</a>
            <br>
            <br>
            <div class="card">
                <div class="card-header text-center">{{ __('Detail Transaction') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table>
                   
                        <thead>
                            <td>Date of Transaction - </td>
                            <td class="ml mb-2 text-center" >{{date ('d - F - Y' , strtotime($detail->created_at))}}</td>
                        </thead>
                        <tr>
                            <td>Served By </td>
                            <td class="ml mb-2 text-center">{{$detail->user->name}}</td>
                        </tr>
                    </table>
                    <table class="table table-responsive table-stripped">
                        <thead>
                            <td>#</td>
                            <td>Nama</td>   
                            <td>Qty</td>
                            <td>Price</td>
                            <td>Subtotal</td>
                           
                        </thead>
                        @foreach($detail->detail as $dtl)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$dtl->item->name}}</td>
                            <td>
                            {{$dtl->qty}}
                            </td>
                            <td>{{number_format($dtl->item->price)}}</td>
                            <td>{{number_format($dtl->qty * $dtl->item->price)}}</td>
                        @endforeach
                     </tr>    
                    <tr>
                        <td colspan="4" class="text-end">Grand Total :</td>
                        <td colspan="2">{{number_format($detail->total)}}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end">Payment :</td>
                        <td colspan="2">{{number_format($detail->pay_total)}}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end" >Change : </td>
                        <td colspan="2">{{number_format($detail->pay_total - $detail->total)}}</td>
                    </tr>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection