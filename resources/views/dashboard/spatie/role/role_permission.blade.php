{{-- Extends layout --}}

@extends('layout.default')

@section('title','الصلاحيات والأذونات')



{{-- Styles Section --}}

@section('styles')

    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

@endsection





{{-- Content --}}

@section('content')



    <div class="card card-custom">

        <div class="card-header flex-wrap border-0 pt-6 pb-0">

            <div class="card-title">

                <h3 class="card-label">عرض الصلاحيات مع الأذونات

                </h3>

            </div>


            <div class="card-toolbar">

              <div class="dropdown dropdown-inline mr-2">
                <a type="button" href="{{route('permissions.create')}}" class="btn btn-primary font-weight-bolder"
                    aria-haspopup="true" aria-expanded="false"> <span class="svg-icon svg-icon-md">


                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
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
                        <!--end::Svg Icon-->
                    </span>انشئ أذن</button></a>
            </div>

            <div class="dropdown dropdown-inline mr-2">
                <a type="button" href="{{route('roles.create')}}" class="btn btn-primary font-weight-bolder"
                    aria-haspopup="true" aria-expanded="false"> <span class="svg-icon svg-icon-md">


                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
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
                        <!--end::Svg Icon-->
                    </span>انشئ صلاحية</button></a>
            </div>


            </div>



        </div>



        <div class="card-body">

            <table class="table table-bordered table-hover" id="kt_datatable">

                <thead>

                <tr>

                  <th>#</th>

                  <th>الرقم</th>

                  <th>الاسم</th>

                  <th>الجارد</th>

                  <th>الحالة</th>

                </tr>

                </thead>



              <tbody>

                <span hidden>{{$counter = 0}}</span>

                 @foreach ($permissions as $permission)

                <tr>

                  <td><span class="badge bg-info">#{{++$counter}}</span></td>

                  <td>{{$permission->id}}</td>

                  <td>{{$permission->name}}</td>

                  <td>{{$permission->guard_name}}</td>

                   <td>

                    <div class="icheck-primary d-inline">

                      <input type="checkbox" id="permission_{{$permission->id}}"

                        onchange="storeRolePermission({{$roleId}},{{$permission->id}})" @if($permission->active) checked

                      @endif>

                      <label for="permission_{{$permission->id}}">

                      </label>

                    </div>

                  </td>

                </tr>

                @endforeach

              </tbody>



            </table>

        </div>

    </div>

@endsection







{{-- Scripts Section --}}

@section('scripts')

    {{-- vendors --}}

    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    {{-- page scripts --}}

    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{asset('crudjs/crud.js')}}"></script>



<script>

  function storeRolePermission(roleId, permissionId){

    let data = {

      permission_id: permissionId,

    };



    store('/dashboard/admin/role/'+roleId+'/permissions',data);

  }



</script>

@endsection

