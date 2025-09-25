@extends('adminlte::page')
@section('content_header')
    <h1>Add Weight</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add New Weight</h3>
        </div>
        <div class="card-body">
            <form action="/weights" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Weight Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create Weight</button>
            </form>
        </div>
    </div>
@stop
