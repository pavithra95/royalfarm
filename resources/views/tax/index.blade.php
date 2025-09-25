@extends('adminlte::page')



@section('content_header')
    <h1>Taxes</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Taxes List</h3>
            <a href="/taxes/create" class="btn btn-primary float-right">Add</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Tax</th>
                    <th>Sub Tax</th>
                   
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $key=>$item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->tax_name}}</td>
                    <td>{{$item->tax_rate}} %</td>
                    <td>CGST {{$item->tax_rate/2}} %  SGST {{$item->tax_rate/2}} %</td>
                    
                    <td>
                        <a href="/taxes/{{$item->id}}/edit" class="btn btn-success btn-sm">Edit</a>
                        <!-- <a href="/taxes/{{$item->id}}/delete" class="btn btn-danger btn-sm">Delete</a> -->
                        <button onclick="confirmDelete({{ $item->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>


                @endforeach

                </tbody>

            </table>


           
        </div>
    </div>
@stop

@section('js')
<script>
    function confirmDelete(unitId) {
        // Show a confirmation dialog
        if (confirm('Are you sure you want to delete this unit?')) {
            // Perform an AJAX request to delete the unit
            $.ajax({
                url: '/taxes/' + unitId + '/delete',
                method: 'GET', // or 'DELETE' if you set up a DELETE route
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        // Reload the page or remove the deleted row from the table
                        location.reload();
                    } else {
                        // If the unit is linked to products, show the message
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('An error occurred while trying to delete the unit.');
                }
            });
        }
    }
</script>
@stop


