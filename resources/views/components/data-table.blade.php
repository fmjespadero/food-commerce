@props(['id', 'ajaxRoute', 'columns', 'columnWidths' => [], 'customButtons' => []])

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="{{ $id }}" class="table table-light table-striped table-hover w-100">
                <thead class="thead-dark">
                    <tr>
                        @foreach ($columns as $column)
                            <th>{{ $column['title'] }}</th>
                        @endforeach
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#{{ $id }}')) {
            $('#{{ $id }}').DataTable().destroy();
        }

        $('#{{ $id }}').DataTable({
            dom: '<"row" <"col-sm-6" B> <"col-sm-6 d-flex justify-content-end" f> >' +
                '<"row" <"col-12 overflow-auto" tr> >' +
                '<"d-flex justify-content-between align-items-center flex-wrap gap-1 py-1" <"d-flex gap-5 align-items-center" <l> <i> > <p> >',
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
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ $ajaxRoute }}',
            columns: @json($columns),
            columnDefs: @json($columnWidths).map((width, index) => ({
                targets: index,
                width: width // Ensure this is in pixels, e.g., '100px'
            })),
            createdRow: function(row, data, dataIndex) {
                $(row).find('td:last').css({
                    'place-content': 'center'
                });
            },
            order: [],
        });
    });
</script>
@endpush
