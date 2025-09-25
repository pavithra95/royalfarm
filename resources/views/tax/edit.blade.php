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

                        <h4 class="m-0 text-dark col-md-6 float-left">Create Tax</h4>

                    </div>
                </div>
                <br>


                <form action="/taxes/{{$item->id}}" method="POST" role="form" class="col-md-12 " autocomplete="off">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}

                    <div class="row">

                        <div class="col-md-6">



                            <div class="form-group">
                                <label for="">Tax Name</label>
                                <input type="text" name="name" class="form-control" value="{{$item->tax_name}}" required="required">


                            </div>
                        </div>
                        <div class="col-md-6">



                            <div class="form-group">
                                <label for="">Tax Rate (%)</label>
                                <input type="number" name="tax_rate" class="form-control" value="{{$item->tax_rate}}" required="required">


                            </div>
                        </div>


                    </div>

                    <button type="submit" class="btn btn-primary col-md-2 offset-md-5 btn-sm">Update</button>
                    <a class="btn btn-danger col-md-2 btn-sm" href='/taxes'>Cancel </a>
                </form>



            </div>
        </div>
    </div>
</div>

@stop