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
                                <input type="file" name="featured_image" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gallery_image">Product Gallery Image</label>
                                <input type="file" name="gallery_image" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select id="category" name="category_id" class="form-control" required>
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
                                <select name="variant_type" id="category_id" class="form-control">
                                    <option value=""></option>
                                    <option value="packet">Simple Product</option>
                                    <option value="loose">Variable Product</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('Description') }} <i class="text-danger">*</i></label>
                                <textarea id="description" name="description" placeholder="{{ __('Enter product description') }}"></textarea>
                            </div>
                        </div>

                        <!-- Preview of description -->
                        <div class="col-md-12">
                            <h4>{{ __('Preview') }}</h4>
                            <div id="descriptionPreview" class="border p-3"></div>
                        </div>
                    </div>

                    <!-- Card for Packet Variant -->
                    <div id="packetCard" class="card" style="display: none;">
                        <div class="card-header">
                            <h3>Simple Product Details</h3>
                        </div>
                        <div class="card-body">
                            <div id="variantRowTemplate" class="row">
                                <!-- Variant Row Template -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="measurement">SKU</label>
                                        <input type="text" name="sku" class="form-control" placeholder="Enter measurement">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" class="form-control" placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="discount_price">Discount Price</label>
                                        <input type="number" name="discount_price" class="form-control" placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="variant_image">Variant Image</label>
                                        <input type="file" name="variant_image" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" name="stock" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="unit_id">Unit</label>
                                        <select name="unit_id" class="form-control">
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
                                        <select name="status" class="form-control">
                                            <option value=""></option>
                                            <option value="available">Available</option>
                                            <option value="soldout">Sold Out</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Button to add new variants -->
                            <a href="javascript:void(0)" id="addVariantBtn" class="btn btn-primary float-right">Add Variant</a>
                        </div>
                    </div>

                    <!-- Loose -->
                    <div id="looseCard" class="card" style="display: none;">
                        <div class="row" id="test">
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
                                                    <div class="form-group">
                                                        <label for="name">SKU</label>
                                                        <input type="text" class="form-control" id="sku" name="sku" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Total Stock</label>
                                                        <input type="number" class="form-control" id="total_stock" name="total_stock" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Status</label>
                                                        <select name="status" id="status" class="form-control">
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
                                                                    <select name="attributes[]" id="attributes[]" class="form-control attributes-dropdown">
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
                                                                    <select class="form-control attribute-value-dropdown" id="attribute_value[]" name="attribute_value[]" multiple>
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
                                                <div id="tab3-content">
                                                    <!-- Attributes and values will be dynamically inserted here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary col-md-2 offset-md-5 btn-sm">Create</button>
                        <a class="btn btn-danger col-md-2 btn-sm" href='/units'>Cancel</a>
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
    var appUrl = '{{ config('
    app.url ') }}'; // Example value, replace with actual app URL
    var prefix = appUrl + '/products/';



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

    $('#variantForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Collect the form data, including file data (FormData object)
        var formData = new FormData(this);

        // Collect dynamic data from Tab 2 (if any) and append it to FormData
        $('.attribute-row').each(function() {
            var attribute = $(this).find('.attributes-dropdown').val();
            var attributeValue = $(this).find('.attribute-value-dropdown').val();

            if (attribute && attributeValue) {
                formData.append('attributes[]', attribute);
                formData.append('attribute_values[]', attributeValue);
            }
        });

        // Optional: Log the form data to inspect it
        var formDataObj = {};
        formData.forEach(function(value, key) {
            formDataObj[key] = value;
        });
        console.log(formDataObj);

        // Send the data using AJAX
        $.ajax({
            url: $(this).attr('action'), // URL for form submission (Laravel route)
            type: 'POST',
            data: formData,
            processData: false, // Don't process the data
            contentType: false, // Don't set content type (multipart/form-data)
            success: function(response) {
                console.log('Form submitted successfully:', response);
                // Optionally handle success (e.g., redirect or show success message)
            },
            error: function(xhr, status, error) {
                console.error('Form submission failed:', error);
                // Handle error (e.g., show an error message)
            }
        });
    });




    // Function to show/hide packet card based on variant selection
    document.getElementById('category_id').addEventListener('change', function() {
        var selectedValue = this.value;
        var packetCard = document.getElementById('packetCard');
        var looseCard = document.getElementById('looseCard');

        if (selectedValue === 'packet') {
            packetCard.style.display = 'block'; // Show the packet card
            looseCard.style.display = 'none';
        } else if (selectedValue === 'loose') {
            looseCard.style.display = 'block'; // Show the loose card
            packetCard.style.display = 'none';
        } else {
            packetCard.style.display = 'none'; // Hide both
            looseCard.style.display = 'none';
        }
    });

    // Adding new variant rows dynamically for packet
    document.getElementById('addVariantBtn').addEventListener('click', function() {
        var variantRowTemplate = document.getElementById('variantRowTemplate');
        var newRow = variantRowTemplate.cloneNode(true); // Clone the row
        newRow.removeAttribute('id');
        newRow.style.margin = '10px 15px'; // Remove the ID from the cloned row
        document.getElementById('packetCard').appendChild(newRow); // Append the cloned row
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

        $('#tab2-ok').on('click', function () {

            $('#tab3-tab').removeClass('disabled').attr('data-toggle', 'tab');
                // Optionally, switch to Tab 2 after enabling it
                // $('#tab3-tab').tab('show');
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
        let rowHtml = '<div class="row mt-3">';

        combination.forEach(function (value, index) {
            let attribute = attributes[index]; // Get the attribute
            let name = variantDetails[value]; // Get the corresponding name from variantDetails

            // Create HTML for each attribute-value pair
            rowHtml += `
                <div class="col-md-4">
                  
                    <input type="text" class="form-control mb-2" name="attribute_values[]" value="${name}" readonly>
                </div>
            `;
        });

        rowHtml += '</div>'; // Close row div
        tab3Content.append(rowHtml); // Append the generated row to Tab 3
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





// Helper function to create input fields for each attribute value
function generateValueInputs(values) {
    return values.map(value => `
        <input type="text" class="form-control mb-2" name="attribute_values[]" value="${value}" readonly>
    `).join('');  // Join the input fields with an empty string
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