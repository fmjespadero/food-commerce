@extends('layouts.app')

@section('content_body')
    <div class="container">
        <div class="parent">
            <div style="height: 350px; background-color: blue;" class="div1">1</div>
            <div style="height: 250px; background-color: red;" class="div2">2</div>
            <div style="height: 250px; background-color: green;" class="div3">3</div>
            <div style="height: 250px; background-color: orange;" class="div4">4</div>
            <div style="height: 250px; background-color: purple;" class="div5">5</div>
            <div style="height: 250px; background-color: black;" class="div6">6</div>
        </div>
    </div>
@stop

@push('css')
    <style>
        .parent {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 8px;
        }
            
        .div1 {
            grid-column: span 12 / span 12;
            grid-row: span 2 / span 2;
        }

        .div2 {
            grid-column: span 8 / span 8;
            grid-row-start: 3;
        }

        .div3 {
            grid-column: span 4 / span 4;
            grid-column-start: 9;
            grid-row-start: 3;
        }

        .div4 {
            grid-column: span 4 / span 4;
            grid-row-start: 4;
        }

        .div5 {
            grid-column: span 4 / span 4;
            grid-column-start: 5;
            grid-row-start: 4;
        }

        .div6 {
            grid-column: span 4 / span 4;
            grid-column-start: 9;
            grid-row-start: 4;
        }
    </style>
@endpush


