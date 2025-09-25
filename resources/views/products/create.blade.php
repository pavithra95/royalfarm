@extends('adminlte::page')

@section('content_header')
<h1>{{ __('Add Product') }}</h1>
@stop

@section('content')
<div class="row" id="test">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="m-0 text-dark col-md-6 float-left">Create Product</h4>
                    </div>
                </div>
                <br>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" role="form" class="col-md-12" id="variantForm" autocomplete="off">
                    {{ csrf_field() }}

                   <!-- Full-page overlay spinner -->
                    <div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.8); z-index: 9999; text-align: center;">
                        <div class="spinner" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <div class="double-bounce1"></div>
                            <div class="double-bounce2"></div>
                        </div>
                    </div>

                    <!-- <div id="errorMessages" style="display:none; color:red;"></div> -->
                   <div class="form-group row align-items-start">
    <label class="col-sm-2 col-form-label">Tag:</label>
    <div class="col-sm-10">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="1" name="sale" id="tagSale">
            <label class="form-check-label" for="tagSale">Sale</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="1" name="new" id="tagNew">
            <label class="form-check-label" for="tagNew">New</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="1" name="not_for_sale" id="tagNotForSale">
            <label class="form-check-label" for="tagNotForSale">Not For Sale</label>
        </div>
    </div>
</div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" name="product_name" id="product_name" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_slug">Slug</label>
                                <input type="text" name="product_slug" id="product_slug" class="form-control" required="required">
                                <span id="span1"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="featured_image">Product Featured Image</label>
                                <input type="file" name="featured_image" id="featured_image" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gallery_image">Product Gallery Image</label>
                                <input type="file" name="gallery_image[]" id="gallery_image" class="form-control" multiple required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select  name="category_id" class="form-control" required>
                                    <option value=""></option>
                                    @foreach($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subcategory">Sub category</label>
                                <select id="subcategory" name="sub_category_id" class="form-control">
                                    <option value=""></option>

                                </select>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id">Product Variant Type</label>
                                <select name="variant_type" id="variant_type_id" class="form-control" required>
                                    <option value=""></option>
                                    <option value="simple">Simple Product</option>
                                    <option value="variable">Variable Product</option>
                                    <option value="safety">Simple with Multi Variable</option>
                                </select>

                                <input type="hidden" id="variant_type_hidden" name="product_type">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('Description') }} <i class="text-danger">*</i></label>
                                <textarea id="description" name="description" placeholder="{{ __('Enter product description') }}"></textarea>
                                 <!-- Error message -->
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                            </div>
                        </div>

                        <!-- Preview of description -->
                        <div class="col-md-12">
                            <h4>{{ __('Preview') }}</h4>
                            <div id="descriptionPreview" class="border p-3"></div>
                        </div>
                    </div>

                    <!-- Card for simple Variant -->
                    <div id="simpleCard" class="card" style="display: none;">
                        <div class="card-header">
                            <h3>Simple Product Details</h3>
                        </div>
                        <div class="card-body">
                            <div id="variantRowTemplate" class="row">
                                <!-- Variant Row Template -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="measurement">SKU</label>
                                        <input type="text" name="simple_sku" class="form-control" placeholder="Enter Product Id">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="variant_image">Image</label>
                                        <input type="file" name="simple_image" id="simple_image" class="form-control">
                                    </div>
                                </div>
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" name="simple_price" class="form-control" placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="discount_price">Discount Price</label>
                                        <input type="text" name="simple_discount_price" class="form-control" value="0" placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="discount_price">Tax</label>
                                        <select name="simple_tax" id="" class="form-control">
                                            <option value=""></option>
                                            @foreach($taxes as $tax)
                                            <option value="{{$tax->id}}">{{$tax->tax_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="discount_price">Tax Type</label>
                                        <select name="simple_tax_type" id="" class="form-control" >
                                           
                                            <option value="inclusive">Inclusive</option>
                                            <!-- <option value="exclusive">Exclusive</option> -->

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="price">Weight</label>
                                        <input type="text" name="simple_weight" class="form-control">
                                    </div>
                                </div>
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="text" name="simple_stock" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="unit_id">Unit</label>
                                        <select name="simple_unit_id" class="form-control">
                                            <option value=""></option>
                                            @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="simple_status" class="form-control">
                                            <option value=""></option>
                                            <option value="available">Available</option>
                                            <option value="soldout">Sold Out</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary col-md-2 offset-md-5 btn-sm" style="display: none;">Create</button>
                            <!-- <span id="loadingSpinner" class="spinner-border text-primary" role="status" style="display: none;"></span> -->
                        <a class="btn btn-danger col-md-2 btn-sm" href='#'>Cancel</a>
                        </div>
                    </div>

                    <!-- variable -->
                    <div id="variableCard" class="card" style="display: none;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs" id="tabMenu" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab">General</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link disabled" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab">Attributes</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link disabled" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab">Variations</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <!-- Tab 1 Content -->
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                                <form id="form-tab1" method="post">
                                                    <div class="form-group" id="sku_group">
                                                        <label for="name">SKU</label>
                                                        <input type="text" class="form-control" id="sku" name="v_sku">
                                                    </div>
                                                    <div class="form-group" id="stock_group">
                                                        <label for="name">Total Stock</label>
                                                        <input type="text" class="form-control" id="total_stock" name="v_total_stock">
                                                    </div>
                                                    
                                                        <div class="form-group">
                                                            <label for="unit_id">Unit</label>
                                                            <select name="v_unit_id" class="form-control" id="v_unit_id">
                                                                <option value=""></option>
                                                                @foreach($units as $unit)
                                                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                   
                                                    <div class="form-group">
                                                        <label for="name">Status</label>
                                                        <select name="va_status" id="status" class="form-control">
                                                            <option value="in_stock">In Stock</option>
                                                            <option value="out_stock">Out of Stock</option>

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
                                                        <button type="button" class="btn btn-primary float-right" id="tab2-ok" disabled>Next</button>
                                                    </div>
                                                </form>
                                            </div>



                                            <!-- Tab 3 Content -->
                                            <div class="tab-pane fade" id="tab3" role="tabpanel">
                                                <div id="tab3-content">
                                                    <!-- Attributes and values will be dynamically inserted here -->
                                                </div>

                                                <button type="submit" class="btn btn-primary col-md-2 offset-md-5 btn-sm" style="display: none;">Create</button>
                                                <!-- <span id="loadingSpinner" class="spinner-border text-primary" role="status" style="display: none;"></span> -->
                                                <a class="btn btn-danger col-md-2 btn-sm" href='#'>Cancel</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                  

                        <!-- <button type="submit" class="btn btn-primary col-md-2 offset-md-5 btn-sm" style="display: none;">Create</button>
                        <a class="btn btn-danger col-md-2 btn-sm" href='#'>Cancel</a> -->
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Circle Spinner CSS */
.spinner {
    width: 40px;
    height: 40px;
    position: relative;
}

.double-bounce1, .double-bounce2 {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background-color: #3498db;
    opacity: 0.6;
    position: absolute;
    top: 0;
    left: 0;
    animation: bounce 2.0s infinite ease-in-out;
}

.double-bounce2 {
    animation-delay: -1.0s;
}

@keyframes bounce {
    0%, 100% {
        transform: scale(0);
    }
    50% {
        transform: scale(1);
    }
}
</style>
@stop

@section('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
<script>
    var appUrl = '{{ config('app.url') }}'; // Example value, replace with actual app URL
    var prefix = appUrl + '/products/';

    console.log(prefix);


    

   $(document).ready(function() {
    const description = $('#description');
    
    description.summernote({
        height: 200,
        placeholder: 'Enter product description',
        callbacks: {
            onChange: function(contents, $editable) {
                $('#descriptionPreview').html(contents);
            }
        }
    });

    // Trigger preview if editing existing description
    const initialContent = description.val();
    if (initialContent) {
        $('#descriptionPreview').html(initialContent);
    }
});


 
    $(document).ready(function() {
        // Initially hide both cards
        $('#simpleCard').hide();
        $('#variableCard').hide();

        // Handle variant type change
        $('#variant_type_id').change(function() {
            let variantType = $(this).val();

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
                // $('[id^="v_sku_group_"]').hide();
                $('#variant_type_hidden').val('variable'); // Set the hidden input value
                $('#variantForm button[type="submit"]').show(); // Show Create button
            } else if (variantType === 'safety') {
                // Show the Variable Product section
                $('#simpleCard').hide();
                $('#variableCard').show();
                $('#sku_group, #stock_group').hide();
                $('#variant_type_hidden').val('variable'); // Set the hidden input value
                $('#variantForm button[type="submit"]').show(); // Show Create button
            }
            else {
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
    event.preventDefault(); // Prevent default form submission

    // Get Summernote content and trim white spaces
    var summernoteContent = $('#description').summernote('isEmpty') ? '' : $('#description').val().trim();

    // Check if the description is empty
    if (summernoteContent === '') {
        alert('Please enter the product description.');
        return; // Stop form submission if the description is empty
    }

    // Show the full-page loading spinner
    $('#loadingOverlay').show();

    // Proceed with form submission using AJAX
    var formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'), // Your form submission URL
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log('Form submitted successfully:', response);
            window.location.href = '/products'; // Redirect after success
        },
        error: function(xhr, status, error) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                var errors = xhr.responseJSON.errors;
        var errorMessage = 'Please fix the following errors:\n\n';

        // Loop through each validation error and add it to the message
        $.each(errors, function(key, value) {
            errorMessage += '- ' + value[0] + '\n'; // Format each error nicely for the alert
        });

        // Display error messages in an alert
        alert(errorMessage);

            } else {
                // Generic error if there's no specific validation error
                alert('Form submission failed. Please try again.');
            }
        },
        complete: function() {
            // Hide the full-page spinner once the request is complete
            $('#loadingOverlay').hide();
        }
    });
});




    // Function to show/hide simple card based on variant selection
    document.getElementById('variant_type_id').addEventListener('change', function() {
    var selectedValue = this.value;
    var simpleCard = document.getElementById('simpleCard');
    var variableCard = document.getElementById('variableCard');
    var simpleFields = simpleCard.querySelectorAll('input, select');
    var variableFields = variableCard.querySelectorAll('input, select');
    var tab3Fields = document.querySelectorAll('#tab3-content input, #tab3-content select'); // Tab 3 fields

    if (selectedValue === 'simple') {
        simpleCard.style.display = 'block'; // Show the simple card
        variableCard.style.display = 'none'; // Hide the variable card

        // Set required for simple fields and remove from variable fields
        simpleFields.forEach(function(field) {
            field.setAttribute('required', 'required');
        });
        variableFields.forEach(function(field) {
            field.removeAttribute('required');
        });
        tab3Fields.forEach(function(field) {
            field.removeAttribute('required');
        });

       

    } else if (selectedValue === 'variable') {
        //  $('[id^="v_sku_group_"]').hide();
        variableCard.style.display = 'block'; // Show the variable card
        simpleCard.style.display = 'none'; // Hide the simple card

        // Set required for variable fields and remove from simple fields
        variableFields.forEach(function(field) {
            field.setAttribute('required', 'required');
        });
        simpleFields.forEach(function(field) {
            field.removeAttribute('required');
        });
        tab3Fields.forEach(function(field) {
            field.setAttribute('required', 'required');
        });

        // Enable tabs 2 and 3 for variable
        // document.querySelector('#tab2-tab').classList.remove('disabled');
        // document.querySelector('#tab3-tab').classList.remove('disabled');

    } else {
        // Hide both simple and variable cards
        simpleCard.style.display = 'none';
        variableCard.style.display = 'none';

        // Remove required attribute from both simple and variable fields
        simpleFields.forEach(function(field) {
            field.removeAttribute('required');
        });
        variableFields.forEach(function(field) {
            field.removeAttribute('required');
        });
        tab3Fields.forEach(function(field) {
            field.removeAttribute('required');
        });

        // Re-disable tabs 2 and 3
        document.querySelector('#tab2-tab').classList.add('disabled');
        document.querySelector('#tab3-tab').classList.add('disabled');
    }
});

    



    // Function to convert text to slug format
    function convertToSlug(text) {
        return text
            .toLowerCase() // Convert text to lowercase
            .replace(/[^\w ]+/g, '') // Remove all non-word characters (except spaces)
            .replace(/ +/g, '-'); // Replace spaces with hyphens
    }

    // Set the initial value of the input to the prefix
    document.getElementById('product_slug').value = '';
    document.getElementById('span1').innerText = '';

    // Add an event listener to handle user input after the prefix
    document.getElementById('product_name').addEventListener('input', function() {
        var productName = this.value; // Get the product name
        var slug = convertToSlug(productName); // Convert to slug
        document.getElementById('product_slug').value = slug; // Update slug field
        document.getElementById('span1').innerText = prefix + slug; // Update slug field
    });

    // Prevent editing the prefix part
    document.getElementById('product_slug').addEventListener('keydown', function(e) {
        var cursorPosition = this.selectionStart; // Get the cursor position

        // Prevent editing the prefix part (before 'products/')
        if (cursorPosition < prefix.length) {
            e.preventDefault(); // Stop the default action (editing)
        }
    });

    $(document).ready(function() {
        // On category change, fetch the subcategories via AJAX
        $('#category').on('change', function() {
            var categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: '/get-subcategories/' + categoryId,
                    type: 'GET',
                    success: function(response) {
                        var $subcategoryDropdown = $('#subcategory');
                        $subcategoryDropdown.empty(); // Clear existing options

                        // Append default option
                        $subcategoryDropdown.append('<option value="">Select a subcategory</option>');

                        // Append fetched subcategories
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
                $('#subcategory').empty().append('<option value="">Select a subcategory</option>'); // Reset subcategory dropdown
            }
        });
    });


    $(document).ready(function() {
        // Initially disable Tab 2 and Tab 3
        $('#tab2-tab, #tab3-tab').addClass('disabled');

        // When OK button in Tab 1 is clicked
        $('#tab1-ok').on('click', function() {
            // Get data from Tab 1
            $('#variant_type_hidden').val($('#variant_type_id').val());
            $('#variant_type_id').prop('disabled', true);
            let sku = $('#sku').val();
            let total_stock = $('#total_stock').val();
            let v_unit_id = $('#v_unit_id').val();
            let status = $('#status').val();

            if (v_unit_id) {
                // Enable Tab 2
                $('#tab2-tab').removeClass('disabled').attr('data-toggle', 'tab');
                // Optionally, switch to Tab 2 after enabling it
                $('#tab2-tab').tab('show');
            } else {
                alert("Some Fields are Missing");
            }
        });

        $('#tab2-ok').on('click', function () {

            $('#tab3-tab').removeClass('disabled').attr('data-toggle', 'tab');
                // Optionally, switch to Tab 2 after enabling it
                $('#tab3-tab').tab('show');
    let attributes = [];
    let attributeValues = [];
    let variantDetails = {};

    // Collect all attributes and values from Tab 2
    $('.attribute-row').each(function () {
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
        success: function (response) {
            // Map variant details (ID -> Name)
            response.variantDetails.forEach(function (detail) {
                variantDetails[detail.id] = detail.name; // Store ID-to-name mapping
            });

            // Call function to display data in Tab 3
            displayCombinationsInTab3(attributes, attributeValues, variantDetails);
        },
        error: function (xhr) {
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
    combinations.forEach(function (combination, rowIndex) {
        let rowId = `row-${rowIndex}`;
        let rowHtml = `<div id="${rowId}" class="row mt-3">`;
        let autoFilledWeight = ''; // Initialize empty weight

        combination.forEach(function (value, index) {
            let attribute = attributes[index]; // Get the attribute
            let name = variantDetails[value]; // Get the corresponding name from variantDetails
            let id = Object.keys(variantDetails).find(key => variantDetails[key] === name);
            console.log(id);
            console.log(attribute);
            
            // If the attribute ID is 8, automatically fill the weight field
            if (attribute == 8) {
                let weightMatch = name.match(/\d+/); // Extract numbers from the string
                if (weightMatch) {
                    autoFilledWeight = weightMatch[0]; // Set the weight to the extracted number
                }
            }
            
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
                <div class="col-md-4 sku-group">
                    <label>SKU</label>
                    <input type="text" class="form-control mb-2" name="v_skus[${rowIndex}]" placeholder="Enter SKU">
                </div> 
                <div class="col-md-4 stock-group">
                    <label>Stock</label>
                    <input type="text" class="form-control mb-2" name="v_stock[${rowIndex}]" placeholder="Enter Stock">
                </div>
                <div class="col-md-4">
                    <label>Weight (gm)</label>
                    <input type="text" class="form-control mb-2" name="v_weights[${rowIndex}]" value="${autoFilledWeight}" placeholder="Enter Weight" required>
                </div>
                <div class="col-md-4">
                    <label>Price</label>
                    <input type="text" class="form-control mb-2" name="v_prices[${rowIndex}]" placeholder="Enter price" required>
                </div>
                <div class="col-md-4">
                    <label>Discount Price</label>
                    <input type="text" class="form-control mb-2" name="v_discount_price[${rowIndex}]" value="0" placeholder="Enter price" required>
                </div> 
                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="discount_price">Tax</label>
                                        <select name="v_tax[${rowIndex}]" id="" class="form-control">
                                            <option value=""></option>
                                            @foreach($taxes as $tax)
                                            <option value="{{$tax->id}}">{{$tax->tax_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="discount_price">Tax Type</label>
                                        <select name="v_tax_type[${rowIndex}]" id="" class="form-control">
                                            <option value=""></option>
                                            <option value="inclusive">Inclusive</option>
                                           

                                        </select>
                                    </div>
                                </div>
                <div class="col-md-4">
                    <label>Status</label>
                    <select name="v_status[${rowIndex}]" id="v_status" class="form-control" required>
                        <option value=""></option>
                        <option value="in_stock">In Stock</option>
                        <option value="out_stock">Out of Stock</option>
                    </select>
                </div> 
                <div class="col-md-4">
                    <label for="v_image">Image</label>
                    <input type="file" name="v_image[${rowIndex}]" class="form-control" required>   
                </div>
            </div>
        `;
        
        tab3Content.append(rowHtml); // Append the generated row to Tab 3
        if ($('#variant_type_id').val() === 'variable') {
    tab3Content.find('.sku-group').last().hide();
    tab3Content.find('.stock-group').last().hide();
}
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
    let variant = variantDetails.find(v => v.id == id);  // Find the variant by its ID
    return variant ? { id: variant.id, name: variant.name } : { id: '', name: '' };  // Return the id and name if found, otherwise return empty strings
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

            function removeId8FromDropdowns() {
        $('#attributes-container').find('.attributes-dropdown').each(function() {
            if ($(this).val() != 8) {
                $(this).find('option[value="8"]').remove();
            }
        });
    }

    // Call the function to remove 'id = 8' from the existing dropdowns before adding a new row
    removeId8FromDropdowns();

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

                if (selectedAttributeId == 8) {
                    $('#add-row').prop('disabled', true);
                } else {
                    $('#add-row').prop('disabled', false);
                }
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
                if (selectedAttributeId != 8) {
                    removeId8FromDropdowns(); // Remove 'id = 8' from subsequent dropdowns again
                }
            });
        });


        // Remove row functionality
        $(document).on('click', '.remove-row', function() {
            $(this).closest('.attribute-row').remove();
        });



    });

    document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.getElementById('add-row');
        const nextButton = document.getElementById('tab2-ok');
        const attributeDropdowns = document.querySelectorAll('.attributes-dropdown');
        let isAttribute8Selected = false;

        // Event listener for attribute selection change
        attributeDropdowns.forEach(function(dropdown) {
            dropdown.addEventListener('change', function() {
                const selectedValue = this.value;

                if (selectedValue == 8) {
                    addButton.disabled = true;  // Disable the add button
                } else {
                    addButton.disabled = false;
                    isAttribute8Selected = true;
                      // Enable the add button
                }
                if(selectedValue){
                    nextButton.disabled = false;
                }
                else{
                    nextButton.disabled = true;
                }
                
            });
        });
    });

$(document).on('change', '#variant_type_id', function () {
    if ($(this).val() === 'variable') {
        $('.sku-group').hide();
    } else {
        $('.sku-group').show();
    }
});
</script>
@stop