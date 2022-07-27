{{-- Extends layout --}}

@extends('layout.default')

@section('title','الآدمن')

@section('page_description','Admin')


{{-- Content --}}

@section('content')

<div class="card card-custom">



    <div class="card-header">

        <h3 class="card-title">

            تعديل الباسوورد

        </h3>

        <div class="card-toolbar">

            <div class="example-tools justify-content-center">

                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>

                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>

            </div>

        </div>

    </div>

    <form class="form" method="post" id='create_form'>

        @csrf

        <div class="card-body">

            <div class="row">

            <div class="form-group col-md-12">

                <label>الكلمة الجديدة:</label>

                <input type="password" name="password" id="password"

                    class="form-control form-control-solid" placeholder="New Password"/>

            </div>


            </div> 

     </div>

   </div>

  <div class="card-footer">

    <button type="button" onclick="performUpdate({{$admin->id}})" class="btn btn-success mr-2">تعديل</button>
    <a href="{{route('admins.index')}}"><button type="button" class="btn btn-primary mr-2">الغاء</button></a>

</div>



</form>

@endsection

@section('styles')



@endsection



@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="{{asset('crudjs/crud.js')}}"></script>



<script>

 

    function performUpdate(id) {
           
        let formData = new FormData();
            formData.append('password',document.getElementById('password').value);
            // formData.append('new_password_confirmation',document.getElementById('new_password_confirmation').files[0]);
            
            storeRoute('/cms/admin/passwordAdmin/update/'+id,formData);
                

    }



        

    </script>

@endsection

