{{-- Extends layout --}}

@extends('layout.default')



@section('title', 'Admin')

@section('page_description', 'Edit Admin')



@section('styles')

@endsection



{{-- Content --}}

@section('content')





    <div class="card card-custom">



        <div class="card-header">

            <h3 class="card-title">

                {{ __('Admin') }}

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
                    <div class="form-group col-md-12">
                        <label>{{ __('Role') }}:</label>
                        <select class="form-control form-control-solid" name="role_id" id="role_id">
                            @foreach ($roles as $role)
                                @if ($roleModel != null)
                                    <option value="{{ $role->id }}"
                                        @if ($roleModel->role_id == $role->id) selected="selected" @endif>
                                        {{ $role->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-md-4">

                        <label>{{ __('First Name') }}:</label>

                        <input type="text" id="first_name" class="form-control form-control-solid"
                            value="{{ $admin->first_name }}" placeholder="Enter First Name" />

                    </div>

                    <div class="form-group col-md-4">

                        <label>{{ __('Last Name') }}:</label>

                        <input type="text" id="last_name" class="form-control form-control-solid"
                            value="{{ $admin->last_name }}" placeholder="Enter Last Name" />

                    </div>

                    <div class="form-group col-md-4">

                        <label>{{ __('Email') }}:</label>

                        <input type="email" id="email" class="form-control form-control-solid" value="{{ $admin->email }}"
                            placeholder="Enter Email" />

                    </div>

                </div>



                <div class="row">




                </div>



                <div class="row">

                    <div class="form-group col-md-4">

                        <label>{{ __('Mobile') }}</label>

                        <input type="number" id="mobile" class="form-control form-control-solid"
                            value="{{ $admin->mobile }}" placeholder="Enter mobile" />

                    </div>
                    <div class="form-group col-md-4">

                        <label class="form-label">{{ __('Status') }}:</label>

                        <select class="form-control form-control-solid" name="status" id="status">

                            <option value="active" @if ($admin->status == 'active') selected @endif>{{ __('Active') }}
                            </option>

                            <option value="deactive" @if ($admin->status == 'deactive') selected @endif>
                                {{ __('Deactive') }}</option>

                        </select>

                    </div>

                    <div class="form-group col-md-8">

                        <div class="image-input image-input-outline image-input-circle" id="kt_image_3">

                            <label>{{ __('Image') }}</label>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <input type="file" name="image" placeholder="Choose image" id="image">

                                    @error('image')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror

                                </div>


                                <div class="col-md-12 mb-2">

                                    <img id="preview-image-before-upload"
                                        src="{{ asset('images/admin/' . $admin->image) }}" alt="preview image"
                                        style="max-height: 250px;">

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

                <button type="button" onclick="performStore({{ $admin->id }})"
                    class="btn btn-primary mr-2">{{ __('Submit') }}</button>
                <a href="{{ route('admins.index') }}"><button type="button"
                        class="btn btn-primary mr-2">{{ __('Cancel') }}</button></a>

            </div>

    </div>

    </form>

@endsection







{{-- Scripts Section --}}

@section('scripts')

    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="{{ asset('crudjs/crud.js') }}"></script>

    <script>
        $('.role_id').select2({

            theme: 'bootstrap4'

        })


        $(document).ready(function(e) {


            $('#image').change(function() {



                let reader = new FileReader();


                reader.onload = (e) => {


                    $('#preview-image-before-upload').attr('src', e.target.result);

                }

                reader.readAsDataURL(this.files[0]);


            });


        });



        function performStore(id) {


            let formData = new FormData();

            formData.append('first_name', document.getElementById('first_name').value);

            formData.append('last_name', document.getElementById('last_name').value);

            formData.append('email', document.getElementById('email').value);

            // formData.append('password',document.getElementById('password').value);

            formData.append('mobile', document.getElementById('mobile').value);


            formData.append('status', document.getElementById('status').value);

            formData.append('role_id', document.getElementById('role_id').value);

            formData.append('image', document.getElementById('image').files[0]);


            store('/dashboard/admin/update-admin/' + id, formData)

        }
    </script>

@endsection
