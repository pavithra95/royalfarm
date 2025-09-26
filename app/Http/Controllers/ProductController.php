<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Models\Review;
use App\Models\Tax;
use App\Models\Unit;
use App\Models\Variant;
use App\Models\VariantDetail;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       // Get the query parameters for search and filters
    $search = $request->input('search');
    $category = $request->input('category');
    $unit = $request->input('unit');
    $status = $request->input('status');
    $variantType = $request->input('variant_type');

    // Base query for products
    $query = Product::query();

    // Apply search filter if provided
    if (!empty($search)) {
        $query->where('product_name', 'LIKE', '%' . $search . '%')->orderByRaw("CASE WHEN position = 0 THEN 1 ELSE 0 END, position ASC");
    }

    // Apply category filter if provided
    // if (!empty($category)) {
    //     $query->where('category_id', $category);
    // }
    if (!empty($category)) {
    $query->where(function ($q) use ($category) {
        $q->where('category_id', $category)
          ->orWhere('sub_category_id', $category);
    });
}


    // Apply unit filter if provided
    if (!empty($unit)) {
        $query->where(function ($query) use ($unit) {
            $query->whereHas('Sunit', function ($q) use ($unit) {
                $q->where('id', $unit);
            })
            ->orWhereHas('unit', function ($q) use ($unit) {
                $q->where('id', $unit);
            });
        });
    }


    
    // Apply variant type filter if provided
    if (!empty($variantType)) {
        $query->where('variant_type', $variantType);
    }
    $query->orderByRaw("CASE WHEN position = 0 THEN 1 ELSE 0 END, position ASC");


    // Paginate the results
    $items = $query->paginate(10)->appends($request->all());


    // Get the available categories and units for filters
    $categories = Category::all();
    $units = Unit::all();

    // Pass the data to the view
    return view('products.index')->with(compact('items', 'categories', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $attributes = Variant::all();
        $units = Unit::all();
        $taxes = Tax::all();
        return view('products.create')->with(compact('units','categories','attributes','taxes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //    dd($request->all());
    if ($request->product_type == 'simple') {
        $request->validate([
       
            'product_slug' => 'required|unique:products,slug|max:255', // Unique validation
            'simple_sku' => 'unique:products,s_sku|max:255', // Unique validation
            
          
        ],[
            'product_slug.unique' => 'The slug has already been taken. Please choose a different slug.',
            'simple_sku.unique' => 'The simple SKU has already been taken.',
           
        ]);
    } else {
        $request->validate([
       
            'product_slug' => 'required|unique:products,slug|max:255', // Unique validation
            // 'v_sku' => 'unique:products,v_sku|max:255', // Unique validation
          
        ],[
            'product_slug.unique' => 'The slug has already been taken. Please choose a different slug.',
            // 'v_sku.unique' => 'The variant SKU has already been taken.'
        ]);
    }
    
   

       $validated = $request->validate([
        'v_attribute_ids_tab3' => 'array',
        'v_attribute_values_tab3' => 'array',
        'v_prices' => 'array',
        'v_skus' => 'array',
        'v_stock' => 'array',
        'v_discount_price' => 'array',
        'v_weights' => 'array',
    ]);

        // Create the Product
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->slug = $request->product_slug;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->description = $request->description;
        $product->variant_type = $request->product_type;
        $product->s_sku = $request->simple_sku;
        $product->s_weight = $request->simple_weight;
        $product->s_price = $request->simple_price;
       
        $product->s_discount_price = $request->simple_discount_price;
        $product->tax_name = $request->simple_tax;
        $product->tax_type = $request->simple_tax_type;   
        $product->s_stock = $request->simple_stock;
        $product->s_unit_id = $request->simple_unit_id;
        $product->v_unit_id = $request->v_unit_id;
        $product->s_status = $request->simple_status;
        $product->v_sku = $request->v_sku;
        $product->v_stock = $request->v_total_stock;
        $product->v_status = $request->va_status;
        $product->sale = $request->sale ? $request->sale : 0;
        $product->new = $request->new ? $request->new : 0;
        $product->not_for_sale = $request->not_for_sale ? $request->not_for_sale : 0;

        if($request->product_type == 'simple' ){
            $tax = Tax::find($request->simple_tax);
            if($request->simple_discount_price != 0){
                if($request->simple_tax_type == 'exclusive'){
                    $gst_amt = ($request->simple_discount_price * $tax->tax_rate)/100;
                    $net_price = $request->simple_discount_price + $gst_amt;
                }else{
                    $gst_amt = $request->simple_discount_price -($request->simple_discount_price * (100/(100+$tax->tax_rate)));
                    $net_price = $request->simple_discount_price - $gst_amt;
                    // $net_price = $request->simple_discount_price;
                }
            }
            else{
                if($request->simple_tax_type == 'exclusive'){
                    $gst_amt = ($request->simple_price * $tax->tax_rate)/100;
                    $net_price = $request->simple_price + $gst_amt;
                }else{
                    $gst_amt = $request->simple_price -($request->simple_price * (100/(100+$tax->tax_rate)));
                    $net_price = $request->simple_price - $gst_amt;
                    // $net_price = $request->simple_price;
                }


            }
            $product->total_selling_price  = $net_price;
        }


        // Handle image uploads
        if ($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            
            
            $imageName1 = time() . '.' . $featured_image->getClientOriginalExtension();
            $featured_image->move(base_path('images/product_images'), $imageName1);

            $product->featured_image = $imageName1;
        }else{
            $product->featured_image='';
        }

        // if ($request->hasFile('gallery_image')) {
        //     $gallery_image = $request->file('gallery_image');
            
            
        //     $imageName2 = time() . '.' . $gallery_image->getClientOriginalExtension();
        //     $gallery_image->move(base_path('images/product_images'), $imageName2);
        //     $product->gallery_image = $imageName2;
        // } else{
        //     $product->gallery_image ='';
        // }
        if ($request->hasFile('simple_image')) {
            $simple_image = $request->file('simple_image');
            $imageName3 = time() . '.' . $simple_image->getClientOriginalExtension();
            $simple_image->move(base_path('images/product_images'), $imageName3);
            $product->s_image = $imageName3;
        }else{
            $product->s_image = '';
        }

       

        $product->save(); // Save the product

        if ($request->hasFile('gallery_image')) {
            $gallery_images = $request->file('gallery_image');
            $gallery_image_names = [];
        
            foreach ($gallery_images as $index => $gallery_image) {
                $imageName3 = time() . '_gallery_' . $index . '.' . $gallery_image->getClientOriginalExtension();
                $gallery_image->move(base_path('images/product_images'), $imageName3);
                $gallery_image_names[] = $imageName3; // Collect image names
            }
        
            // Save gallery images as a JSON array in the database (or you can store them in a separate table)
            $product->gallery_image = json_encode($gallery_image_names);
        }
        
        // Save product data (if not already saved)
        $product->save();

        if($request->product_type == 'variable' || $request->product_type == 'safety'){

        foreach ($validated['v_attribute_values_tab3'] as $rowIndex => $attributeValues) {
            if ($request->hasFile("v_image.$rowIndex")) {
                $v_image = $request->file("v_image.$rowIndex");
                $imageNameV1 = time() . '_' . $rowIndex . '.' . $v_image->getClientOriginalExtension();
                
                // Move the new image to the 'product_images' directory
                $v_image->move(base_path('images/product_images'), $imageNameV1);
        
                // Save the new image name in a variable
                $v_image = $imageNameV1;
            }else{
                $v_image='';
            }

                $tax = Tax::find($request->v_tax[$rowIndex]);
                if ($validated['v_discount_price'][$rowIndex] != 0) {  // Use variant discount price
                    if ($request->v_tax_type[$rowIndex] == 'exclusive') {
                        $v_gst_amt = ($validated['v_discount_price'][$rowIndex] * $tax->tax_rate) / 100;
                        $v_net_price = $validated['v_discount_price'][$rowIndex] + $v_gst_amt;
                    } else {
                        $v_gst_amt = $validated['v_discount_price'][$rowIndex] -($validated['v_discount_price'][$rowIndex] * (100/(100+$tax->tax_rate)));
                        $v_net_price = $validated['v_discount_price'][$rowIndex] - $v_gst_amt;
                        // $v_net_price = $validated['v_discount_price'][$rowIndex];
                    }
                } else {  // Use variant price
                    if ($request->v_tax_type[$rowIndex] == 'exclusive') {
                        $v_gst_amt = ($validated['v_prices'][$rowIndex] * $tax->tax_rate) / 100;
                        $v_net_price = $validated['v_prices'][$rowIndex] + $v_gst_amt;
                    } else {
                        $v_gst_amt = $validated['v_prices'][$rowIndex] -($validated['v_prices'][$rowIndex] * (100/(100+$tax->tax_rate)));
                        $v_net_price = $validated['v_prices'][$rowIndex] - $v_gst_amt;
                    }
                }

                // Create a new variation entry
                $variation = ProductVariant::create([
                'product_id' => $product->id,
                'weight' => $validated['v_weights'][$rowIndex], 
                'price' => $validated['v_prices'][$rowIndex], 
                'discount_price' => $validated['v_discount_price'][$rowIndex],    
                'image' => $v_image, 
                'sku' => $request->v_skus[$rowIndex], 
                'v_stock' => $request->v_stock[$rowIndex],
                'status' => $request->v_status[$rowIndex], 
                'tax_name' => $request->v_tax[$rowIndex], 
                'tax_type' => $request->v_tax_type[$rowIndex], 
                'total_selling_price' => $v_net_price,
            ]);
    
            // Store the attributes for each variation
            foreach ($attributeValues as $key => $value) {
                ProductVariantItem::create([
                    'variation_id' => $variation->id,
                    'attribute_id' => $validated['v_attribute_ids_tab3'][$rowIndex][$key], // The attribute ID (e.g., Color, Size)
                    'value' => $value, // The attribute value (e.g., Red, Small)
                ]);
            }
        }
        if($request->product_type == 'safety'){
            $product->v_stock = $product->Productvariants->sum('v_stock');
             $product->save();
        }
    }

        // Handle variants based on variant type
      
    return redirect('/products');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $product = Product::with('Productvariants.PvariantDetails')->findOrFail($id);
        // dd($product);
    // Fetch categories and subcategories for the dropdowns
    $categories = Category::all();
    $subcategories = Category::where('id',$product->sub_category_id)->get();
    $units = Unit::all();
    $taxes = Tax::all();

    // Get all attributes and their values for variants
    $pattributes =[];
    $pattributeValues=[];
    $pattributes = ProductVariant::where('product_id',$product->id)->get();
    foreach($pattributes as $a){
        $pattributeValues[] = ProductVariantItem::where('variation_id',$a->id)->get();
    }
    // dd($pattributeValues);
    $attributes = Variant::all();
    $attributeValues = VariantDetail::all();

    // dd($attributeValues );

    // Prepare the selected attributes and values for the product's variants
    $selectedAttributes = [];
    $selectedAttributeValues = [];

    // dd($Productvariants.PvariantDetails);
    foreach ($product->Productvariants as $variant) {
        foreach ($variant->PvariantDetails as $detail) {
            $selectedAttributes[] = $detail->variation_id;
            $selectedAttributeValues[] = $detail->attribute_value_id;
        }
    }

    

    return view('products.edit', compact(
        'product',
        'categories',
        'subcategories',
        'pattributes',
        'attributes',
        'attributeValues',
        'pattributeValues',
        'selectedAttributes',
        'selectedAttributeValues',
        'units',
        'taxes'
    ));

}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       
        // dd($request->all());
        $product = Product::find($id);
        if ($request->product_type == 'simple') {
            $request->validate([
                'product_slug' => 'required|unique:products,slug,' . $product->id . '|max:255', // Unique validation excluding current product
                'simple_sku' => 'unique:products,s_sku,' . $product->id . '|max:255', // Unique validation excluding current product
            ],[
                'product_slug.unique' => 'The slug has already been taken. Please choose a different slug.',
                'simple_sku.unique' => 'The simple SKU has already been taken.',
            ]);
        } else {
            $request->validate([
                'product_slug' => 'required|unique:products,slug,' . $product->id . '|max:255', // Unique validation excluding current product
                // 'v_sku' => 'unique:products,v_sku,' . $product->id . '|max:255', // Unique validation excluding current product
            ],[
                'product_slug.unique' => 'The slug has already been taken. Please choose a different slug.',
                // 'v_sku.unique' => 'The variant SKU has already been taken.',
            ]);
        }
        $product->product_name = $request->product_name;
        $product->slug = $request->product_slug;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->description = $request->description;
        $product->variant_type = $request->product_type;
        $product->s_sku = $request->simple_sku;
        $product->s_price = $request->simple_price;
        $product->s_weight = $request->simple_weight;
        $product->s_discount_price = $request->simple_discount_price;
        $product->tax_name = $request->simple_tax;
        $product->tax_type = $request->simple_tax_type;  
       
        $product->s_stock = $request->simple_stock;
        $product->s_unit_id = $request->simple_unit_id;
        $product->s_status = $request->simple_status;
        $product->v_sku = $request->v_sku;
        $product->v_stock = $request->v_total_stock;
        $product->v_unit_id = $request->v_unit_id;
        $product->v_status = $request->va_status;
        $product->sale = $request->sale ? $request->sale : 0;
        $product->new = $request->new ? $request->new : 0;
        $product->not_for_sale = $request->not_for_sale ? $request->not_for_sale : 0;

        if($request->product_type == 'simple' ){
            $tax = Tax::find($request->simple_tax);
            if($request->simple_discount_price != 0){
                if($request->simple_tax_type == 'exclusive'){
                    $gst_amt = ($request->simple_discount_price * $tax->tax_rate)/100;
                    $net_price = $request->simple_discount_price + $gst_amt;
                }else{
                    $gst_amt = $request->simple_discount_price -($request->simple_discount_price * (100/(100+$tax->tax_rate)));
                    $net_price = $request->simple_discount_price - $gst_amt;
                    // $net_price = $request->simple_discount_price;
                }
            }
            else{
                if($request->simple_tax_type == 'exclusive'){
                    $gst_amt = ($request->simple_price * $tax->tax_rate)/100;
                    $net_price = $request->simple_price + $gst_amt;
                }else{
                    $gst_amt = $request->simple_price -($request->simple_price * (100/(100+$tax->tax_rate)));
                    $net_price = $request->simple_price - $gst_amt;
                    // $net_price = $request->simple_price;
                }


            }
            $product->total_selling_price  = $net_price;
        }


        // Handle image uploads

        if ($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            $imageName1 = time() . '.' . $featured_image->getClientOriginalExtension();
            $featured_image->move(base_path('images/product_images'), $imageName1);
    
            // Delete old image if exists
            if ($product->featured_image && file_exists(base_path('images/product_images/' . $product->featured_image))) {
                unlink(base_path('images/product_images/' . $product->featured_image));
            }
    
            // Update with new image name
            
            $product->featured_image = $imageName1;
        }
        if ($request->hasFile('gallery_image')) {
            $gallery_images = $request->file('gallery_image');
            $gallery_image_names = [];
        
            foreach ($gallery_images as $index => $gallery_image) {
                // Generate a unique name for each image
                $imageName33 = time() . '_gallery_' . $index . '.' . $gallery_image->getClientOriginalExtension();
                
                // Move the image to the 'product_images' directory
                $gallery_image->move(base_path('images/product_images'), $imageName33);
        
                // Collect the new image names
                $gallery_image_names[] = $imageName33;
            }
        
            // If there are existing gallery images, delete them
            if ($product->gallery_image) {
                $existing_images = json_decode($product->gallery_image, true); // Decode existing images from JSON
                if (is_array($existing_images)) {
                    foreach ($existing_images as $existing_image) {
                        $existing_image_path = base_path('images/product_images/' . $existing_image);
                        if (file_exists($existing_image_path)) {
                            unlink($existing_image_path); // Delete each existing image
                        }
                    }
                }
            }
        
            // Save the new gallery images (as JSON) to the product
            $product->gallery_image = json_encode($gallery_image_names);
            $product->save(); // Don't forget to save the product
        }
        

        if ($request->hasFile('simple_image')) {
            $simple_image = $request->file('simple_image');
            $imageName3 = time() . '.' . $simple_image->getClientOriginalExtension();
            $simple_image->move(base_path('images/product_images'), $imageName3);
    
            // Delete old image if exists
            if ($product->s_image && file_exists(base_path('images/product_images/' . $product->s_image))) {
                unlink(base_path('images/product_images/' . $product->s_image));
            }
    
            // Update with new image name
            
            $product->s_image = $imageName3;
        }

        $product->save(); 
        $variants = ProductVariant::where('product_id', $id)->get();

        // foreach ($variants as $variant) { // Get all variant items for each variant
        //     $variantItems = ProductVariantItem::where('variation_id', $variant->id)->get();
    
           
        //     foreach ($variantItems as $item) {  
        //         $item->delete();
        //     }
        
        //     $variant->delete();
        // }

        if ($request->product_type == 'variable' || $request->product_type == 'safety') {
            $ps_ids = $request->input('ps_id');
            $weights = $request->input('o_weights');
            $o_sku = $request->input('o_sku');
            $o_stock = $request->input('o_stock');
            $prices = $request->input('o_prices');
            $discount_prices = $request->input('o_discount_price'); 
            $statuses = $request->input('o_status'); // Optional: for updating status
            $images = $request->input('old_o_image'); 
            $o_tax_name = $request->input('o_tax_name'); 
            $o_tax_type = $request->input('o_tax_type'); 
            if (!empty($ps_ids)) {
                foreach ($ps_ids as $index => $ps_id) {
                    // Find the ProductVariant by ps_id
                    $variant = ProductVariant::find($ps_id);
        
                    if ($variant) {
                        // Update the price and other fields if they exist
                        $variant->price = isset($prices[$index]) ? $prices[$index] : $variant->price;
                        $variant->sku = isset($o_sku[$index]) ? $o_sku[$index] : $variant->sku;
                        $variant->v_stock = isset($o_stock[$index]) ? $o_stock[$index] : $variant->v_stock;
                        $variant->weight = isset($weights[$index]) ? $weights[$index] : $variant->weight;
                        $variant->discount_price = isset($discount_prices[$index]) ? $discount_prices[$index] : $variant->discount_price;
                        $variant->tax_name = isset($o_tax_name[$index]) ? $o_tax_name[$index] : $variant->tax_name;
                        $variant->tax_type = isset($o_tax_type[$index]) ? $o_tax_type[$index] : $variant->tax_type;
                        $variant->status = isset($statuses[$index]) ? $statuses[$index] : $variant->status;
                       
        
                        // Update image if needed
                        if ($request->hasFile("o_image.$index")) {
                            $o_image = $request->file("o_image.$index");
                            $imageName = time() . '_' . $index . '.' . $o_image->getClientOriginalExtension();
                            $o_image->move(base_path('images/product_images'), $imageName);
        
                            $variant->image = $imageName; // Save the new image path
                        } else {
                            $variant->image = isset($images[$index]) ? $images[$index] : $variant->image;
                        }
        
                        // Save the updated variant
                        $variant->save();

                        $o_tax = Tax::find($variant->tax_name);
                        // dd($o_tax);
                        if ($variant->discount_price != 0) {  // Use variant discount price
                            if ($variant->tax_type == 'exclusive') {
                                $o_gst_amt = ($variant->discount_price * $o_tax->tax_rate) / 100;
                                $o_net_price = $variant->discount_price + $o_gst_amt;
                            } else {
                                $o_gst_amt = $variant->discount_price -($variant->discount_price * (100/(100+$o_tax->tax_rate)));
                                $o_net_price = $variant->discount_price - $o_gst_amt;
                               
                            }
                        } else {  // Use variant price
                            if ($variant->tax_type == 'exclusive') {
                                $o_gst_amt = ($variant->price * $o_tax->tax_rate) / 100;
                                $o_net_price = $variant->price + $o_gst_amt;
                            } else {
                                $o_gst_amt = $variant->price -($variant->price * (100/(100+$o_tax->tax_rate)));
                                $o_net_price = $variant->price - $o_gst_amt;
                            }
                        }
                        $variant->total_selling_price = $o_net_price;
                        $variant->save();
                    }
                }
            }




            // if ($request->o_attribute_id_tab3) {
            //     foreach ($request->o_attribute_id_tab3 as $rowIndex => $attributeId) {
            //     // Debug check: make sure the row index exists in the prices array
            //     if (!isset($request->o_attribute_id_tab3[$rowIndex])) {
            //         // Handle the case where there is no price for this index (e.g., set a default price or skip)
            //         continue;  // Or handle it differently
            //     }
            
            //     // Handle image upload or retain old image
            //     if ($request->hasFile("o_image.$rowIndex")) {
            //         // Get the new image file for this index
            //         $o_image = $request->file("o_image.$rowIndex");
            //         $imageName10 = time() . '_' . $rowIndex . '.' . $o_image->getClientOriginalExtension();
            
            //         // Move the new image to the 'product_images' directory
            //         $o_image->move(base_path('images/product_images'), $imageName10);
            
            //         // Save the new image name in a variable
            //         $o_image = $imageName10;
            
            //     } else {
            //         // Check if the old image exists, else set it to an empty string
            //         $o_image = !empty($request->old_o_image[$rowIndex]) ? $request->old_o_image[$rowIndex] : ''; 
            //     }
            
            //     // Get the price for this row
            //     $price = $request->o_prices[$rowIndex];
            
            //     // Create a new variation entry
            //     $variation = ProductVariant::create([
            //         'product_id' => $product->id,
            //         'price' => $price, 
            //         'discount_price' => $request->o_discount_price[$rowIndex],    
            //         'image' => $o_image, 
            //         'status' => $request->o_status[$rowIndex], 
            //     ]);
            
            //     // Now loop through both o_attribute_id_tab3 and o_attribute_value_tab3
            //     $attributeValue = $request->o_attribute_value_tab3[$rowIndex] ?? null;  // Get the corresponding value
            
            //     // Create ProductVariantItems for each attribute

            //     // foreach ($request->o_attribute_ids_tab3 as $key => $attributeArray) {
            //         foreach ($attributeId as $value) {
            //             ProductVariantItem::create([
            //                 'variation_id' => $variation->id,
            //                 'attribute_id' => $value, // Attribute ID (e.g., Color, Size)
            //                 'value' => $value, // Attribute value (e.g., Red, Small)
            //             ]);
            //         // }
                   
                
            // }  
                
            
                   
            //     }
            // }
            
        
        
            if ($request->v_attribute_values_tab3) {
                foreach ($request->v_attribute_ids_tab3 as $rowIndex => $attributeValues) {
                    if ($request->hasFile("v_image.$rowIndex")) {
                        // Get the new image file for this index
                        $v_image = $request->file("v_image.$rowIndex");
                        $imageNameV = time() . '_' . $rowIndex . '.' . $v_image->getClientOriginalExtension();
                        
                        // Move the new image to the 'product_images' directory
                        $v_image->move(base_path('images/product_images'), $imageNameV);
                
                        // Save the new image name in a variable
                        $v_image = $imageNameV;
                
                    } else {
                        $v_image = ''; // Set to empty string if no image is uploaded
                    }
                    $tax = Tax::find($request->v_tax[$rowIndex]);
                    if ($request->v_discount_price[$rowIndex] != 0) {  // Use variant discount price
                        if ($request->v_tax_type[$rowIndex] == 'exclusive') {
                            $v_gst_amt = ($request->v_discount_price[$rowIndex] * $tax->tax_rate) / 100;
                            $v_net_price = $request->v_discount_price[$rowIndex] + $v_gst_amt;
                        } else {

                            $v_gst_amt = $request->v_discount_price[$rowIndex] -($request->v_discount_price[$rowIndex] * (100/(100+$tax->tax_rate)));
                            $v_net_price = $request->v_discount_price[$rowIndex] - $v_gst_amt;
                        }
                    } else {  // Use variant price
                        if ($request->v_tax_type[$rowIndex] == 'exclusive') {
                            $v_gst_amt = ($request->v_prices[$rowIndex] * $tax->tax_rate) / 100;
                            $v_net_price = $request->v_prices[$rowIndex] + $v_gst_amt;
                        } else {
                            $v_gst_amt = $request->v_prices[$rowIndex] -($request->v_prices[$rowIndex] * (100/(100+$tax->tax_rate)));
                            $v_net_price = $request->v_prices[$rowIndex] - $v_gst_amt;
                            // $v_net_price = $request->v_prices[$rowIndex];
                        }
                    }
        
                    // Create a new variation entry
                    $variation = ProductVariant::create([
                        'product_id' => $product->id,
                        'price' => $request->v_prices[$rowIndex], 
                        'weight' => $request->v_weights[$rowIndex], 
                        'discount_price' => $request->v_discount_price[$rowIndex],    
                        'image' => $v_image, 
                        'status' => $request->v_status[$rowIndex], 
                         'sku' => $request->v_skus[$rowIndex], 
                         'v_stock' => $request->v_stock[$rowIndex], 
                        'tax_name' => $request->v_tax[$rowIndex], 
                        'tax_type' => $request->v_tax_type[$rowIndex], 
                        'total_selling_price' => $v_net_price,
                    ]);

                  
                        // foreach ($request->v_attribute_ids_tab3 as $key => $attributeArray) {
                            foreach ($attributeValues as $value) {
                                ProductVariantItem::create([
                                    'variation_id' => $variation->id,
                                    'attribute_id' => $value, // Attribute ID (e.g., Color, Size)
                                    'value' => $value, // Attribute value (e.g., Red, Small)
                                ]);
                           
                        }  
                    // }   
                   
                }
            }
        }
        if($request->product_type == 'safety'){
            $product->v_stock = $product->Productvariants->sum('v_stock');
            $product->save();
        }
        
    
    }

    public function updateVariant(Request $request)
    {
        // Validate the incoming data
       

        // Find the variant to update
        $variant = ProductVariant::findOrFail($request->ps_id);

        // Update the fields
        $variant->price = $request->price;
        $variant->discount_price = $request->discount_price;
        $variant->status = $request->status;

        // Handle image upload if provided
        if ($request->hasFile('o_image')) {
            $imagePath = $request->file('o_image')->store('product_images', 'public');
            $variant->image = $imagePath;
        } elseif ($request->has('old_o_image')) {
            // If no new image is uploaded, keep the old image
            $variant->image = $request->old_o_image;
        }

        // Save the updated variant
        $variant->save();

        // Return a response
        return response()->json(['success' => true, 'message' => 'Variant updated successfully!']);
    }

       
    

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $product = Product::find($id);
        $variant = ProductVariant::where('product_id',$product->id)->get();
        if($variant){
            foreach($variant as $v){
                $pv = ProductVariantItem::where('variation_id',$v->id)->delete();
              $v->delete();  
            }

        }
    //    Review::where('product_id',$product->id)->delete();
        $product->delete();
        // return redirect()->back();
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully!'
        ]);

    }

    public function getSubcategories($categoryId)
{
    // Fetch subcategories where the parent_category_id matches the selected category
    $subcategories = Category::where('parent_category_id', $categoryId)->get();

    // Return the subcategories as a JSON response
    return response()->json($subcategories);
}

public function removeVariant($id)
{
    // dd($id);
    $variant = ProductVariant::find($id);
    
    if ($variant) {
        $variantItems = ProductVariantItem::where('variation_id', $variant->id)->get();
    
           
        foreach ($variantItems as $item) {  
               $item->delete();
        }
        $variant->delete();
        return response()->json(['success' => 'Variant removed successfully.']);
    }

    return response()->json(['error' => 'Variant not found.'], 404);
}
public function ShowProduct(){
    $items = Product::orderby('position')->get();
    return view('products.show')->with(compact('items'));
}
public function reorder(Request $request)
{
    foreach ($request->order as $item) {
        // dd( $item);
        Product::where('id', $item['id'])->update(['position' => $item['position']]);
    }

    return response()->json(['status' => 'success']);
}

public function updatePosition(Request $request)
{
    $productIds = $request->input('product_id');
    $positions = $request->input('position');

    if (is_array($productIds) && is_array($positions)) {
        foreach ($productIds as $index => $id) {
            $product = Product::find($id);
            if ($product) {
                $product->position = $positions[$index];
                $product->save();
            }
        }
    }

    return redirect()->back()->with('success', 'Product positions updated successfully.');
}




   }
