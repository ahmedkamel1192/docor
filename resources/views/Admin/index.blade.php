@extends('layouts.admin_lte')

@section('content')
    {!! $dataTable->table() !!}


    @push('js')

        {!! $dataTable->scripts() !!}

    @endpush
@endsection
