@extends('adminlte::page')

@section('content_header')

@stop

@section('content')
<div class="row" id="test">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="m-0 text-dark col-md-6 float-left">Create Variant</h4>
                    </div>
                </div>
                <br>

                <form action="/variants" method="POST" role="form" class="col-md-12 " autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Variant Type</label>
                                <input type="text" name="type" class="form-control" value="" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <button type="button" onclick="addRow()" class="btn btn-primary mb-2 ml-auto">Add</button>
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
                                <!-- Dynamic rows will be added here -->
                            </tbody>
                        </table>
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
<script>
    let rowCount = 0;
    function addRow() {
        rowCount++;
        let table = document.getElementById('dynamicTable').getElementsByTagName('tbody')[0];
        let newRow = table.insertRow();

        // Add Name input
        let cell1 = newRow.insertCell(0);
        let nameInput = document.createElement('input');
        nameInput.setAttribute('type', 'text');
        nameInput.setAttribute('name', 'variants[' + rowCount + '][name]');
        nameInput.setAttribute('class', 'form-control');
        cell1.appendChild(nameInput);

        // Add Color picker input
        let cell2 = newRow.insertCell(1);
        let colorInput = document.createElement('input');
        colorInput.setAttribute('type', 'color');
        colorInput.setAttribute('name', 'variants[' + rowCount + '][color]');
        colorInput.setAttribute('class', 'form-control');
        cell2.appendChild(colorInput);

        // Add Image input
        let cell3 = newRow.insertCell(2);
        let imageInput = document.createElement('input');
        imageInput.setAttribute('type', 'file');
        imageInput.setAttribute('name', 'variants[' + rowCount + '][image]');
        imageInput.setAttribute('class', 'form-control');
        cell3.appendChild(imageInput);

        // Add Delete button
        let cell4 = newRow.insertCell(3);
        let deleteButton = document.createElement('button');
        deleteButton.setAttribute('type', 'button');
        deleteButton.setAttribute('class', 'btn btn-danger btn-sm');
        deleteButton.innerHTML = 'Delete';
        deleteButton.onclick = function() {
            table.deleteRow(newRow.rowIndex - 1); // Delete the row
        };
        cell4.appendChild(deleteButton);
    }
</script>
@stop
