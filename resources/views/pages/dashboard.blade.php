{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    {{-- Dashboard 1 --}}

    <div class="row">

        <div class="col-lg-12 col-xxl-12">
            @include('pages.widgets._widget-1', ['class' => 'card-stretch gutter-b'])
        </div>



        {{-- <div class="col-lg-6 col-xxl-4">
            <!--begin::Stats Widget 4-->
            <div class="card card-stretch card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">
                            <h1>70</h1>
                        </a>
                        <span class="font-weight-bold text-muted font-size-lg"></span>
                    </div>
                    <img src="{{ asset('media/svg/avatars/029-boy-11.svg') }}" alt=""
                        class="align-self-end h-100px" />
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 4-->
            <div class="card card-stretch card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">
                            <h1>30</h1>
                        </a>
                        <span class="font-weight-bold text-muted font-size-lg"></span>
                    </div>
                    <img src="{{ asset('media/svg/avatars/Veiled-Girl.svg') }}" alt=""
                        class="align-self-end h-100px" />
                </div>
                <!--end::Body-->
            </div>
            <div class="card card-stretch card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center py-0 mt-8">
                    <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                        <a href="#"
                            class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">عدد
                            المرابطين</a>
                        <span class="font-weight-bold text-muted font-size-lg">100</span>
                    </div>
                    <img src="{{ asset('media/svg/avatars/014-girl-7.svg') }}" alt=""
                        class="align-self-end h-100px" />
                    <img src="{{ asset('media/svg/avatars/029-boy-11.svg') }}" alt=""
                        class="align-self-end h-100px" />
                </div>
                <!--end::Body-->
            </div>
        </div> --}}

        {{-- <div class="col-lg-6 col-xxl-4">
            @include('pages.widgets._widget-5', ['class' => 'card-stretch card-stretch-half gutter-b'])
        </div> --}}

        {{-- <div class="col-xxl-8 order-2 order-xxl-1">
            @include('pages.widgets._widget-6', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">
            @include('pages.widgets._widget-7', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-lg-6 col-xxl-4 order-1 order-xxl-2">
            @include('pages.widgets._widget-8', ['class' => 'card-stretch gutter-b'])
        </div>

        <div class="col-lg-12 col-xxl-4 order-1 order-xxl-2">
            @include('pages.widgets._widget-9', ['class' => 'card-stretch gutter-b'])
        </div> --}}
    </div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
