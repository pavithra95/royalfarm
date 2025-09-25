@extends('adminlte::page')

@section('content_header')
    <h1>Create Unit</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add New Unit</h3>
        </div>
        <div class="card-body">
            <form action="/units" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Unit Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create Unit</button>
            </form>
        </div>
    </div>
@stop
