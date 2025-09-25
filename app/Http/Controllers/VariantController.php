<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use App\Models\VariantDetail;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Variant::all();
        return view('variants.index')->with(compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('variants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $variant = new Variant();
        $variant->type = $request->type;
        $variant->status = $request->status;
        $variant->save(); 

    
        if ($request->has('variants')) {
            foreach ($request->variants as $key => $variantData) {
                $variantItem = new VariantDetail();
                $variantItem->variant_id = $variant->id; 
                $variantItem->name = $variantData['name'];
                $variantItem->color = $variantData['color'];

                
                if (isset($variantData['image'])) {
                    $image = $variantData['image'];
                    $imageName = time() . '-' . $key . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/variant'), $imageName); 
                    $variantItem->image = 'images/variant/' . $imageName; 
                }

                $variantItem->save(); 
            }
        }

    return redirect('/variants');
    }

    /**
     * Display the specified resource.
     */
    public function show(Variant $variant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $variant = Variant::with('items')->findOrFail($id);
        return view('variants.edit')->with(compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $variant = Variant::findOrFail($id);
        $variant->type = $request->type;
        $variant->status = $request->status;
        $variant->save();
        
        VariantDetail::where('variant_id',$id)->delete();

        foreach($request->variants as $key=>$variantData){
            $item = new VariantDetail();
            $item->variant_id = $variant->id;
            $item->name = $variantData['name'];
            $item->color = $variantData['color'];
            if ($request->hasFile("variants.$key.existing_image")) {
                // Delete the old image if a new one is uploaded
                if ($item->image) {
                    $oldImagePath = public_path($item->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Store the new image
                $image = $request->file("variants.$key.existing_image");
                $imageName = time() . '-' . $key . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/variant'), $imageName);
                $item->image = 'images/variant/' . $imageName;
            } else {
                // If no new image is uploaded, keep the old image
                $item->image = $variantData['existing_image'];
            }
            $item->save();


        }

        return redirect('/variants');
    }


    public function attributesValue($attributeId)
    {
        // Fetch subcategories where the parent_category_id matches the selected category
        $attributesValue = VariantDetail::where('variant_id', $attributeId)->get();
       
    
        // Return the attributesValue as a JSON response
        return response()->json($attributesValue);

        
    }

    public function getVariantDetails(Request $request)
{
    // Fetch the variant details for the selected variant ids
    $variantIds = $request->input('attribute_values');

    // Get the variant details from the database
    $variantDetails = VariantDetail::whereIn('id', $variantIds)->get();
    // Return the variant details as a JSON response
    $variantDetails = $variantDetails->toArray();
        return response()->json(['variantDetails' => $variantDetails]); // Ensure it's an array
    
}

    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Variant::find($id)->delete();

        return redirect()->back();
    }
}
