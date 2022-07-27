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
                <h3 class="card-label"> {{ __('categories') }}
                    <span class="d-block text-muted pt-2 font-size-sm"> </span>
                </h3>
            </div>
            {{-- @can('create-category') --}}
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <a data-target="#create_catgeory" class="btn btn-primary font-weight-bolder" data-toggle="modal">
                    <i class="la la-plus"></i>
                    {{ __('create') }}
                </a>
                <!--end::Button-->
            </div>

            {{-- @endcan --}}
        </div>

        <div class="card-body">
            <div class="modal fade" id="create_catgeory" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('category name') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="name" class="form-control form-control-solid"
                                placeholder="{{ __('Name') }}" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">Close</button>
                            <button type="button" onclick="performStore()"
                                class="btn btn-primary mr-2">{{ __('Submit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--begin: Datatable-->
            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable_2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>

                        <th> {{ __('Settings') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>

                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>


                            <td>

                                <a data-target="#edit_catgeory_{{ $category->id }}" data-toggle="modal"
                                    class="btn btn-sm btn-light btn-text-primary btn-icon mr-2" title="Edit details"> <span
                                        class="svg-icon svg-icon-md"> <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                </path>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20"
                                                    width="15" height="2" rx="1"></rect>
                                            </g>
                                        </svg> </span> </a>

                                <div class="modal fade" id="edit_catgeory_{{ $category->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ __('category name') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" id="name_edit" class="form-control form-control-solid"
                                                    placeholder="{{ __('Name') }}" value="{{ $category->name }}" />
                                                <input type="text" id="type"
                                                    class="form-control form-control-solid" hidden
                                                    value="beneficiaries" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-primary font-weight-bold"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" onclick="performUpdate({{ $category->id }})"
                                                    class="btn btn-primary mr-2">{{ __('Submit') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                    @endforeach
                </tbody>
            </table>
            <span class="span">
                {!! $categories->links() !!}
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
        function performStore() {

            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            store('/dashboard/admin/categories', formData)
            location.reload();


        }

        function performUpdate(id) {


            let data = {
                name: document.getElementById("name_edit").value,
            };
            update('/dashboard/admin/categories/' + id, data);
            location.reload();


        }
    </script>
@endsection
