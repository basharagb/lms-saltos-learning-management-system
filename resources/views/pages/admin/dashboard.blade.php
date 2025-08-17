@extends('layouts.master')
@section('page_title', 'لوحة التحكم الخاصة بي')

@section('content')
    <h2>WELCOME {{ Auth::user()->name }}. This is your DASHBOARD</h2>
    @endsection