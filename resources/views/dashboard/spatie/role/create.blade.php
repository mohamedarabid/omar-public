{{-- Extends layout --}}

@extends('layout.default')

@section('title','الصلاحيات')



@section('styles')

<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">

@endsection



{{-- Content --}}

@section('content')





<div class="card card-custom">



    <div class="card-header">

        <h3 class="card-title">

           انشئ صلاحية

        </h3>

        <div class="card-toolbar">

            <div class="example-tools justify-content-center">

                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>

                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>

            </div>

        </div>

    </div>

    <form class="form" method="post" id="create_form">

        @csrf

        <div class="card-body">

            <div class="row">
            <div class="form-group col-md-6">
                <label>المستخدمون:</label>
                <select class="form-control form-control-solid" name="guard_name" id="guard_name">
                 <option value="admin">المشرف</option>
                 <option value="lawyer">المحامي</option>
                 {{-- <option value="accountant">المحاسب</option> --}}
                    </select>
                    </div>

            <div class="form-group col-md-6">
                <label>اسم الصلاحية:</label>
                <input type="text" name="name" id="name"  class="form-control form-control-solid"
                placeholder="ادخل الصلاحية"/>

            </div>

         </div>

     </div>

      <div class="card-footer">

         <button type="button" onclick="performStore()" class="btn btn-success mr-2">حفظ</button>
         <a href="{{route('roles.index')}}"><button type="button" class="btn btn-primary mr-2">الغاء</button></a>


     </div>

  </div>

</form>

@endsection







{{-- Scripts Section --}}

@section('scripts')

<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="{{asset('crudjs/crud.js')}}"></script>

<script>

        //Initialize Select2 Elements

    $('.guards').select2({
        theme: 'bootstrap4'
    })

        function performStore() {
        let formData = new FormData();
        formData.append('name', document.getElementById('name').value);
        formData.append('guard_name', document.getElementById('guard_name').value);
         storeRoute('/dashboard/admin/roles',formData);
    }


</script>

@endsection

