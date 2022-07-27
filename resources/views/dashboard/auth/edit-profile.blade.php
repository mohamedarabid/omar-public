{{-- Extends layout --}}

@extends('layout.default')



@section('title','الآدمن')

@section('page_description','Create Admin')



@section('styles')

<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">

@endsection



{{-- Content --}}

@section('content')





<div class="card card-custom">



    <div class="card-header">

        <h3 class="card-title">

            تعديل البروفايل

        </h3>

        <div class="card-toolbar">

            <div class="example-tools justify-content-center">

                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>

                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>

            </div>

        </div>

    </div>

    <form class="form" method="post" id='create_admin_form'>

        @csrf



        <div class="card-body">

            <div class="row">

            <div class="form-group col-md-4">
                <label>الاسم الأول:</label>
                <input type="text" id="first_name"  class="form-control form-control-solid" 
                value="{{$edit->first_name}}" placeholder="Enter First Name"/>
            </div>

            <div class="form-group col-md-4">
                <label>الاسم الثاني:</label>
                <input type="text" id="last_name"  class="form-control form-control-solid" 
                value="{{$edit->last_name}}" placeholder="Enter Last Name"/>
            </div>

            <div class="form-group col-md-4">
                <label>الايميل:</label>
                <input type="email" id="email" class="form-control form-control-solid" 
                value="{{$edit->email}}" placeholder="Enter Email" />
            </div>

            </div>

            <div class="row">

             <div class="form-group col-md-4">
                <label>الموبايل:</label>
                <input type="number" id="mobile" class="form-control form-control-solid" 
                value="{{$edit->mobile}}" placeholder="Enter mobile" />
            </div>

            <div class="form-group col-md-4">
                <label>تاريخ الميلاد:</label>
                <input type="date" id="birth_date" class="form-control form-control-solid" 
                value="{{$edit->birth_date}}" placeholder="Enter B.D"/>
            </div>

            <div class="form-group col-md-4">
                <label class="form-label">الجنس:</label>
                  <select class="form-control form-control-solid" name="gender" id="gender">
                    <option value="M" @if($edit->gender == 'M') selected
                     @endif>ذكر</option>
                    <option value="F" @if($edit->gender == 'F') selected
                     @endif>أنثى</option>
                  </select>
                </div>

        </div>

        <div class="row">

             <div class="form-group col-md-12">
                        <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                            <label>الصورة:</label>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" name="image" placeholder="Choose image" id="image">
                                    @error('image')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <img id="preview-logo-before-upload"
                                        src="{{Storage::url('images/admin/'.$edit->image)}}"
                                        alt="preview image" style="max-height:300px;width:300px;">
                                </div>
                            </div>
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>

            </div>


        </div>

           

      

     </div>

      <div class="card-footer">

         <button type="button" onclick="performUpdate()" class="btn btn-success mr-2">تعديل</button>
         <a href="{{route('admins.index')}}"><button type="button" class="btn btn-primary mr-2">الغاء</button></a>


     </div>

  </div>

</form>

@endsection







{{-- Scripts Section --}}

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="{{asset('crudjs/crud.js')}}"></script>

<script>



 $(document).ready(function (e) {
   $('#image').change(function(){ 
    let reader = new FileReader();
    reader.onload = (e) => { 
      $('#preview-logo-before-upload').attr('src', e.target.result); 
    }
    reader.readAsDataURL(this.files[0]); 
   });
});

    function performUpdate() {

        

        let formData = new FormData(); 

            formData.append('first_name',document.getElementById('first_name').value);

            formData.append('last_name',document.getElementById('last_name').value);

            formData.append('email',document.getElementById('email').value);

            formData.append('mobile',document.getElementById('mobile').value);

            formData.append('birth_date',document.getElementById('birth_date').value);

            formData.append('gender',document.getElementById('gender').value);
        
            formData.append('image',document.getElementById('image').files[0]);



        

    // update('/cms/admin/profile/update', formData);
    storeRoute('/cms/admin/profile/update',formData);

    }



       



</script>

@endsection

