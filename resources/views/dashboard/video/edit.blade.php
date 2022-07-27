{{-- Extends layout --}}

@extends('layout.default')



@section('title', 'videos')

@section('page_description', 'edit videos')

<style src="{{ asset('css/aiz-core.css') }}"></style>
<style src="{{ asset('plugins/custom/uppy/uppy.bundle.css') }}"></style>
<link href="https://releases.transloadit.com/uppy/v2.2.1/uppy.min.css" rel="stylesheet" />

{{-- Content --}}

@section('content')





    <div class="card card-custom">



        <div class="card-header">

            <h3 class="card-title">

                {{ __('Add videos') }}

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

                    <div class="form-group col-md-6">

                        <label>{{ __('Name') }}:</label>

                        <input type="text" id="name" value="{{ $Video->name }}"
                            class="form-control form-control-solid" placeholder="{{ __('Name') }}" />

                    </div>

                    <div class="form-group col-md-6">
                        <label>{{ __('secound_name') }}:</label>
                        <input type="text" id="secound_name" value="{{ $Video->secound_name }}"
                            class="form-control form-control-solid" placeholder="{{ __('secound_name') }}" />
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">

                        <label>{{ __('code') }}:</label>

                        <input type="text" id="code" value="{{ $Video->code }}"
                            class="form-control form-control-solid" placeholder="{{ __('code') }}" />

                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('desc') }}:</label>
                        <textarea type="text" id="desc" class="form-control form-control-solid" placeholder="{{ __('desc') }}">{{ $Video->desc }}</textarea>
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-md-6">

                        <label>{{ __('url') }}:</label>

                        <input type="text" id="url" value="{{ $Video->url }}"
                            class="form-control form-control-solid" placeholder="{{ __('url') }}" />

                    </div>
                    <div class="form-group col-md-6">

                        <label>{{ __('duration') }}:</label>

                        <input type="number" id="duration" value="{{ $Video->duration }}"
                            class="form-control form-control-solid" placeholder="{{ __('duration') }}" />

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{ __('categories') }}:</label>
                        <select class="form-control" id="category_id">
                            @foreach ($categories as $category)
                                <option @if ($sound->category_id == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('type') }}:</label>
                        <select class="form-control" id="type_id">
                            @foreach ($types as $type)
                                <option @if ($sound->type_id == $type->id) selected @endif value="{{ $type->id }}">
                                    {{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>


                <div class="row">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{ 'Gallery Images' }}
                                <small>(600x600)</small></label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ 'Browse' }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ 'Choose File' }}</div>
                                    <input type="hidden" name="image" value="{{ $Video->image }}" id="image"
                                        class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                                <small
                                    class="text-muted">{{ 'These images are visible in product details page gallery. Use 600x600 sizes images.' }}</small>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="card-footer">

                <button type="button" onclick="performUpdate({{ $Video->id }})"
                    class="btn btn-primary mr-2">{{ __('Submit') }}</button>
                <a href="{{ route('videos.index') }}"><button type="button"
                        class="btn btn-primary mr-2">{{ __('Cancel') }}</button></a>


            </div>

    </div>

    </form>
@endsection


{{-- Scripts Section --}}

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('crudjs/crud.js') }}"></script>
    <script src="{{ asset('js/aiz-core.js') }}"></script>
    <script src="{{ asset('plugins/custom/uppy/uppy.bundle.js') }}"></script>
    <script src="{{ asset('js/pages/crud/file-upload/uppy.js') }}"></script>

    <script>
        $(document).ready(function(e) {
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-logo-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });



        function performUpdate(id) {

            let data = {
                name: document.getElementById("name").value,
                secound_name: document.getElementById("secound_name").value,
                code: document.getElementById("code").value,
                desc: document.getElementById("desc").value,
                image: document.getElementById("image").value,
                url: document.getElementById("url").value,
                duration: document.getElementById("duration").value,
                category_id: document.getElementById("category_id").value,
                type_id: document.getElementById("type_id").value,
            };
            update('/dashboard/admin/videos/' + id, data, '/dashboard/admin/videos');

        }
    </script>

@endsection
