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
                        <a href="{{ route('new-user') }}" class="btn btn-sm btn-neutral text-danger">New user</a>
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
                    <div class="card-header">
                        <h3 class="mb-0">User Request</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-basic">
                            <thead class="thead-light">
                                <tr>
                                    {{-- <th>No.</th> --}}
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

                                        <td>{{ $user->name }}</td>
                                        <td class="email" id="email{{ $indexUsers }}">{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        @if (Auth::user()->user_role === 'superAdmin')
                                            <td class="table-actions">
                                                <a href="#!" class="table-action" data-toggle="modal"
                                                    data-original-title="Accept User" data-target="#acceptModal"
                                                    data-whatever="{{ $indexUsers }}">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                                <a href="#!" class="table-action table-action-delete" data-toggle="modal"
                                                    data-original-title="Delete User" data-target="#deleteModal"
                                                    data-whatever="{{ $indexUsers }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                    <?php $indexUsers += 1; ?>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Accept Modal --}}
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
                                    <form action="{{ route('edit-role') }}" id="form-accept-request">

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
                                                <p id="error-accept-request"></p>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning">Accept</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- End Accept Modal --}}

                        {{-- Delete Modal --}}
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel"> </h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="error-delete"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('delete-request') }}" id="form-delete-request">
                                            <input type="text" id="delete-email" name="delete-email" hidden>
                                            <input type="text" id="delete-id" name="delete-id" hidden>

                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Delete Modal --}}
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
    <script src="{{ url('/') }}/js/admin/usersManage.js"></script>
@endpush
