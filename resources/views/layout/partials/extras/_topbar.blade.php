{{-- Topbar --}}
<div class="topbar">

    {{-- Search --}}


    {{-- Notifications --}}


    {{-- Quick Actions --}}

    {{-- My Cart --}}


    {{-- Quick panel --}}
    @if (config('layout.header.topbar.quick-panel.display'))
        <div class="topbar-item">
            <div class="btn btn-icon btn-clean btn-lg mr-1" id="kt_quick_panel_toggle">
                {{ Metronic::getSVG('media/svg/icons/Layout/Layout-4-blocks.svg', 'svg-icon-xl svg-icon-primary') }}
            </div>
        </div>
    @endif

    {{-- Languages --}}
    @if (config('layout.extras.languages.display'))
        <div class="dropdown">
            <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                    <img class="h-20px w-20px rounded-sm" src="{{ asset('media/svg/flags/008-saudi-arabia.svg') }}"
                        alt="" />
                </div>
            </div>

            <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                @include('layout.partials.extras.dropdown._languages')
            </div>
        </div>
    @endif

    {{-- User --}}
    @if (config('layout.extras.user.display'))
        @if (config('layout.extras.user.layout') == 'offcanvas')
            <div class="topbar-item">
                <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2"
                    id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    <span
                        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ auth('admin')->user()->first_name ?? '' }}</span>
                    <span class="symbol symbol-35 symbol-light-success">
                        <span class="symbol-label font-size-h5 font-weight-bold">
                            <div class="symbol-label"
                                style="background-image:url({{ url('images/admin/' . auth('admin')->user()->image ?? '') }}">
                            </div>
                        </span>
                    </span>
                </div>
            </div>
        @else
            <div class="dropdown">
                {{-- Toggle --}}
                <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2">
                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                        <span
                            class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ auth('admin')->user()->first_name ?? '' }}</span>
                        <span class="symbol symbol-35 symbol-light-success">
                            <span class="symbol-label font-size-h5 font-weight-bold">
                                <div class="symbol-label"
                                    style="background-image:url({{ url('images/admin/' . auth('admin')->user()->image ?? '') }}">
                                </div>
                            </span>
                        </span>
                    </div>
                </div>

                {{-- Dropdown --}}
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
                    @include('layout.partials.extras.dropdown._user')
                </div>
            </div>
        @endif
    @endif
</div>
