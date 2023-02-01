<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $category = Category::all();
        return view('layouts.mastercategory',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.mastercategory');
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
            'max' => ':attibute maksimal :max karakter',
            'numeric' => ':attribute harus berupa angka',
        ] ;

        $this->validate($request, [
            // 'id' => 'required|numeric',
            'name' => 'required|min:3|'
        ], $message);

        Category::create([
            // 'id' => $request->id,
            'name' => $request->name,    
        ]);

        return redirect('/Category')->with('succes','Input data succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('layouts.editCategory',compact('category'));
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
            // 'id' => 'required|numeric',
            'name' => 'required|min:4',
    

      ],$message);

      $category = Category::find($id);
    //   $jenis->id = $request->id;
      $category->name = $request->name;
      $category->update();
      return redirect('/Category')->with('succes','Update data success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Category = Category::find($id)->delete();
        return redirect('/Category')->with('succes', 'Delete success');    
    }
}
