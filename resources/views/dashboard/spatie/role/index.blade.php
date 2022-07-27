{{-- Extends layout --}}

@extends('layout.default')

@section('title', 'الصلاحيات')



{{-- Content --}}

@section('content')



    <div class="card card-custom">

        <div class="card-header flex-wrap border-0 pt-6 pb-0">

            <div class="card-title">

                <h3 class="card-label">{{ __('Index Role') }}

                </h3>

            </div>

            <div class="card-toolbar">

                <a href="{{ route('roles.create') }}" class="btn btn-primary font-weight-bolder">

                    <span class="svg-icon svg-icon-md">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            version="1.1">

                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                <rect x="0" y="0" width="24" height="24" />

                                <circle fill="#000000" cx="9" cy="15" r="6" />

                                <path
                                    d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                    fill="#000000" opacity="0.3" />

                            </g>

                        </svg>

                    </span>{{ __('Create Role') }}</a>

            </div>

        </div>



        <div class="card-body">

            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable_2">

                <thead>

                    <tr>



                        <th>{{ __('Name') }}</th>


                        <th>{{ __('Permissions') }}</th>

                        <th>{{ __('settings') }}</th>

                    </tr>

                </thead>



                <tbody>



                    @foreach ($roles as $role)
                        <tr>





                            <td>{{ $role->name }}</td>


                            <td><a href="{{ route('role.permissions.index', $role->id) }}"
                                    class="btn btn-primary mr-2">{{ __('Permissions') }}
                                    ({{ $role->permissions_count }})
                                </a></td>

                            <td>

                                <div class="btn-group">

                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="#" onclick="performDestroy({{ $role->id }}, this)"
                                        class="btn btn-danger mr-2">
                                        <i class="fas fa-trash"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

            {!! $roles->links() !!}

        </div>

    </div>

@endsection



{{-- Styles Section --}}

@section('styles')

    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

@endsection



{{-- Scripts Section --}}

@section('scripts')

    {{-- vendors --}}


    {{-- page scripts --}}

    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

    <script src="{{ asset('crudjs/crud.js') }}"></script>

    <script>
        function performDestroy(id, reference) {

            let url = '/dashboard/admin/roles/' + id;

            confirmDestroy(url, reference);

        }
    </script>

@endsection
