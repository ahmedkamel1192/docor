@extends('layouts.admin_lte')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                   
                    <div class="panel-heading">Category Edit</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="/categories/{{$category->id}}">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="no_of_room" class="col-md-4 control-label">Number Of Rooms</label>

                                <div class="col-md-6">
                                    <input id="no_of_room" type="text" class="form-control" name="name"
                                           value="{{ $category->name }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Edit
                                    </button>
                                </div>
                            </div>

                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection