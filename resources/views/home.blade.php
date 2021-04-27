@extends('layouts.app')

@section('content')
    <div class="content">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
    </div>
@endsection
