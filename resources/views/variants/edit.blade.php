@extends('adminlte::page')

@section('content_header')
<h1>Edit Variant</h1>
@stop

@section('content')
<div class="row" id="test">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="m-0 text-dark col-md-6 float-left">Edit Variant</h4>
                    </div>
                </div>
                <br>

                <!-- Edit Form -->
                <form action="/variants/{{$variant->id}}" method="POST" role="form" class="col-md-12 " autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <!-- Variant Type -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Variant Type</label>
                                <input type="text" name="type" class="form-control" value="{{ old('type', $variant->type) }}" required="required">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" {{ old('status', $variant->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $variant->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Variant Items (Dynamic Fields) -->
                    <div class="row">
                        <button type="button" onclick="addRow()" class="btn btn-primary mb-2 ml-auto">Add Item</button>
                        <br>
                        <table class="table table-hover" id="dynamicTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($variant->items as $key => $item)
                                <tr>
                                    <td>
                                        <input type="text" name="variants[{{ $key }}][name]" value="{{ old('variants.' . $key . '.name', $item->name) }}" class="form-control" required>
                                    </td>
                                    <td>
                                        <input type="color" name="variants[{{ $key }}][color]" value="{{ old('variants.' . $key . '.color', $item->color) }}" class="form-control" required>
                                    </td>
                                    <td>
                                    @if($item->image)
                                        <img src="{{ asset($item->image) }}" width="50" height="50" alt="{{ $item->name }}">
                                        @endif
                                        <input type="file" name="variants[{{ $key }}][image]" class="form-control">
                                        <input type="hidden" name="variants[{{ $key }}][existing_image]" value="{{ $item->image }}">
                                    </td>
                                    <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary col-md-2 offset-md-5 btn-sm">Update</button>
                    <a class="btn btn-danger col-md-2 btn-sm" href='/variants'>Cancel </a>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function addRow() {
        let table = document.getElementById('dynamicTable').getElementsByTagName('tbody')[0];
        let rowCount = table.rows.length;
        let row = table.insertRow(rowCount);

        // Insert new cells with input fields
        row.innerHTML = `
            <td><input type="text" name="variants[${rowCount}][name]" class="form-control" required></td>
            <td><input type="color" name="variants[${rowCount}][color]" class="form-control" required></td>
            <td><input type="file" name="variants[${rowCount}][existing_image]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
        `;

        // Add remove functionality
        document.querySelectorAll('.remove-row').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('tr').remove();
            });
        });
    }

    // Add remove functionality to existing rows
    document.querySelectorAll('.remove-row').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('tr').remove();
        });
    });
</script>
@stop