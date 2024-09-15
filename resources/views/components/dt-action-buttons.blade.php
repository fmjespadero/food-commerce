<a href="{{ route($routePrefix . '.edit', $model->id) }}" class="mx-1 shadow btn btn-xs btn-default text-primary">
    <i class="fa fa-lg fa-fw fa-pen"></i>
</a>
<button id="dt-action-delete" type="button" class="mx-1 shadow btn btn-xs btn-default text-danger"
    data-url="{{ route($routePrefix . '.destroy', $model->id) }}">
    <i class="fa fa-lg fa-fw fa-trash"></i>
</button>
