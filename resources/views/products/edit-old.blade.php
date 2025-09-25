@extends('adminlte::page')

@section('content_header')
<h1>{{ __('Edit Product') }}</h1>
@stop

@section('content')
<div class="row" id="test">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="m-0 text-dark col-md-6 float-left">Edit Product</h4>
                    </div>
                </div>
                <br>

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" role="form" class="col-md-12" id="variantForm" autocomplete="off">
                    {{ csrf_field() }}
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" name="product_name" id="product_name" class="form-control" required="required" value="{{ $product->product_name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_slug">Slug</label>
                                <input type="text" name="product_slug" id="product_slug" class="form-control" required="required" value="{{ $product->slug }}">
                                <span id="span1"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="featured_image">Product Featured Image</label>
                                <input type="file" name="featured_image" id="featured_image" class="form-control">
                                <small>Current Image: {{ $product->featured_image }}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gallery_image">Product Gallery Image</label>
                                <input type="file" name="gallery_image[]" id="gallery_image" class="form-control" multiple>
                                <small>Current Gallery Image: {{ $product->gallery_image }}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select id="category" name="category_id" class="form-control" required>
                                    <option value=""></option>
                                    @foreach($categories as $cat)
                                    <option value="{{$cat->id}}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subcategory">Sub category</label>
                                <select id="subcategory" name="sub_category_id" class="form-control">
                                    <option value=""></option>
                                    @foreach($subcategories as $subcat)
                                    <option value="{{$subcat->id}}" {{ $subcat->id == $product->sub_category_id ? 'selected' : '' }}>{{$subcat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id">Product Variant Type</label>
                                <select name="variant_type" id="variant_type_id" class="form-control" disabled>
                                    <option value=""></option>
                                    <option value="simple" {{ $product->variant_type == 'simple' ? 'selected' : '' }}>Simple Product</option>
                                    <option value="variable" {{ $product->variant_type == 'variable' ? 'selected' : '' }}>Variable Product</option>
                                </select>

                                <input type="hidden" id="variant_type_hidden" name="product_type" value="{{ $product->variant_type }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('Description') }} <i class="text-danger">*</i></label>
                                <textarea id="description" name="description" placeholder="{{ __('Enter product description') }}">{{ $product->description }}</textarea>
                            </div>
                        </div>

                        <!-- Preview of description -->
                        <div class="col-md-12">
                            <h4>{{ __('Preview') }}</h4>
                            <div id="descriptionPreview" class="border p-3">
                                {!! $product->description !!}
                            </div>
                        </div>
                    </div>

                    <!-- Card for Simple Product -->

                    <div id="simpleCard" class="card">
                        <div class="card-header">
                            <h3>Simple Product Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="simple_sku">SKU</label>
                                        <input type="text" name="simple_sku" class="form-control" value="{{ $product->s_sku }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="simple_price">Price</label>
                                        <input type="number" name="simple_price" class="form-control" value="{{ $product->s_price }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="simple_discount_price">Discount Price</label>
                                        <input type="number" name="simple_discount_price" class="form-control" value="{{ $product->s_discount_price }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="simple_stock">Stock</label>
                                        <input type="number" name="simple_stock" class="form-control" value="{{ $product->s_stock }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="simple_status">Status</label>
                                        <select name="simple_status" class="form-control">
                                            <option value="available" {{ $product->s_status == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="soldout" {{ $product->s_status == 'soldout' ? 'selected' : '' }}>Sold Out</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary col-md-2 offset-md-5 btn-sm">Update</button>
                    </div>

                    <div id="variableCard" class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs" id="tabMenu" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab">General</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab">Attributes</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab">Variations</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <!-- Tab 1 Content -->
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                                <form id="form-tab1" method="post">
                                                    <div class="form-group">
                                                        <label for="name">SKU</label>
                                                        <input type="text" class="form-control" id="sku" name="v_sku" value="{{$product->v_sku}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Total Stock</label>
                                                        <input type="number" class="form-control" id="total_stock" name="v_total_stock" value="{{$product->v_stock}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Status</label>
                                                        <select name="va_status" id="status" class="form-control">
                                                            <option value="available" {{ $product->v_status == 'available' ? 'selected' : '' }}>Available</option>
                                                            <option value="soldout" {{ $product->v_status == 'soldout' ? 'selected' : '' }}>Sold Out</option>


                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn btn-primary" id="tab1-ok">OK</button>
                                                </form>
                                            </div>

                                            <!-- Tab 2 Content -->


                                            <div class="tab-pane fade" id="tab2" role="tabpanel">
                                                <form action="" id="form-tab2" method="post">
                                                    <div id="attributes-container">
                                                        <div class="row attribute-row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name">Select Attributes</label>
                                                                    <select name="v_attributes[]" id="attributes[]" class="form-control attributes-dropdown">
                                                                        <option value="">Select an attribute</option>
                                                                        @foreach($attributes as $item)
                                                                        <option value="{{$item->id}}">{{$item->type}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="attribute_value">Attribute Value</label>
                                                                    <select class="form-control attribute-value-dropdown" id="attribute_value[]" name="v_attribute_value[]" multiple>
                                                                        <option value="">Select Attribute Value</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 text-right">
                                                                <button type="button" class="btn btn-danger remove-row" style="display: none;">Remove</button>
                                                            </div>
                                                        </div>
                                                        <button type="button" id="add-row" class="btn btn-primary">Add</button>
                                                        <button type="button" class="btn btn-primary float-right" id="tab2-ok">Save</button>
                                                    </div>
                                                </form>
                                            </div>



                                            <!-- Tab 3 Content -->
                                            <div class="tab-pane fade" id="tab3" role="tabpanel">


                                                @foreach($pattributes as $key=>$ps)

                                                @foreach($pattributeValues as $Values)
                                                <div class="row">
                                                    @foreach($Values as $pas) <!-- Nested loop to handle the collection -->

                                                    @if($ps->id == $pas->variation_id)

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <!-- <input type="text" value="{{$pas->value}}" class="form-control"> -->
                                                            <select name="o_attribute_id_tab3[]" id="attribute-select" class="form-control">
                                                                @foreach($attributeValues as $attr)
                                                                <option value="{{$attr->id}}" @if($pas->attribute_id == $attr->id) selected @endif>{{$attr->name}}</option>

                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" id="attribute-value-hidden" name="o_attribute_value_tab3[]" >

                                                            
                                                            
                                                        </div>
                                                    </div>

                                                    @endif
                                                    @endforeach
                                                </div>
                                                @endforeach


                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-link toggle-price" data-id="{{$ps->id}}">
                                                        &#9660; <!-- This is a down arrow symbol -->
                                                    </button>
                                                </div>

                                                <!-- Price field with default hidden state -->
                                                 <div class="row" id="price-{{$ps->id}}" style="display: none;">
                                                    <div class="d-flex border mb-3">
                                                 <div class="col-md-3 price-field" >
                                                    <div class="form-group">
                                                        <input type="hidden" value="{{$ps->id}}" name="ps_id[]">
                                                        <label for="">Price</label>
                                                        <input type="number" value="{{$ps->price}}" class="form-control" name="o_prices[]">
                                                    </div>
                                                </div> 
                                                <div class="col-md-3 price-field">
                                                    <div class="form-group">
                                                        <label for="">Discount Price</label>
                                                        <input type="number" value="{{$ps->discount_price}}" class="form-control" name="o_discount_price[]">
                                                    </div>
                                                    
                                                 </div> 
                                                 <div class="col-md-3 price-field">
                                                    <div class="form-group">
                                                        <label for="">Status</label>
                                                        <select name="o_status[]" id="status" class="form-control">
                                                            <option value="available" {{ $ps->status == 'available' ? 'selected' : '' }}>Available</option>
                                                            <option value="soldout" {{ $ps->status == 'soldout' ? 'selected' : '' }}>Sold Out</option>
                                                        </select>
                                                    
                                                 </div>
                                                
                                                </div>
                                                <div class="col-md-3 price-field">
                                                <div class="form-group">
                                                    <label for="gallery_image">Image</label>
                                                    <input type="file" name="o_image[]" id="o_image[]" class="form-control">
                                                    <input type="hidden" name="old_o_image[]" value="{{ $ps->image }}">

                                                    <!-- Display current image (optional) -->
                                                    @if($ps->image)
                                                        <img src="{{ asset('images/product_images/' . $ps->image) }}" alt="Variant Image" width="80">
                                                    @endif
                                                    
                                                </div>
                                                </div>
                                                 </div>
                                                 </div>

                                                @endforeach
                                                <div id="tab3-content">
                                                    <!-- Attributes and values will be dynamically inserted here -->
                                                </div>
                                            
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary col-md-2 offset-md-5 btn-sm">Update</button>
                    <!-- <a class="btn btn-danger col-md-2 btn-sm" href='#'>Cancel</a> -->
                </form>
            </div>
        </div>
    </div>
</div>
@stop


@section('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
   var appUrl = '{{ config('app.url') }}';
    var prefix = appUrl + '/products/';

    console.log(prefix);

    $(document).ready(function() {
        $('#description').summernote({
            height: 200,
            placeholder: 'Enter product description',
            callbacks: {
                onChange: function(contents, $editable) {
                    $('#descriptionPreview').html(contents);
                }
            }
        });
    });

    $(document).ready(function(){
    // When the page loads, set the hidden field to the current selected option
    $('#attribute-value-hidden').val($('#attribute-select option:selected').text());

    // Update the hidden input field when a new option is selected
    $('#attribute-select').on('change', function() {
        var selectedName = $('#attribute-select option:selected').text();
        $('#attribute-value-hidden').val(selectedName);
    });
});

    // JavaScript to toggle price field visibility
document.addEventListener("DOMContentLoaded", function () {
    // Add click event listener to all elements with the class "toggle-price"
    document.querySelectorAll(".toggle-price").forEach(function(button) {
        button.addEventListener("click", function() {
            // Get the related price field based on the data-id attribute
            var priceFieldId = this.getAttribute("data-id");
            var priceField = document.getElementById("price-" + priceFieldId);

            // Toggle the visibility of the price field
            if (priceField.style.display === "none") {
                priceField.style.display = "block";
            } else {
                priceField.style.display = "none";
            }
        });
    });
});

    $(document).ready(function() {
        // Initially hide both cards
        $('#simpleCard').hide();
        $('#variableCard').hide();

        // Handle variant type change
        $('#variant_type_id').change(function() {
            let variantType = $(this).val();
            console.log(variantType);

            if (variantType === 'simple') {
                // Show the Simple Product section
                $('#simpleCard').show();
                $('#variableCard').hide();
                $('#variant_type_hidden').val('simple'); // Set the hidden input value
                $('#variantForm button[type="submit"]').show(); // Show Create button

            } else if (variantType === 'variable') {
                // Show the Variable Product section
                $('#simpleCard').hide();
                $('#variableCard').show();
                $('#variant_type_hidden').val('variable'); // Set the hidden input value
                $('#variantForm button[type="submit"]').show(); // Show Create button
            } else {
                // Hide both sections if no variant type is selected
                $('#simpleCard').hide();
                $('#variableCard').hide();
                $('#variantForm button[type="submit"]').hide(); // Hide Create button
            }
        });

        // Trigger the change event to handle form load state
        $('#variant_type_id').trigger('change');
    });




    $('#variantForm').on('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);
        $('.attribute-row').each(function() {
            var attribute = $(this).find('.attributes-dropdown').val();
            var attributeValue = $(this).find('.attribute-value-dropdown').val();

            if (attribute && attributeValue) {
                formData.append('attributes[]', attribute);
                formData.append('attribute_values[]', attributeValue);
            }
        });

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('Form submitted successfully:', response);
                window.location.href = '/get-products';
            },
            error: function(xhr, status, error) {
                console.error('Form submission failed:', error);
            }
        });
    });

    function convertToSlug(text) {
        return text
            .toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
    }

    document.getElementById('product_slug').value = '{{ $product->slug }}';
    document.getElementById('span1').innerText = prefix + '{{ $product->slug }}';
   

    document.getElementById('product_name').addEventListener('input', function() {
        var productName = this.value;
        var slug = convertToSlug(productName);
        document.getElementById('product_slug').value = slug;
        document.getElementById('span1').innerText = prefix + slug;
    });

    document.getElementById('product_slug').addEventListener('keydown', function(e) {
        var cursorPosition = this.selectionStart;

        if (cursorPosition < prefix.length) {
            e.preventDefault();
        }
    });

    $(document).ready(function() {
        $('#category').on('change', function() {
            var categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: '/get-subcategories/' + categoryId,
                    type: 'GET',
                    success: function(response) {
                        var $subcategoryDropdown = $('#subcategory');
                        $subcategoryDropdown.empty();
                        $subcategoryDropdown.append('<option value="">Select a subcategory</option>');
                        $.each(response, function(index, subcategory) {
                            $subcategoryDropdown.append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching subcategories:', error);
                        alert('Could not load subcategories.');
                    }
                });
            } else {
                $('#subcategory').empty().append('<option value="">Select a subcategory</option>');
            }
        });
    });

    $(document).ready(function() {
        // Initially disable Tab 2 and Tab 3

        // When OK button in Tab 1 is clicked
        $('#tab1-ok').on('click', function() {
            // Get data from Tab 1
            $('#variant_type_hidden').val($('#variant_type_id').val());
            $('#variant_type_id').prop('disabled', true);
            let sku = $('#sku').val();
            let total_stock = $('#total_stock').val();
            let status = $('#status').val();

            if (sku || total_stock) {
                // Enable Tab 2
                $('#tab2-tab').removeClass('disabled').attr('data-toggle', 'tab');
                // Optionally, switch to Tab 2 after enabling it
                $('#tab2-tab').tab('show');
            } else {
                alert("Please enter a value.");
            }
        });

        $('#tab2-ok').on('click', function() {

            $('#tab3-tab').removeClass('disabled').attr('data-toggle', 'tab');
            // Optionally, switch to Tab 2 after enabling it
            // $('#tab3-tab').tab('show');
            let attributes = [];
            let attributeValues = [];
            let variantDetails = {};

            // Collect all attributes and values from Tab 2
            $('.attribute-row').each(function() {
                let attribute = $(this).find('.attributes-dropdown').val(); // Get selected attribute
                let values = $(this).find('.attribute-value-dropdown').val(); // Get selected values (IDs)

                if (attribute && values.length > 0) {
                    attributes.push(attribute);
                    attributeValues.push(values); // Store IDs for each attribute
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Fetch variant details from the backend using AJAX
            $.ajax({
                url: '/get-variant-details',
                type: 'POST',
                data: {
                    attribute_values: attributeValues.flat(), // Send all selected IDs
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    // Map variant details (ID -> Name)
                    response.variantDetails.forEach(function(detail) {
                        variantDetails[detail.id] = detail.name; // Store ID-to-name mapping
                    });

                    // Call function to display data in Tab 3
                    displayCombinationsInTab3(attributes, attributeValues, variantDetails);
                },
                error: function(xhr) {
                    console.error('Failed to fetch variant details:', xhr);
                }
            });
        });

        function displayCombinationsInTab3(attributes, attributeValues, variantDetails) {
            let tab3Content = $('#tab3-content'); // Tab 3 content area
            tab3Content.empty(); // Clear previous content

            // Generate all possible combinations of attribute values
            let combinations = generateCombinations(attributeValues);

            // Loop through each combination and display them in Tab 3
            combinations.forEach(function(combination, rowIndex) {
                let rowId = `row-${rowIndex}`;
                let rowHtml = `<div id="${rowId}" class="row mt-3">`;

                combination.forEach(function(value, index) {
                    let attribute = attributes[index]; // Get the attribute
                    let name = variantDetails[value]; // Get the corresponding name from variantDetails
                    // variantDetails is an object, e.g., {28: 'S', 29: 'M'}
                    let id = Object.keys(variantDetails).find(key => variantDetails[key] === name);
                    console.log(id);

                    // Create HTML for each attribute-value pair
                    rowHtml += `
                <div class="col-md-4">
                  
                   
                    <input type="hidden" class="form-control mb-2" name="v_attribute_ids_tab3[${rowIndex}][]" value="${id}" readonly>
                    <input type="text" class="form-control mb-2" name="v_attribute_values_tab3[${rowIndex}][]" value="${name}" readonly>
                </div>
            `;
                });
                rowHtml += `
            <div class="col-md-1">
                <button type="button" class="btn btn-link toggle-row" data-toggle="collapse" data-target="#extra-row-${rowIndex}">
                    ▼
                </button>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger remove-row" data-row-id="${rowId}" data-price-id="extra-row-${rowIndex}">
                    X
                </button>
            </div>
        `;
                rowHtml += '</div>';

                // Close row div
                rowHtml += `
            <div id="extra-row-${rowIndex}" class="row collapse">
                <div class="col-md-4">
                    <label>Price</label>
                    <input type="number" class="form-control mb-2" name="v_prices[${rowIndex}]" placeholder="Enter price">
                </div>
                <div class="col-md-4">
                    <label>Discount Price</label>
                    <input type="number" class="form-control mb-2" name="v_discount_price[${rowIndex}]" placeholder="Enter price">
                </div> 
                <div class="col-md-4">
                <label>Status</label>
                 <select name="v_status[${rowIndex}]" id="v_status" class="form-control">
                        <option value=""></option>
                        <option value="in_stock">In Stock</option>
                        <option value="out_stock">Out of Stock</option>
                 </select>
                     
                </div> 
                <div class="col-md-4">
                <label for="o">Image</label>
                <input type="file" name="v_image[${rowIndex}]" class="form-control">   
                </div>
            </div>
        `;

                tab3Content.append(rowHtml); // Append the generated row to Tab 3
            });
            $(document).on('click', '.remove-row', function() {
                let rowId = $(this).data('row-id');
                let priceId = $(this).data('price-id');

                // Remove the row and the associated price input
                $('#' + rowId).remove(); // Remove the row with the corresponding ID
                $('#' + priceId).remove(); // Remove the associated price input field
            });

            // Optional: Add functionality for the down arrow to toggle the visibility of the price input
            $(document).on('click', '.toggle-row', function() {
                let target = $(this).data('target');
                $(target).collapse('toggle'); // Toggle the collapse of the extra-row (price input)
            });
        }

        // Helper function to generate all combinations of attribute values
        function generateCombinations(attributeValues) {
            if (attributeValues.length === 0) return [];
            if (attributeValues.length === 1) return attributeValues[0].map(value => [value]);

            let restCombinations = generateCombinations(attributeValues.slice(1));
            let result = [];

            attributeValues[0].forEach(value => {
                restCombinations.forEach(combination => {
                    result.push([value].concat(combination));
                });
            });

            return result;
        }



        function getVariantById(variantDetails, id) {
            let variant = variantDetails.find(v => v.id == id); // Find the variant by its ID
            return variant ? {
                id: variant.id,
                name: variant.name
            } : {
                id: '',
                name: ''
            }; // Return the id and name if found, otherwise return empty strings
        }


    });

    $(document).ready(function() {
        // Initialize the multiselect plugin for attribute_value dropdown
        $('.attribute-value-dropdown').multiselect({
            includeSelectAllOption: true,
            enableFiltering: false,
            buttonWidth: '100%',
            nonSelectedText: 'Select Attribute Values'
        });
    });


    $(document).ready(function() {
        // On attribute change, fetch the attribute values via AJAX
        $(document).on('change', '.attributes-dropdown', function() {
            var $row = $(this).closest('.row'); // Get the closest row to the changed select
            var attributeId = $(this).val(); // Get the selected attribute ID
            var $attributeValueDropdown = $row.find('.attribute-value-dropdown'); // Find the corresponding attribute value dropdown in the same row

            if (attributeId) {
                $.ajax({
                    url: '/get-attributesValue/' + attributeId, // URL for fetching attribute values
                    type: 'GET',
                    success: function(response) {
                        $attributeValueDropdown.empty(); // Clear existing options

                        // Append the default option
                        // $attributeValueDropdown.append('<option value=""></option>');

                        // Append the fetched attribute values
                        $.each(response, function(index, attribute_value) {
                            $attributeValueDropdown.append('<option value="' + attribute_value.id + '">' + attribute_value.name + '</option>');
                        });

                        // Reinitialize multiselect after updating the options
                        $attributeValueDropdown.multiselect('rebuild');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching attribute values:', error);
                        alert('Could not load attribute values.');
                    }
                });

            } else {
                $attributeValueDropdown.empty().append('<option value="">Select Attribute Value</option>');
            }
        });

        $('#add-row').on('click', function() {
            // Clone the first row but do not copy over the event handlers or data
            var newRow = $('.attribute-row').first().clone(false, true); // clone without data but with events

            // Reset all select values (empty them out)
            newRow.find('select').val('');

            // Remove any old attribute value dropdowns, in case they exist in the row
            newRow.find('.attribute-value-dropdown').remove(); // Remove old dropdowns

            // Create a new select element for attribute value dropdown with the multiple attribute
            var newAttributeValueDropdown = $('<select>', {
                'class': 'form-control attribute-value-dropdown',
                'name': 'attribute_value[]',
                'multiple': 'multiple', // Make it a multi-select
                'html': '<option value="">Select Attribute Value</option>'
            });

            // Create a label for the attribute value dropdown
            var newLabel = $('<label>', {
                'for': 'attribute_value',
                'text': 'Attribute Value' // Label text
            });

            // Create a div to wrap the label and dropdown (optional, for better structure)
            var newDropdownContainer = $('<div>', {
                'class': 'form-group'
            }).append(newLabel, newAttributeValueDropdown);

            // Append the new attribute value dropdown (with label) to the row
            newRow.find('.col-md-6:last').html(newDropdownContainer);

            // Show the remove button for the new row
            newRow.find('.remove-row').show();

            // Append the new row to the container
            $('#attributes-container').append(newRow);

            // Initialize the multi-select dropdown (using Select2 or Bootstrap Multiselect)
            newRow.find('.attribute-value-dropdown').multiselect({
                includeSelectAllOption: true,
                enableFiltering: false, // Set to true if you want to allow filtering in the dropdown
                buttonWidth: '100%',
                nonSelectedText: 'Select Attribute Values'
            });
            // Listen for change on the attribute dropdown to update the attribute value dropdown
            newRow.find('.attributes-dropdown').on('change', function() {
                var selectedAttributeId = $(this).val();

                // If an attribute is selected, fetch corresponding attribute values via AJAX (or static data)
                if (selectedAttributeId) {
                    $.ajax({
                        url: '/get-attributesValue/' + selectedAttributeId, // Replace with your URL endpoint
                        type: 'GET',
                        success: function(response) {
                            // Clear the previous options
                            newAttributeValueDropdown.empty();

                            // Add a default empty option
                            newAttributeValueDropdown.append('<option value="">Select Attribute Value</option>');

                            // Loop through the data and add each option to the attribute-value dropdown
                            $.each(response, function(index, option) {
                                newAttributeValueDropdown.append('<option value="' + option.id + '">' + option.name + '</option>');
                            });

                            // Re-initialize select2 (to refresh the dropdown with new options)
                            newRow.find('.attribute-value-dropdown').trigger('change');
                        },
                        error: function() {
                            // Handle error if needed (e.g., show an error message)
                            // alert('Failed to fetch attribute values');
                        }
                    });
                } else {
                    // If no attribute is selected, clear the options
                    newAttributeValueDropdown.empty();
                    newAttributeValueDropdown.append('<option value="">Select Attribute Value</option>');
                }
            });
        });


        // Remove row functionality
        $(document).on('click', '.remove-row', function() {
            $(this).closest('.attribute-row').remove();
        });



    });
</script>
@stop