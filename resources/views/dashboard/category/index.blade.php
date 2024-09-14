@extends('dashboard.layout')

{{-- Customize layout sections --}}
@section('subtitle', 'Welcome')
@section('content_header_title', 'Categories')

{{-- Content body: main page content --}}
@section('content_body')
<table id="CategoryTable" class="table table-light table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>
@stop

{{-- Push extra CSS --}}
@push('css')
    {{-- Add here extra stylesheets --}}
    <style>
        #CategoryTable_length label{
            margin: 0;
        }
        #CategoryTable_info{
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
        if ($.fn.DataTable.isDataTable('#CategoryTable')) {
            $('#CategoryTable').DataTable().destroy();
        }

        $('#CategoryTable').DataTable({
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
            ajax: '{{ route('categories.index') }}', // You need to create this endpoint
            columns: [
                { data: 'name', name: 'name' },
                { data: 'slug', name: 'slug' },
                { data: 'description', name: 'description' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            createdRow: function(row, data, dataIndex) {
                // Add inline styles to the action column
                $(row).find('td:eq(3)').css({
                    'display': 'flex',
                    'gap': '2px',  // Adjust the gap value as needed
                    'justify-content': 'center',  // Center items horizontally
                    'align-items': 'center'  // Center items vertically
                });
            },
            order: [],
        });

        $(document).on('click', '#category-delete', function () {
            var url = $(this).data('url');
            console.log(url)
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
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Reload DataTable to reflect the changes
                            $('#CategoryTable').DataTable().ajax.reload();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        },
                        error: function (xhr) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while trying to delete the item.',
                                'error'
                                );
                        }
                    });
                }
            });
        });

    });
    //     $(document).on('click', '#deleteCategory', function () {
    //     console.log(id)
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: `categories/${id}`,  // Construct the URL using the id parameter
    //                 type: 'DELETE',
    //                 data: {
    //                     _token: $('meta[name="csrf-token"]').attr('content')
    //                 },
    //                 success: function(result) {
    //                     $('#CategoryTable').DataTable().ajax.reload();
    //                     Swal.fire(
    //                         'Deleted!',
    //                         'Category has been deleted.',
    //                         'success'
    //                     );
    //                 },
    //                 error: function(xhr) {
    //                     Swal.fire(
    //                         'Error!',
    //                         'There was an error deleting the category.',
    //                         'error'
    //                     );
    //                 }
    //             });
    //         }
    //     });
    // });

        
    // })
    
    // function editCategory(id) {
    //     window.location.href += `/${id}/edit`;
    // }

    
</script>
@endpush


{{-- // $(document).ready(function() {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     function editCategory(id) {
    //         window.location.href = `/categories/${id}/edit`;
    //     }

    //     function deleteCategory(id) {
    //         if (confirm('Are you sure you want to delete this category?')) {
    //             $.ajax({
    //                 url: `/categories/${id}`,
    //                 type: 'DELETE',
    //                 data: {
    //                     "_token": "{{ csrf_token() }}",
    //                 },
    //                 success: function(result) {
    //                     $('#CategoryTable').DataTable().ajax.reload();
    //                     toastr.success('Category deleted successfully');
    //                 },
    //                 error: function(xhr) {
    //                     toastr.error('Error deleting category');
    //                 }
    //             });
    //         }
    //     }

    //     if ($.fn.DataTable.isDataTable('#CategoryTable')) {
    //         $('#CategoryTable').DataTable().destroy();
    //     }
        
    //     $('#CategoryTable').DataTable({
    //         dom: '<"row" <"col-sm-6" B> <"col-sm-6 d-flex justify-content-end" f> >' +
    //             '<"row" <"col-12" tr> >' +
    //             '<"d-flex justify-content-between align-items-center" <"d-flex gap-5 align-items-center" <l> <i> > <p> >',
    //         buttons: [
    //             {
    //                 extend: 'excel',
    //                 text: '<i class="text-white fas fa-fw fa-lg fa-file-excel"></i> Export to Excel',
    //                 className: 'btn bg-success'
    //             },
    //             {
    //                 extend: 'pdf',
    //                 text: '<i class="text-white fas fa-fw fa-lg fa-file-pdf"></i> Export to PDF',
    //                 className: 'btn bg-danger'
    //             },
    //             {
    //                 text: '<i class="text-white fas fa-fw fa-lg fa-plus"></i> Create',
    //                 className: 'btn bg-primary',
    //                 action: function ( e, dt, node, config ) {
    //                     window.location.href += "/create";
    //                 }
    //             }
    //         ],
    //         processing: true,
    //         serverSide: true,
    //         ajax: '/categories/data', // You need to create this endpoint
    //         columns: [
    //             { data: 'name', name: 'name' },
    //             { data: 'slug', name: 'slug' },
    //             { data: 'description', name: 'description' },
    //             { 
    //                 data: 'id', 
    //                 name: 'actions', 
    //                 orderable: false, 
    //                 searchable: false,
    //                 render: function(data, type, row, meta) {
    //                     return `
    //                         <button onclick="editCategory(${data})" class="mx-1 shadow btn btn-xs btn-default text-primary" title="Edit">
    //                             <i class="fa fa-lg fa-fw fa-pen"></i>
    //                         </button>
    //                         <button onclick="deleteCategory(${data})" class="mx-1 shadow btn btn-xs btn-default text-danger" title="Delete">
    //                             <i class="fa fa-lg fa-fw fa-trash"></i>
    //                         </button>
    //                     `;
    //                 }
    //             }
    //         ],
    //     });
    // }); --}}