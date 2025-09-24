@extends('adminlte::page')

@section('content_header')
    <h1>Edit Unit</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Unit</h3>
        </div>
        <div class="card-body">
            <form action="/units/{{ $unit->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Unit Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $unit->name }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $unit->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $unit->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Unit</button>
            </form>
        </div>
    </div>
@stop
