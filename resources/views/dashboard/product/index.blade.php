@extends('dashboard.layout')

{{-- Customize layout sections --}}
@section('subtitle', 'Welcome')
@section('content_header_title', 'Products')

{{-- Content body: main page content --}}
@section('content_body')
<table id="ProductTable" class="table table-light table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>
@stop

{{-- Push extra CSS --}}
@push('css')
    {{-- Add here extra stylesheets --}}
    <style>
        #ProductTable_length label{
            margin: 0;
        }
        #ProductTable_info{
            padding: 0;
        }
        .dt-button-collection .dt-button {
            min-width: unset !important;
        }
        @media screen and (max-width: 767px){
            .dt-buttons {
                text-align: start !important;
            }
        }
    </style>
@endpush

{{-- Push extra scripts --}}
@push('js')
<script>
    $(document).ready(function(){
        if ($.fn.DataTable.isDataTable('#ProductTable')) {
            $('#ProductTable').DataTable().destroy();
        }

        $('#ProductTable').DataTable({
            dom: '<"row" <"col-sm-6" B> <"col-sm-6 d-flex justify-content-end" f> >' +
                '<"row" <"col-12 overflow-auto" tr> >' +
                '<"d-flex justify-content-between align-items-center" <"d-flex gap-5 align-items-center" <l> <i> > <p> >',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="text-white fas fa-fw fa-lg fa-file-excel"></i> Export to Excel',
                    className: 'btn bg-success'
                },
                {
                    extend: 'pdf',
                    text: '<i class="text-white fas fa-fw fa-lg fa-file-pdf"></i> Export to PDF',
                    className: 'btn bg-danger'
                },
                {
                    text: '<i class="text-white fas fa-fw fa-lg fa-plus"></i> Create',
                    className: 'btn bg-primary',
                    action: function ( e, dt, node, config ) {
                        window.location.href += "/create";
                    }
                }
            ],
            processing: true,
            serverSide: true,
            ajax: '{{ route('products.index') }}', // You need to create this endpoint
            columns: [
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'category', name: 'category' },
                { data: 'stock_quantity', name: 'stock_quantity' },
                { data: 'price', name: 'price' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            createdRow: function(row, data, dataIndex) {
                // Add inline styles to the action column
                $(row).find('td:eq(5)').css({
                    'display': 'flex',
                    'gap': '2px',  // Adjust the gap value as needed
                    'justify-content': 'center',  // Center items horizontally
                    'align-items': 'center'  // Center items vertically
                });
            },
            order: [],
        });

        $(document).on('click', '#dt-action-delete', function () {
            var url = $(this).data('url');
            var token = $('meta[name="csrf-token"]').attr('content');
            
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: token,
                            _method: 'DELETE'
                        },
                        success: function (response) {
                            // Reload DataTable to reflect the changes
                            $('#ProductTable').DataTable().ajax.reload();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        },
                        error: function (xhr) {
                            let errorMessage = 'An error occurred while trying to delete the item.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire(
                                'Error!',
                                errorMessage,
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
@endpush