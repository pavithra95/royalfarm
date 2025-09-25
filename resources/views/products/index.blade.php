@extends('adminlte::page')



@section('content_header')
    <h1>Product</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Product List</h3>
              <!-- Search form -->
              <form action="{{ url('/get-products') }}" method="GET" class="form-inline float-right">
                <input type="text" name="search" class="form-control" placeholder="Search Product Name" value="{{ request()->input('search') }}">
                <button type="submit" class="btn btn-primary ml-2">Search</button>
                <a href="{{ url('/get-products') }}" class="btn btn-secondary ml-2">Reset</a>
            </form>
            <button type="button" class="btn btn-warning float-right mr-2" data-toggle="modal" data-target="#filterModal">
                Open Filter
            </button>

            <a href="/products/create" class="btn btn-primary float-right mr-2">Add</a>

        </div>
        <div class="card-body">
            <form action="{{ url('/products/update-position') }}" method="POST">
            @csrf
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Slug</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Product Type</th>
                    <th>stock</th>
                    <th>unit</th>
                    <th>Order</th>
                    <th>Action</th>
                   
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $key=>$item)
                <tr>
                <td>{{ ($items->currentPage() - 1) * $items->perPage() + ($key + 1) }}</td>
                    <td>{{$item->product_name}}</td>
                    <td>{{$item->slug}}</td>
                    <td>{{$item->category->name ?? 'not available'}}</td>
                    <td>{{$item->subCategory->name ?? 'not available'}}</td>
                    <td>{{$item->variant_type}}</td>
                    @if($item->variant_type == 'simple')
                    <td>{{$item->s_stock}}</td>
                    <td>{{$item->Sunit->name ?? 'not available'}}</td>
                    @else
                    <td>{{$item->v_stock}}</td>
                    <td>{{$item->unit->name ?? 'not available'}}</td>
                    @endif
                    <td>
                     <input type="hidden" name="product_id[]" value="{{ $item->id }}">
                <input type="number" name="position[]" value="{{ $item->position }}" class="form-control">
                    </td>
                    <td>
                        <a href="/products/{{$item->id}}/edit" class="btn btn-success btn-sm">Edit</a>
                        <!-- <a href="/products/{{$item->id}}/delete" class="btn btn-danger btn-sm">Delete</a> -->
                        <button onclick="confirmDelete({{ $item->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>


                @endforeach

                </tbody>

            </table>

             <!-- <div class="text-right">
        <button type="submit" class="btn btn-primary">Save Position</button>
    </div> -->
</form>



           
        </div>
    </div>
<!-- Modal for Filter -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Products</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Filter form in modal -->
                    <form action="{{ url('/get-products') }}" method="GET">
                        
                        <!-- Filter by Category -->
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" class="form-control">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request()->input('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter by Units -->
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <select name="unit" class="form-control">
                                <option value="">All Units</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" {{ request()->input('unit') == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                       

                        <!-- Filter by Variant Type -->
                        <div class="form-group">
                            <label for="variant_type">Variant Type</label>
                            <select name="variant_type" class="form-control">
                                <option value="">All Types</option>
                                <option value="simple" {{ request()->input('variant_type') == 'simple' ? 'selected' : '' }}>Simple</option>
                                <option value="variant" {{ request()->input('variant_type') == 'variant' ? 'selected' : '' }}>Variant</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Apply Filter</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

 
    <style>
    .pagination {
        display: flex;
        justify-content: center;
        padding: 10px 0;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination li a, .pagination li span {
        padding: 5px 10px;
        font-size: 14px;
    }

    .pagination li a svg, .pagination li span svg {
        width: 16px;
        height: 16px;
    }

    .pagination li.active span {
        background-color: #007bff;
        color: white;
    }
</style>

@stop
@section('js')
<script>
    function confirmDelete(unitId) {
        // Show a confirmation dialog
        if (confirm('Are you sure you want to delete this Produc?')) {
            // Perform an AJAX request to delete the unit
            $.ajax({
                url: '/products/' + unitId + '/delete',
                method: 'GET', // or 'DELETE' if you set up a DELETE route
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                         location.reload();
                    } else {
                        // If the unit is linked to products, show the message
                        // alert(response.message);
                        alert('An error occurred while trying to delete the Product.');
                    }
                },
                error: function(xhr) {
                    alert('An error occurred while trying to delete the Product.');
                }
            });
        }
    }
</script>
@stop



