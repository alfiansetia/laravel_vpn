@extends('layouts.backend.template', ['title' => 'Setting Profile'])

@push('css')
    <link href="{{ asset('backend/src/plugins/src/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/plugins/css/light/table/datatable/dt-global_style.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('backend/src/assets/css/dark/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/src/assets/css/light/elements/alert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/src/assets/css/dark/elements/alert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    @if ($user->complete())
        <div class="alert alert-danger layout-top-spacing" role="alert">
            Click <a class="alert-link" href="{{ route('setting.profile.edit') }}">this</a> to Complete Your Profile
            Information!
        </div>
    @endif
    <div class="row layout-spacing ">
        <!-- Content -->
        <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12">
            <div class="user-profile">
                <div class="widget-content widget-content-area p-3">
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
                                    <i data-feather="coffee" class="me-3 bs-tooltip" title="Role"></i>
                                    {{ $user->role }}
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
                                    <i data-feather="award" class="me-3 bs-tooltip" title="Limit Router"></i>
                                    Limit <span class="badge badge-info">{{ $user->router_limit }}</span> Router
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
        <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
            {{-- <div class="payment-history layout-spacing ">
                <div class="widget-content widget-content-area p-3">
                    <h3 class="">Invoice History</h3>
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
            </div> --}}

            <div class="payment-history layout-spacing ">
                <div class="widget-content widget-content-area p-3 text-center">
                    <h3 class="mb-0 text-start">Total Balance</h3>
                    <div class="list-group">
                        <span style="font-size: 38px;font-weight: 600; color: #191e3a">Rp.
                            {{ hrg($user->balance) }}</span>
                    </div>
                    <a href="{{ route('topup.index') }}" class="btn btn-primary"><i data-feather="plus-circle"></i>
                        TopUp</a>
                </div>
            </div>

            <div class="payment-history layout-spacing ">
                <div class="widget-content widget-content-area p-3">
                    <h3 class="">Balance History</h3>
                    <div class="table-responsive">
                        <table class="table" id="table_balance"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('jslib')
    <script src="{{ asset('backend/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/select2/custom-select2.js') }}"></script>

    <script src="{{ asset('backend/src/plugins/src/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endpush

@push('js')
    <script src="{{ asset('js/func.js') }}"></script>

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

    <script>
        $(document).ready(function() {

            var table_balance = $('#table_balance').DataTable({
                processing: true,
                serverSide: true,
                rowId: 'id',
                ajax: {
                    url: "{{ route('api.balance.index') }}",
                    error: function(jqXHR, textStatus, errorThrown) {
                        handleResponseCode(jqXHR, textStatus, errorThrown)
                    },
                    data: function(data) {
                        data.dt = 'on'
                    },
                },
                columnDefs: [{
                    defaultContent: '',
                    targets: "_all"
                }],
                order: [0, 'desc'],
                buttons: [],
                dom: dom,
                stripeClasses: [],
                lengthMenu: length_menu,
                pageLength: 10,
                oLanguage: o_lang,
                columns: [{
                    title: "Date",
                    data: 'date',
                }, {
                    title: "Amount",
                    data: 'amount',
                    render: function(data, type, row, meta) {
                        let plus = `<span class="badge badge-success">+</span>`;
                        let min = `<span class="badge badge-danger">-</span>`;
                        if (type == 'display') {
                            return `${row.type == 'min' ? min : plus} ${hrg(data)}`
                        } else {
                            return data
                        }
                    }
                }, {
                    title: "Desc",
                    data: 'desc',
                }, ],
                headerCallback: function(e, a, t, n, s) {},
                drawCallback: function(settings) {
                    feather.replace();
                    tooltip()
                },
                initComplete: function() {
                    feather.replace();
                }
            });
        })
    </script>
@endpush
