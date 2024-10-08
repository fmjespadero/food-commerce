@extends('dashboard.layout')

@section('subtitle', 'Welcome')
@section('content_header_title', 'Products')

@section('content_body')
    @php
        $columns = [
            ['title' => 'Image', 'data' => 'image', 'action', 'orderable' => false, 'searchable' => false],
            ['title' => 'Name', 'data' => 'name'],
            ['title' => 'Description', 'data' => 'description'],
            ['title' => 'Category', 'data' => 'category'],
            ['title' => 'Qty', 'data' => 'stock_quantity'],
            ['title' => 'Price', 'data' => 'price'],
            ['title' => 'Actions', 'data' => 'action', 'orderable' => false, 'searchable' => false],
        ];
    @endphp

    <x-data-table id="ProductTable" :ajaxRoute="route('products.index')" :columns="$columns" :columnWidths="['0%', '15%', '0', '10%' ,'10%','10%','10%']"/>
    @include('components.delete-confirmation', ['id' => 'ProductTable'])
@stop

@push('css')
@endpush
