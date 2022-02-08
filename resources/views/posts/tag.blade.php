@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ url('/') }}/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="{{ url('/') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    {{-- <link rel="stylesheet" href="{{ url('/') }}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css"> --}}
@endpush

@section('content')
    <!-- Header -->
    <!-- Header -->
    <div class="header pb-6 bg-primary">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{ config('app.name') }}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fa fa-paper-plane"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Posts</a></li>
                                <li class="breadcrumb-item"><a href="#"> Tags </a></li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            {{-- Add New Tag --}}
            <div class="col-xl-4 order-xl-2">
                <div class="card card-profile">

                    <form id="formAddTag" action="{{ route('add-tag') }}">
                        @csrf
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">New Tag </h3>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" id="new-tag" name="new-tag" class="form-control"
                                                placeholder="new tag" required>
                                            <p class="p-error text-danger" id="error-new-tag"></p>
                                        </div>

                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-sm btn-warning">Add</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                    {{-- End Form --}}
                </div>
            </div>

            {{-- Tags List --}}
            <div class="col-xl-8 order-xl-1">
                <!-- Table -->
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header">
                                <h3 class="mb-0">List Tags</h3>
                            </div>
                            <div class="table-responsive py-4">
                                <table class="table table-flush" id="datatable-basic">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Posts</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $indexTag = 1; ?>
                                        @foreach ($tags as $tag)
                                            <tr id="{{ $indexTag }}">
                                                <td></td>
                                                <td id="tag-name-{{ $indexTag }}">{{ $tag->tag_name }}</td>
                                                <td id="slug-{{ $indexTag }}">{{ $tag->tag_slug }}</td>
                                                <td>{{ $tag->posts_count }}</td>
                                                <td class="table-actions ">
                                                    <a href="#!" class="table-action table-action-success"
                                                        data-toggle="modal" data-original-title="Edit Tag"
                                                        data-target="#editModal" data-whatever="{{ $indexTag }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#!" class="table-action table-action-delete"
                                                        data-toggle="modal" data-original-title="Delete Tag"
                                                        data-target="#deleteModal" data-whatever="{{ $indexTag }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                                <?php $indexTag++; ?>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- Edit Tag --}}
                                <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Tag </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('edit-tag') }}" id="form-edit-tag">
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="text" id="edit-id" name="edit-id" hidden>
                                                        <input type="text" id="edit-tag" name="edit-tag"
                                                            class="form-control" required>
                                                        <p id="error-edit-tag" class="p-error text-danger"></p>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Edit Tag --}}

                                {{-- Delete tag --}}
                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Are you sure? </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('delete-tag') }}" id="form-delete-tag">
                                                    <input type="text" id="delete-id" name="delete-id" hidden>

                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Delete Tag --}}
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
    <script>
        $(document).ready(function() {
            let t = $('#datatable-basic').DataTable();
            t.on('order.dt search.dt', function() {
                t.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });

        // Add Tag
        $('#formAddTag').on('submit', function(e) {
            e.preventDefault();

            const table = $('#datatable-basic').DataTable();
            const newTag = $('#new-tag').val();
            const slugTag = convertUrl(newTag);
            const data = {
                tag_name: newTag,
                tag_slug: slugTag,
            };
            const url = $('#formAddTag').attr('action');
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
                    let newTag = data.newTag;
                    let nextRowIndex = table.rows().count() + 1;
                    let newRow = table.row.add([
                            0,
                            newTag.tag_name,
                            newTag.tag_slug,
                            0,
                            colAction(nextRowIndex)
                        ]).draw()
                        .node();
                    $('#new-tag').val('');
                    $(newRow).find('td').eq(1).attr('id', 'tag-name-' + nextRowIndex);
                    $(newRow).find('td').eq(2).attr('id', 'slug-' + nextRowIndex);
                    $(newRow).attr('id', nextRowIndex);
                },
                error: function(data) {
                    let errors = data.responseJSON.errors;
                    $('#error-new-tag').text(errors.tag_slug);
                }
            });

        })

        // Delete tag
        $('#form-delete-tag').on('submit', (e) => {
            e.preventDefault();
            const table = $('#datatable-basic').DataTable();
            let rowTable = table.rows().count();
            const id = $('#delete-id').val();
            const tagSlug = $('#slug-' + id).text();
            const data = {
                tag_slug: tagSlug,
            };
            const url = $('#form-delete-tag').attr('action');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'delete',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    table
                        .row($('#' + id))
                        .remove()
                        .draw();

                    $('#deleteModal').modal('hide');
                    console.log("id: " + id + " rowTable: " + rowTable);

                    const range = (start, stop, step) => Array.from({
                        length: (stop - start) / step + 1
                    }, (_, i) => start + (i * step));
                    for (i of range(parseInt(id) + 1, parseInt(rowTable), 1)) {
                        $('#' + i).find('a').attr('data-whatever', i - 1);
                        $('#tag-name-' + i).attr('id', 'tag-name-' + (i - 1));
                        $('#slug-' + i).attr('id', 'slug-' + (i - 1));
                        $('#' + i).attr('id', i - 1);
                    }

                },
                error: function(data) {
                    let errors = data.responseJSON.errors;
                    setTimeout(() => {
                        $('#deleteModal').modal('hide');
                    }, 500);
                    alert(errors);
                }
            });
        })
        // Edit Tag
        $('#form-edit-tag').on('submit', (e) => {
            e.preventDefault();
            const table = $('#datatable-basic').DataTable();
            const id = $('#edit-id').val();
            const slugOldTag = $('#slug-' + id).text();
            const nameEditTag = $('#edit-tag').val();
            const slugEditTag = convertUrl(nameEditTag);
            const data = {
                slug_old_tag: slugOldTag,
                tag_name: nameEditTag,
                tag_slug: slugEditTag
            };
            const url = $('#form-edit-tag').attr('action');
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
                    $('#editModal').modal('hide');
                    // console.log(data.tagEdit);
                    $('#slug-' + id).text(data.tagEdit.tag_slug);
                    $('#tag-name-' + id).text(data.tagEdit.tag_name);
                },
                error: function(data) {
                    let errors = data.responseJSON.errors;
                    console.log(errors);
                    setTimeout(() => {
                        if (errors.tag_name) {
                            $('#error-edit-tag').text(errors.tag_name)
                        } else if (errors.tag_slug) {
                            $('#error-edit-tag').text(errors.tag_slug)
                        } else if (errors.slug_old_tag) {
                            $('#error-edit-tag').text(errors.slug_old_tag)
                        } else {
                            $('#error-edit-tag').text(errors.other)
                        }
                    }, 10000);
                }
            });
        })

        //  ######### Modal #########
        // Delete Modal
        $('#deleteModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget) // Button that triggered the modal
            const id = button.data('whatever')
            const recipient = $('#tag-name-' + id).text();
            const modal = $(this)
            console.log(id);
            $('#delete-id').val(id);
            $('#deleteModalLabel').text("Are you sure delete \"" + recipient + "\" ?")
        })
        // Edit Modal
        $('#editModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget) // Button that triggered the modal
            const id = button.data('whatever')
            // const recipient = $('#slug-' + id).text();
            $('#edit-id').val(id);
            $('#edit-tag').val($('#tag-name-' + id).text());
            console.log(id);
        })

        function removeVietnameseTones(str) {
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
            str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
            str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
            str = str.replace(/đ/g, "d");
            str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
            str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
            str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
            str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
            str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
            str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
            str = str.replace(/Đ/g, "D");
            str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, "");
            str = str.replace(/\u02C6|\u0306|\u031B/g, "");
            str = str.replace(/ + /g, " ");
            str = str.trim();
            str = str.replace(
                /!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g,
                " "
            );
            return str;
        }

        function convertUrl(p) {
            a = removeVietnameseTones(p);
            return a.replace(/\s+/g, "-").toLowerCase();
        }

        function colAction(index) {
            return '<td class="table-actions"><a href="#!" class="table-action" data-toggle="modal" data-original-title="Accept User" data-target="#editModal" data-whatever="' +
                index + '"><i class="fas fa-edit"></i></a>' +
                '<a href="#" class="table-action table-action-delete" data-toggle="modal" data-original-title="Delete Tag" data-target="#deleteModal" data-whatever=\"' +
                index + '\"><i class="fas fa-trash"></i></a></td>';
        }
    </script>

@endpush
