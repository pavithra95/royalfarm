<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Tax::all();

        return view('tax.index')->with(compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tax.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $tax = new Tax();
       $tax->tax_name = $request->name;
       $tax->tax_rate = $request->tax_rate;
       $tax->save();
       return redirect('/taxes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Tax::find($id);
        return view('tax.edit')->with(compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Tax::find($id);
        $item->tax_name = $request->name;
       $item->tax_rate = $request->tax_rate;
        $item->save();
        return redirect('/taxes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unit = Tax::find($id);
    
    // Check if the unit is linked with any products
    $productCount = Product::where('tax_name', $id)->count();
    $productCountV = ProductVariant::where('tax_name', $id)->count();



    if ($productCount > 0 || $productCountV > 0) {
        // If the unit is linked with products, return an error message
        return response()->json([
            'success' => false,
            'message' => 'This Tax cannot be deleted because it is linked to products.'
        ]);
    }

    // If the unit is not linked, delete the unit
    $unit->delete();

    return response()->json([
        'success' => true,
        'message' => 'Tax deleted successfully!'
    ]);

}
    
    }

