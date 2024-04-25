@extends('layouts.backend.template', ['title' => 'Page Contact'])

@push('css')
    <link href="{{ asset('backend/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/src/assets/css/light/elements/alert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/elements/alert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/src/assets/css/light/pages/contact_us.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/pages/contact_us.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="statbox widget box box-shadow layout-top-spacing">

        <div class="widget-content widget-content-area pt-0">

            <div class="contact-us-form">

                <div class="row gx-5">
                    <div class="col-md-12">

                        <div class="paper contact-us-info-section-1">

                            <div class="row gx-5">
                                <div class="col-12">
                                    <h4 class="contact-title">Our Team</h4>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-6 mb-3">

                                    <div class="widget-paper">
                                        <div class="icon">
                                            <div class="avatar avatar-lg avatar-indicators avatar-online">
                                                <img alt="avatar" src="{{ asset('images/contact/owner.jpg') }}"
                                                    class="rounded-circle" />
                                            </div>
                                        </div>
                                        <h5>Owner</h5>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                                    <div class="widget-paper">
                                        <div class="pb-2">
                                            <div class="avatar avatar-xl avatar-indicators avatar-online">
                                                <img alt="avatar" src="{{ asset('images/contact/admin.jpg') }}"
                                                    class="rounded-circle" />
                                            </div>
                                        </div>
                                        <h5>Admin</h5>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 mb-3 mx-auto">
                                    <div class="widget-paper">
                                        <div class="icon">
                                            <div class="avatar avatar-lg avatar-indicators avatar-online">
                                                <img alt="avatar" src="{{ asset('images/contact/dev.jpg') }}"
                                                    class="rounded-circle" />
                                            </div>
                                        </div>
                                        <h5>Developer</h5>
                                    </div>
                                </div>
                                <div class="col-12 mt-5">
                                    <h4 class="contact-title">Contact Us at</h4>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                                    <div class="widget-paper">
                                        <div class="icon">
                                            <i data-feather="mail" class="icon icon-tabler icon-tabler-help"></i>
                                        </div>
                                        <h5>Email</h5>
                                        <p>alfian.setia100@gmail.com</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                                    <div class="widget-paper">
                                        <div class="icon">
                                            <i data-feather="message-circle"
                                                class="icon icon-tabler icon-tabler-message-2"></i>
                                        </div>
                                        <h5>Whatsapp</h5>
                                        <p>0823-2412-9752</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 mb-3 mx-auto">
                                    <div class="widget-paper">
                                        <div class="icon">
                                            <i data-feather="phone-call"
                                                class="icon icon-tabler icon-tabler-report-analytics"></i>
                                        </div>

                                        <h5>Phone</h5>
                                        <p>0823-2412-9752</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

@push('jslib')
@endpush

@push('js')
    <script>
        $(document).ready(function() {


        });
    </script>
@endpush
