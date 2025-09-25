@extends('adminlte::page')



@section('content_header')
    <h1>Variants</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Variants List</h3>
            <a href="/variants/create" class="btn btn-primary float-right">Add</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $key=>$item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->type}}</td>
                    <td>{{$item->status}}</td>
                    <td>
                        <a href="/variants/{{$item->id}}/edit" class="btn btn-success btn-sm">Edit</a>
                        <a href="/variants/{{$item->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>


                @endforeach

                </tbody>

            </table>


           
        </div>
    </div>
@stop
