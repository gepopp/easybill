<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index')->with(['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string',
            'unit'        => 'required|string',
            'description' => 'string|nullable',
            'vat'         => 'required|numeric',
            'netto'         => 'required|numeric',
        ]);
        $data['user_id'] = \Auth::id();

        Product::create($data);

        return redirect()->route('products.index')->with(['products' => Product::all()]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit')->with(['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product      $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update( $request->validate([
            'name'        => 'required|string',
            'unit'        => 'required|string',
            'description' => 'string|nullable',
            'vat'         => 'required|numeric',
            'netto'         => 'required|numeric',
        ]));

        return redirect()->route('products.index')->with(['products' => Product::all()]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
}
