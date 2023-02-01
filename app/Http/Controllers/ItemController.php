<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::all();
        $category = Category::all();
        return view('layouts.masteritems',compact('item','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('layouts.masteritems');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute harus diisi dulu',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter',
            'numeric' => ':attribute harus berupa angka',
            'mimes' => 'file yang didukung yaitu jpg,jpeg,giv,svg,cr2',
            'size' => 'file yang diupload maksimal :size',

        ] ;

        $this->validate($request,[
        'category_id' => 'required|numeric',
        'name' => 'required|min:3',
        'stock' => 'required|numeric',
        'price' => 'required|numeric',

      ],$message);     

      Item::create([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'stock' => $request->stock,
        'price' => $request->price,
      ]);
        return redirect('/Item')->with('succes','Input data success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $category = Category::all();
        return view('layouts.editItem', compact('item','category'));
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
        $message = [
            'required' => ':attribute harus diisi dulu',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attibute maksimal :max karakter',
            'numeric' => ':attribute harus berupa angka',
          
        ] ;

        $this->validate($request,[
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|numeric',
    

      ],$message);

      $item = item::find($id);
      $item->category_id = $request->category_id;
      $item->name = $request->name;
      $item->stock = $request->stock;
      $item->price = $request->price;
      $item->save();
      return redirect('/Item')->with('succes','Update data success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $item = Item::find($id)->delete();
       return redirect('/Item')->with('succes','Delete Succes');
    }
}
