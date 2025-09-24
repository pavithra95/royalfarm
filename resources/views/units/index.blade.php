@extends('adminlte::page')

@section('content_header')
    <h1>Unit</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Unit List</h3>
            <a href="/units/create" class="btn btn-primary float-right">Add</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Unit Name</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                    @foreach($items as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="/units/{{ $item->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                        <form action="/units/{{ $item->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                    @endforeach
                </tbody>

            </table>


        </div>
    </div>
@stop
