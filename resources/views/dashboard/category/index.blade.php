@extends('dashboard.layout')

{{-- Customize layout sections --}}
@section('subtitle', 'Welcome')
@section('content_header_title', 'Categories')

@php
    $heads = [
            ['label' => 'Name', 'width' => 20],
            ['label' => 'Slug', 'width' => 20],
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
        'columns' => [null, null, null, ['orderable' => false]],
    ];
@endphp
{{-- Content body: main page content --}}
@section('content_body')
<x-adminlte-datatable id="CategoryTable" :heads="$heads" head-theme="dark" theme="light" :config="$config"
    striped hoverable with-buttons>
    @foreach ($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>
            <td>{{ $category->description }}</td>
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