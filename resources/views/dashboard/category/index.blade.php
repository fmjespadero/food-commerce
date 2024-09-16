@extends('dashboard.layout')

@section('subtitle', 'Welcome')
@section('content_header_title', 'Categories')

@section('content_body')
    @php
        $columns = [
            ['title' => 'Name', 'data' => 'name'],
            ['title' => 'Slug', 'data' => 'slug'],
            ['title' => 'Description', 'data' => 'description'],
            ['title' => 'Actions', 'data' => 'action', 'orderable' => false, 'searchable' => false],
        ];
    @endphp

    <x-data-table id="CategoryTable" :ajaxRoute="route('categories.index')" :columns="$columns" :columnWidths="['15%', '15%', '0', '10%' ]"/>
    @include('components.delete-confirmation', ['id' => 'CategoryTable'])
@stop

@push('css')
    
@endpush