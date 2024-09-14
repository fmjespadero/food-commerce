@extends('dashboard.layout')

{{-- Customize layout sections --}}
@section('subtitle', 'Welcome')
@section('content_header_title', 'Products')

@php
    $heads = [
            ['label' => 'Qty', 'width' => 5],
            ['label' => 'Name', 'width' => 20],
            ['label' => 'Price', 'width' => 5],
            ['label' => 'Description', 'width' => 30],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];
    $btnEdit = '<button class="mx-1 shadow btn btn-xs btn-default text-primary" title="Edit">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </button>';
    $btnDelete = '<button class="mx-1 shadow btn btn-xs btn-default text-danger" title="Delete">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                </button>';
    $btnDetails = '<button class="mx-1 shadow btn btn-xs btn-default text-teal" title="Details">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </button>';
    $config = [
        'responsive' => true,
        'order' => [],
        'columns' => [null, null, null, null, ['orderable' => false]],
    ];
@endphp
{{-- Content body: main page content --}}
@section('content_body')
<x-adminlte-datatable id="ProductTable" :heads="$heads" head-theme="dark" theme="light" :config="$config"
    striped hoverable with-buttons>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->stock_quantity }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->description }}</td>
            <td>
                <nobr>
                    {!! $btnEdit !!}
                    {!! $btnDetails !!}
                    {!! $btnDelete !!}
                </nobr>
            </td>
        </tr>
    @endforeach
</x-adminlte-datatable>

@stop

{{-- Push extra CSS --}}
@push('css')
    {{-- Add here extra stylesheets --}}
@endpush

{{-- Push extra scripts --}}
@push('js')

@endpush