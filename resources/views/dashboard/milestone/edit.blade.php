{{-- Extends layout --}}

@extends('layout.default')



@section('title', 'milestones')

@section('page_description', 'Create milestones')

<style src="{{ asset('css/aiz-core.css') }}"></style>
<style src="{{ asset('plugins/custom/uppy/uppy.bundle.css') }}"></style>
<link href="https://releases.transloadit.com/uppy/v2.2.1/uppy.min.css" rel="stylesheet" />

{{-- Content --}}

@section('content')





    <div class="card card-custom">



        <div class="card-header">

            <h3 class="card-title">

                {{ __('Add milestones') }}

            </h3>

            <div class="card-toolbar">

                <div class="example-tools justify-content-center">

                    <span class="example-toggle" data-toggle="tooltip" title="View code"></span>

                    <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>

                </div>

            </div>

        </div>



        <form class="form" method="post" id='create_form' enctype="multipart/form-data">

            @csrf

            <div class="card-body">


                <div class="row">

                    <div class="form-group col-md-6">

                        <label>{{ __('Name_ar') }}:</label>

                        <input type="text" id="name_ar" value="{{ $milestone->name_ar }}"
                            class="form-control form-control-solid" placeholder="{{ __('Name_ar') }}" />

                    </div>

                    <div class="form-group col-md-6">
                        <label>{{ __('Name_en') }}:</label>
                        <input type="text" id="name_en" value="{{ $milestone->name_en }}"
                            class="form-control form-control-solid" placeholder="{{ __('Name_en') }}" />
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">

                        <label>{{ __('desc_ar') }}:</label>

                        <textarea type="text" id="desc_ar" class="form-control form-control-solid" placeholder="{{ __('desc_ar') }}">{{ $milestone->desc_ar }}</textarea>

                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('desc_en') }}:</label>
                        <textarea type="text" id="desc_en" class="form-control form-control-solid" placeholder="{{ __('desc_en') }}">{{ $milestone->desc_en }}</textarea>
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-md-6">

                        <label>{{ __('long') }}:</label>

                        <input type="text" id="long" value="{{ $milestone->long }}"
                            class="form-control form-control-solid" placeholder="{{ __('long') }}" />

                    </div>
                    <div class="form-group col-md-6">

                        <label>{{ __('lat') }}:</label>

                        <input type="text" id="lat" value="{{ $milestone->lat }}"
                            class="form-control form-control-solid" placeholder="{{ __('lat') }}" />

                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-md-6">

                        <label>{{ __('hight') }}:</label>

                        <input type="text" id="hight" value="{{ $milestone->hight }}"
                            class="form-control form-control-solid" placeholder="{{ __('hight') }}" />

                    </div>
                    <div class="form-group col-md-6">

                        <label>{{ __('width') }}:</label>

                        <input type="text" id="width" value="{{ $milestone->width }}"
                            class="form-control form-control-solid" placeholder="{{ __('width') }}" />

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{ __('categories') }}:</label>
                        <select class="form-control" id="category_id">
                            @foreach ($categories as $category)
                                <option @if ($milestone->category_id == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ __('type') }}:</label>
                        <select class="form-control" id="type_id">
                            @foreach ($types as $type)
                                <option @if ($milestone->type_id == $type->id) selected @endif value="{{ $type->id }}">
                                    {{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>


                <div class="row">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{ 'main Images' }}
                                <small>(600x600)</small></label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ 'Browse' }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ 'Choose File' }}</div>
                                    <input type="hidden" name="main_image" value="{{ $milestone->main_image }}"
                                        id="main_image" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                                <small
                                    class="text-muted">{{ 'These images are visible in product details page gallery. Use 600x600 sizes images.' }}</small>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{ 'icon Images' }}
                                <small>(600x600)</small></label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image"
                                    data-multiple="true">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ 'Browse' }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ 'Choose File' }}</div>
                                    <input type="hidden" name="icon_image" value="{{ $milestone->icon_image }}"
                                        id="icon_image" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                                <small
                                    class="text-muted">{{ 'These images are visible in product details page gallery. Use 600x600 sizes images.' }}</small>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{ 'gallery Images' }}
                                <small>(600x600)</small></label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image"
                                    data-multiple="true">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ 'Browse' }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ 'Choose File' }}</div>
                                    <input type="hidden" name="gallery" value="{{ $milestone->gallery }}"
                                        id="gallery" class="selected-files">
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

                <button type="button" onclick="performUpdate({{ $milestone->id }})"
                    class="btn btn-primary mr-2">{{ __('Submit') }}</button>
                <a href="{{ route('milestones.index') }}"><button type="button"
                        class="btn btn-primary mr-2">{{ __('Cancel') }}</button></a>


            </div>

    </div>

    </form>
@endsection
@section('styles')
    <style>
        .progress {
            position: relative;
            width: 100%;
        }

        .bar {
            background-color: #00ff00;
            width: 0%;
            height: 100px;
            bottom: 20%
        }
    </style>
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

        function performUpdate(id) {
            let data = {
                name_ar: document.getElementById("name_ar").value,
                name_en: document.getElementById("name_en").value,
                desc_ar: document.getElementById("desc_ar").value,
                desc_en: document.getElementById("desc_en").value,
                long: document.getElementById("long").value,
                lat: document.getElementById("lat").value,
                hight: document.getElementById("hight").value,
                width: document.getElementById("width").value,
                main_image: document.getElementById("main_image").value,
                gallery: document.getElementById("gallery").value,
                icon_image: document.getElementById("icon_image").value,
                category_id: document.getElementById("category_id").value,
                type_id: document.getElementById("type_id").value,
            };
            update('/dashboard/admin/milestones/' + id, data, '/dashboard/admin/milestones');
        }
    </script>

@endsection
