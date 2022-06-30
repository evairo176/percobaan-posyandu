@extends('layouts.backend')

@section('content')
{{auth()->user()->role}}
@endsection