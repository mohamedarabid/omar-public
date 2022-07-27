{{-- Extends layout --}}

@extends('layout.default')



@section('title', 'MilestoneArticle')

@section('page_description', 'Create MilestoneArticle')

<style src="{{ asset('css/aiz-core.css') }}"></style>
<style src="{{ asset('plugins/custom/uppy/uppy.bundle.css') }}"></style>
<link href="https://releases.transloadit.com/uppy/v2.2.1/uppy.min.css" rel="stylesheet" />

{{-- Content --}}

@section('content')





    <div class="card card-custom">



        <div class="card-header">

            <h3 class="card-title">

                {{ __('Add MilestoneArticle') }}

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

                        <label>{{ __('Name') }}:</label>

                        <input type="text" id="name" class="form-control form-control-solid"
                            placeholder="{{ __('Name') }}" />

                    </div>

                    <div class="card-body textModule">
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    {{ __('desc') }}
                                </div>
                            </div>
                            <div class="card-body">
                                <textarea name="subscription_terms" id="kt_ckeditor_5" class="subscription_terms ckeditor"></textarea>


                            </div>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{ __('milestones') }}:</label>
                        <select class="form-control" id="milestone_id">
                            @foreach ($milestones as $milestone)
                                <option value="{{ $milestone->id }}">{{ $milestone->name_ar }}</option>
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
                                    <input type="hidden" name="image" id="image" class="selected-files">
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

                <button type="button" onclick="performStore()" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
                <a href="{{ route('milestone-articals.index') }}"><button type="button"
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
    <script src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>

    <script>
        function performStore() {

            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('desc', CKEDITOR.instances.kt_ckeditor_5.getData());
            formData.append('image', document.getElementById('image').value);
            formData.append('milestone_id', document.getElementById('milestone_id').value);


            store('/dashboard/admin/milestone-articals', formData)

        }
    </script>

@endsection
