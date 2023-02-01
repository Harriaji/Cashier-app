<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Item;
use App\Models\Transaction_Details;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $item = Item::doesntHave('cart')->where('stock', '>'  ,0)->get()->sortBy('name');
        $carts = Item::has('cart')->get()->sortByDesc('cart.create_at');
        return view('layouts.transaction',compact('item','carts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  
       cart::create($request->all());
       return redirect()->back()->with('status','Item added to cart');
       $message = [
        'required' => ':attribute harus diisi dulu',
        'min' => ':attribute minimal :min karakter',
        'max' => ':attribute maksimal :max karakter',
        'numeric' => ':attribute harus berupa angka'

    ] ;

    $this->validate($request,[
    'total' => 'required|numeric',
    'pay_total' => 'required|numeric',

  ],$message);   

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = Transaction::find($id);
        return View('layouts.showTransaction',compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        cart::findorFail($id)->update($request->all());
        return redirect()->back()->with('status','Item Quantity Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        cart::findorFail($id)->delete();
        return redirect()->back()->with('status','Item removed from the cart');
    }

    public function transaction(){
        $histories = Transaction::all()->sortByDesc('created_at');
        return view('layouts.historyTransaction',compact('histories'));
    }

    public function checkout(request $request){

        $transaction = Transaction::create($request->all());
        foreach(cart::all() as $item) {
            Transaction_Details::create([
                'transaction_id' => $transaction->id,
                'item_id'        => $item->item_id,
                'qty'            => $item->qty,
                'subtotal'       => $item->item->price * $item->qtt
            ]);
        }

        cart::truncate();
        return redirect(route('Transaction.show', $transaction->id));

    }

    public function reset(){
        Cart::whereNotNull('id')->delete();
        return back();
    }
 
}
