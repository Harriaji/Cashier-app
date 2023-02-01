@extends('layouts.app')
@section('content')

    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('History Transaction') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    <table class="table table-responsive table-stripped">
                        <thead>
                            <td>#</td>
                            <td>Date</td>   
                            <td>Served By</td>
                            <td>Grand Total</td>
                            <td>Pay Total</td>
                            <td>Option</td>
                           
                        </thead>
                        @foreach ($histories as $history)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{date ('d - F - Y' , strtotime($history->created_at))}}</td>
                            <td>
                           {{$history->user->name}}
                            </td>
                            <td>{{number_format($history->total)}}</td>
                            <td>{{number_format($history->pay_total)}}</td>
                            <td>
                            <form action="" class="">
                                
                                    <a href="Transaction/{{$history->id}}" class="btn btn-primary" type="button" name="" value="">Details</a>
                            </form>
                            </td>
                        </tr>
                        @endforeach

                   
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection