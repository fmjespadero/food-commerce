@props(['id', 'ajaxRoute', 'columns', 'customButtons' => []])

<table id="{{ $id }}" class="table table-light table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            @foreach ($columns as $column)
                <th>{{ $column['title'] }}</th>
            @endforeach
        </tr>
    </thead>
</table>

@push('js')
<script>
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#{{ $id }}')) {
            $('#{{ $id }}').DataTable().destroy();
        }

        $('#{{ $id }}').DataTable({
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
                ...@json($customButtons),
                {
                    text: '<i class="text-white fas fa-fw fa-lg fa-plus"></i> Create',
                    className: 'btn bg-primary',
                    action: function (e, dt, node, config) {
                        window.location.href += "/create";
                    }
                }
            ],
            processing: true,
            serverSide: true,
            ajax: '{{ $ajaxRoute }}',
            columns: @json($columns),
            createdRow: function(row, data, dataIndex) {
                $(row).find('td:last').css({
                    'display': 'flex',
                    'gap': '2px',
                    'justify-content': 'center',
                    'align-items': 'center'
                });
            },
            order: [],
        });
    });
</script>
@endpush
