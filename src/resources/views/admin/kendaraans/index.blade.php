@extends('layouts.admin')
@section('content')
@can('kendaraan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.kendaraans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.kendaraan.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.kendaraan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-kendaraan">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.kendaraan.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.kendaraan.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.kendaraan.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.kendaraan.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.kendaraan.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.kendaraan.fields.mesin') }}
                        </th>
                        <th>
                            {{ trans('cruds.kendaraan.fields.fitur') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kendaraans as $key => $kendaraan)
                        <tr data-entry-id="{{ $kendaraan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $kendaraan->id ?? '' }}
                            </td>
                            <td>
                                @if($kendaraan->image)
                                    <a href="{{ $kendaraan->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $kendaraan->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $kendaraan->name ?? '' }}
                            </td>
                            <td>
                                {{ $kendaraan->description ?? '' }}
                            </td>
                            <td>
                                {{ $kendaraan->price ?? '' }}
                            </td>
                            <td>
                                {{ $kendaraan->mesin ?? '' }}
                            </td>
                            <td>
                                {{ $kendaraan->fitur ?? '' }}
                            </td>
                            <td>
                                @can('kendaraan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.kendaraans.show', $kendaraan->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('kendaraan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.kendaraans.edit', $kendaraan->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('kendaraan_delete')
                                    <form action="{{ route('admin.kendaraans.destroy', $kendaraan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('kendaraan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.kendaraans.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-kendaraan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection