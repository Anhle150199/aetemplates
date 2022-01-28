@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ url('/') }}/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="{{ url('/') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
@endpush

@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Users Request</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fa fa-users"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Users </a></li>
                                <li class="breadcrumb-item active" aria-current="page">Request</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="#" class="btn btn-sm btn-neutral text-danger">New user</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    {{-- <div class="card-header">
                        <h3 class="mb-0"></h3>
                        <p class="text-sm mb-0"></p>
                    </div> --}}
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-basic">
                            <thead class="thead-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Time Register</th>
                                    @if (Auth::user()->user_role === 'superAdmin')
                                    <th></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <?php $indexUsers = 1; ?>
                                @foreach ($userRequest as $user)
                                    <tr id="{{ $indexUsers }}">

                                        <td>{{ $indexUsers }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td class="email" id="email{{ $indexUsers }}">{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        @if (Auth::user()->user_role === 'superAdmin')
                                            <td>
                                                <button class="btn" style="box-shadow: none;"
                                                    onclick="deleteRequest({{ $indexUsers }})">
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </button>
                                                <button class="btn" style="box-shadow: none;" type="button"
                                                    data-toggle="modal" data-target="#acceptModal"
                                                    data-whatever="{{ $indexUsers }}">
                                                    <i class="fas fa-check text-success"></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                    <?php $indexUsers += 1; ?>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog"
                            aria-labelledby="acceptModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="acceptModalLabel"> </h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('accept-request') }}" id="form-accept-request">

                                        <div class="modal-body">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" id="accept-email" name="accept-email" hidden>
                                                <input type="text" id="accept-id" name="accept-id" hidden>
                                                <label for="set-role-user">Set Role</label>
                                                <select class="form-control" id="set-role-user">
                                                    <option value="superAdmin">Super Admin</option>
                                                    <option value="admin" selected>Admin</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Accept</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{ url('/') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    {{-- <script src="{{ url('/') }}/vendor/datatables.net-select/js/dataTables.select.min.js"></script> --}}
    <script>
        $('#form-accept-request').on('submit', function(e) {
            e.preventDefault();
            const acceptEmail = $('#accept-email').val();
            const id = $('#accept-id').val();
            const acceptRole = $('#set-role-user').val();

            const data = {
                email: acceptEmail,
                role: acceptRole
            }
            const url = $(this).attr('action');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'put',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {

                    $('#' + id).remove();
                    $('#acceptModal').modal('hide');
                },
                error: function(data) {
                    let errors = data.responseJSON.errors;
                    $('#error-logout-session').text(errors);
                }
            });

        })

        function acceptRequest(e) {}

        function deleteRequest(id) {

        }
        $('#acceptModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget) // Button that triggered the modal
            const id = button.data('whatever')
            const recipient = $('#email' + id).text();
            const modal = $(this)
            modal.find('.modal-title').text('Set Role for \"' + recipient + '\"');
            $('#accept-email').val(recipient);
            $('#accept-id').val(id);
        })
    </script>
@endpush
