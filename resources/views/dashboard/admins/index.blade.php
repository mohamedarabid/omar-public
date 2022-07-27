@extends('layout.default')

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('styles')
    <style>

    </style>
@endsection


@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label"> {{ __('admins') }}
                    <span class="d-block text-muted pt-2 font-size-sm"> </span>
                </h3>
            </div>
            {{-- @can('create-admins') --}}
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <a href="{{ route('admins.create') }}" class="btn btn-primary font-weight-bolder">
                    <i class="la la-plus"></i>
                    {{ __('create') }}
                </a>
                <!--end::Button-->
            </div>
            {{-- @endcan --}}
        </div>

        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable_2">
                <thead>

                    <tr>

                        <th>{{ __('First Name') }}</th>
                        <th>{{ __('Last Name') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Settings') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>

                            <td>{{ $admin->first_name }}</td>
                            <td>{{ $admin->last_name }}</td>
                            <td>
                                <span class="badge badge-primary">{{ $admin->getRoleNames() }}</span>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <img class="rounded-circle" src="{{ url('images/admin/' . $admin->image) }}"
                                    width="50" height="50">
                            </td>
                            <td>
                                @if ($admin->status == 'active')
                                    <span class="badge badge-primary">{{ __('Active') }}</span>
                                @elseif ($admin->status == 'deactive')
                                    <span class="badge badge-danger">{{ __('Deactive') }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    {{-- @can('edit-admin') --}}
                                    <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-primary mr-2"
                                        title="Edit Informations"> <i class="fas fa-edit"></i> </a>
                                    {{-- @endcan --}}

                                    <a href="{{ route('dashboard.auth.edit-password', $admin->id) }}"
                                        class="btn btn-success mr-2" title="Edit Password"> <i class="fas fa-edit"></i> </a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <span class="span">
                {!! $admins->links() !!}
            </span>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->


    <!-- Modal-->
@endsection

@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script>
        function performDestroy(id, reference) {

            let url = '/cms/admin/admins/' + id;

            confirmDestroy(url, reference);

        }
    </script>
@endsection
