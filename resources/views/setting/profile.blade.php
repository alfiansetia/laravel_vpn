@extends('layouts.backend.template', ['title' => 'Setting Profile'])

@push('css')
    <link href="{{ asset('backend/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/src/assets/css/light/elements/alert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/elements/alert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row layout-spacing ">
        <!-- Content -->
        <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
            <div class="user-profile">
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-between">
                        <h3 class="">Profile</h3>
                        <a href="{{ route('setting.profile.edit') }}" class="mt-2 edit-profile bs-tooltip"
                            title="Edit Profile"><i data-feather="edit-3"></i></a>
                    </div>
                    <div class="text-center user-info">
                        <img src="{{ $user->avatar }}" alt="avatar">
                        <p class="">{{ $user->name }}</p>
                    </div>
                    <div class="user-info-list">
                        <div class="pt-0">
                            <ul class="contacts-block list-unstyled">
                                <li class="contacts-block__item">
                                    <i data-feather="coffee" class="me-3 bs-tooltip" title="Role"></i> {{ $user->role }}
                                </li>
                                <li class="contacts-block__item">
                                    <a href="mailto:{{ $user->email }}">
                                        <i data-feather="mail" class="me-3 bs-tooltip" title="Email"></i>
                                        {{ $user->email }}</a>
                                </li>
                                <li class="contacts-block__item">
                                    <i data-feather="phone" class="me-3 bs-tooltip" title="Phone"></i> {{ $user->phone }}
                                </li>
                                <li class="contacts-block__item">
                                    <i data-feather="map-pin" class="me-3 bs-tooltip" title="Address"></i>
                                    {{ $user->address }}
                                </li>
                                <li class="contacts-block__item">
                                    <i data-feather="clock" class="me-3 bs-tooltip" title="Last Login At"></i>
                                    {{ $user->last_login_at ?? 'Unavailable' }}
                                </li>
                                <li class="contacts-block__item">
                                    <i data-feather="wifi" class="me-3 bs-tooltip" title="Last Login IP"></i>
                                    {{ $user->last_login_ip ?? 'Unavailable' }}
                                </li>
                            </ul>
                            <ul class="list-inline mt-4">
                                <li class="list-inline-item mb-0">
                                    <a class="btn btn-info btn-icon btn-rounded bs-tooltip" href="javascript:void(0);"
                                        title="Linkedin">
                                        <i data-feather="linkedin"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mb-0">
                                    <a class="btn btn-danger btn-icon btn-rounded bs-tooltip" href="javascript:void(0);"
                                        title="Instagram">
                                        <i data-feather="instagram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mb-0">
                                    <a class="btn btn-primary btn-icon btn-rounded bs-tooltip" href="javascript:void(0);"
                                        title="Facebook">
                                        <i data-feather="facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mb-0">
                                    <a class="btn btn-dark btn-icon btn-rounded bs-tooltip" href="javascript:void(0);"
                                        title="Github">
                                        <i data-feather="github"></i>
                                    </a>
                                </li>
                            </ul>
                            <a href="{{ route('setting.profile.password') }}" class="btn btn-danger btn-block mt-2">
                                <i class="fas fa-fingerprint me-1 bs-tooltip" title="Change Password"></i>Change Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
            <div class="payment-history layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">Orders History</h3>
                    <div class="list-group">
                        @forelse ($orders as $item)
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold title">{{ $item->date }}</div>
                                    <p class="sub-title mb-0">To {{ $item->bank->name ?? '' }}</p>
                                </div>
                                <span class="pay-pricing align-self-center me-3">{{ $item->total }}</span>
                                <div class="btn-group dropstart align-self-center" role="group">
                                    <a id="paymentHistory1" href="javascript:void(0);" class="dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="more-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="paymentHistory1">
                                        <a class="dropdown-item" href="javascript:void(0);">View Invoice</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Download Invoice</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-light-danger alert-dismissible fade show border-0 mb-4"
                                role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i data-feather="x" class="close"></i>
                                </button>
                                <strong>Empty Order!</strong> </button>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
            <div class="summary layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">Summary</h3>
                    <div class="order-summary">

                        <div class="summary-list summary-income">

                            <div class="summery-info">

                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-shopping-bag">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                </div>

                                <div class="w-summary-details">

                                    <div class="w-summary-info">
                                        <h6>Income <span class="summary-count">$92,600 </span></h6>
                                        <p class="summary-average">90%</p>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="summary-list summary-profit">

                            <div class="summery-info">

                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-dollar-sign">
                                        <line x1="12" y1="1" x2="12" y2="23"></line>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                    </svg>
                                </div>

                                <div class="w-summary-details">

                                    <div class="w-summary-info">
                                        <h6>Profit <span class="summary-count">$37,515</span></h6>
                                        <p class="summary-average">65%</p>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="summary-list summary-expenses">

                            <div class="summery-info">

                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-credit-card">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2">
                                        </rect>
                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                    </svg>
                                </div>
                                <div class="w-summary-details">

                                    <div class="w-summary-info">
                                        <h6>Expenses <span class="summary-count">$55,085</span></h6>
                                        <p class="summary-average">42%</p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">

            <div class="pro-plan layout-spacing">
                <div class="widget">

                    <div class="widget-heading">

                        <div class="task-info">
                            <div class="w-title">
                                <h5>Pro Plan</h5>
                                <span>$25/month</span>
                            </div>
                        </div>

                        <div class="task-action">
                            <button class="btn btn-secondary">Renew Now</button>
                        </div>
                    </div>

                    <div class="widget-content">

                        <ul class="p-2 ps-3 mb-4">
                            <li class="mb-1"><strong>10,000 Monthly Visitors</strong></li>
                            <li class="mb-1"><strong>Unlimited Reports</strong></li>
                            <li class=""><strong>2 Years Data Storage</strong></li>
                        </ul>

                        <div class="progress-data">
                            <div class="progress-info">
                                <div class="due-time">
                                    <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg> 5 Days Left</p>
                                </div>
                                <div class="progress-stats">
                                    <p class="text-info">$25 / month</p>
                                </div>
                            </div>

                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 65%"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
            <div class="payment-history layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">Payment History</h3>

                    <div class="list-group">
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-bold title">March</div>
                                <p class="sub-title mb-0">Pro Membership</p>
                            </div>
                            <span class="pay-pricing align-self-center me-3">$45</span>
                            <div class="btn-group dropstart align-self-center" role="group">
                                <a id="paymentHistory1" href="javascript:void(0);" class="dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-more-horizontal">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="paymentHistory1">
                                    <a class="dropdown-item" href="javascript:void(0);">View Invoice</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Download Invoice</a>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-bold title">February</div>
                                <p class="sub-title mb-0">Pro Membership</p>
                            </div>
                            <span class="pay-pricing align-self-center me-3">$45</span>
                            <div class="btn-group dropstart align-self-center" role="group">
                                <a id="paymentHistory2" href="javascript:void(0);" class="dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-more-horizontal">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="paymentHistory2">
                                    <a class="dropdown-item" href="javascript:void(0);">View Invoice</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Download Invoice</a>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-bold title">January</div>
                                <p class="sub-title mb-0">Pro Membership</p>
                            </div>
                            <span class="pay-pricing align-self-center me-3">$45</span>
                            <div class="btn-group dropstart align-self-center" role="group">
                                <a id="paymentHistory3" href="javascript:void(0);" class="dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-more-horizontal">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="paymentHistory3">
                                    <a class="dropdown-item" href="javascript:void(0);">View Invoice</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Download Invoice</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
            <div class="payment-methods layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">Payment Methods</h3>

                    <div class="list-group">
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <img src="../src/assets/img/card-americanexpress.svg" class="align-self-center me-3"
                                alt="americanexpress">
                            <div class="me-auto">
                                <div class="fw-bold title">American Express</div>
                                <p class="sub-title mb-0">Expires on 12/2025</p>
                            </div>
                            <span class="badge badge-success align-self-center me-3">Primary</span>
                        </div>

                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <img src="../src/assets/img/card-mastercard.svg" class="align-self-center me-3"
                                alt="mastercard">
                            <div class="me-auto">
                                <div class="fw-bold title">Mastercard</div>
                                <p class="sub-title mb-0">Expires on 03/2025</p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <img src="../src/assets/img/card-visa.svg" class="align-self-center me-3" alt="visa">
                            <div class="me-auto">
                                <div class="fw-bold title">Visa</div>
                                <p class="sub-title mb-0">Expires on 10/2025</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('jslib')
    <script src="{{ asset('backend/src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/select2/custom-select2.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/src/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('#edit_profile_btn').click(function() {
                $('#name').focus();
            });

            var old = $('#gender').val()

            $('#gender').select2();

            $('#reset').click(function() {
                $('#gender').val(old).change()
            })

            $('.maxlength').maxlength({
                placement: "top",
                alwaysShow: true
            });

            $('#form').submit(function(event) {
                block();
            }).validate({
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    $(element).addClass('is-valid');
                }
            });

        });
    </script>
@endpush
