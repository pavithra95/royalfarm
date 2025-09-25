@extends('adminlte::page')
@section('content_header')
    <h1>Edit Weight</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Weight</h3>
        </div>
        <div class="card-body">
            <form action="/weights/{{ $weight->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Weight Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $weight->name }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $weight->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $weight->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Weight</button>
            </form>
        </div>
    </div>
@stop
