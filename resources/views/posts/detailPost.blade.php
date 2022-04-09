<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - Admin | {{ $status }} Post</title>
    <link href="{{ url('/') }}/img/logo/favicon.ico" rel="icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('/') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css"
        type="text/css">

    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/css/admin.css" type="text/css">
    <script src="{{ url('/') }}/js/app.js" defer></script>

    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/vendor/image-cropper/css/style.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/vendor/image-cropper/css/jquery.Jcrop.min.css" />

</head>

<body style="">
    <div class="main-content " id="panel" data-type="{{ $status }}" data-id="{{ $session }}">
        <div class="container-fluid ">
            <div class="card">
                <div class="row" style="height: 100vh">
                    <div class="col-xl-3 order-xl-2 " style="height: 100vh">
                        <div class="card " style="height: 100vh">
                            <div class="card-header d-flex justify-content-between align-items-center" id="cardHearder">
                                <h3 class="mb-0 ">{{ $status }} Post</h3>
                                <div class="">
                                    <button type="button" class="btn btn-success btn-sm" id="submit-post">
                                        @if ($status == 'New')
                                            Pushlist
                                        @else
                                            Update
                                        @endif
                                    </button>
                                    <a href="{{ route('all-post') }}" class="btn btn-danger btn-sm">Back
                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="card-body" id="detail" style="padding: 0; overflow-y: auto">
                                {{-- Status & Visibility --}}
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <button class="btn btn-link w-100 text-left">
                                                Status & Visibility
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="card-body" style="padding: 0.5rem 1.5rem;">
                                            <div class="text-sm ">
                                                <div class="w-100">
                                                    <label for="visibility" class="col-form-label">Visibility: </label>
                                                    <select name="" id="post-type" class="btn btn-sm"
                                                        style="box-shadow: none;">
                                                        @if ($status == 'Edit' && $editPost->post_type == 'Drafts')
                                                            <option value="Drafts" selected>Drafts</option>
                                                            <option value="Public">Public</option>
                                                        @else
                                                            <option value="Drafts">Drafts</option>
                                                            <option value="Public" selected>Public</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="w-100">
                                                    <label for="" class="col-form-label">Create Time: </label>
                                                    <span id="post-created-at">
                                                        @if ($status == 'New')
                                                            {{ date('Y-m-d H:i:s') }}
                                                        @else
                                                            {{ $editPost->created_at }}
                                                        @endif
                                                    </span>
                                                </div>
                                                <a class="btn btn-danger btn-sm text-white" id="remove-post"
                                                    @if ($status == 'New') style="display: none;"
                                                @else
                                                    data-id="{{ $editPost->id }}" @endif>
                                                    Move to trash</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- URL Link --}}
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0 collapsed " data-toggle="collapse" data-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            <button class="btn btn-link w-100 text-left">
                                                URL Link
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordion">
                                        <div class="card-body text-sm">
                                            <label for="slugPost">Slug Post</label>
                                            <input type="text" class="form-control form-control-sm" id="slugPost"
                                                aria-describedby="slug Post" placeholder="Enter slug" required
                                                @if ($status == 'Edit') <?php $postSlug = explode('/', $editPost->post_slug); ?>
                                                value="{{ $postSlug[sizeof($postSlug) - 1] }}" @endif>
                                            <small id="urlPost" class="form-text text-muted">
                                                @if ($status == 'Edit')
                                                    Link post: <a href="{{url('/') .'/post'. $editPost->post_slug}}"> {{url('/') . '/post'. $editPost->post_slug }}</a>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                {{-- Categories --}}
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0 collapsed " data-toggle="collapse" data-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            <button class="btn btn-link w-100 text-left">
                                                Categories
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <select class="form-control selectCateParent" id="selectCateParent"
                                                name="selectCateParent">
                                                <option value="0">None</option>
                                            </select>
                                            <input type="text" id="slugCategory"
                                                @if ($status == 'Edit' && $category) value="{{ $category->cate_slug }}" @endif
                                                hidden>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tags --}}
                                <div class="card">
                                    <div class="card-header" id="heading4">
                                        <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse4"
                                            aria-expanded="false" aria-controls="collapse4">
                                            <button class="btn btn-link w-100 text-left">
                                                Tag
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapse4" class="collapse" aria-labelledby="heading4"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="" tabindex="-1"><label for="input-tag">Add New
                                                    Tag</label>
                                                <div class="form-control" id="input-tag" style="height: auto;">
                                                    @if ($status == 'Edit' && $tags)
                                                        @foreach ($tags as $tag)
                                                            <small class="bg-warning p-1 m-1 text-white rounded old-tag"
                                                                id="{{ $tag->tag_slug }}">{{ $tag->tag_name }}<i
                                                                    class="fa fa-times p-1 ml-1 cursor-pointer"
                                                                    aria-hidden="true"
                                                                    onClick='removeTag("{{ $tag->tag_slug }}", "oldTagEdit")'></i></small>
                                                        @endforeach
                                                    @endif
                                                    <input type="text" value="" class="border-0 shadow-none p-1"
                                                        list="tag-list-available" />
                                                    <datalist id="tag-list-available">
                                                    </datalist>
                                                </div>
                                                <input type="text" id="input-tag-list" hidden value=""
                                                    data-toggle="tags" />
                                                <small>Separate with the Enter key and max tags is 10</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- post Image --}}
                                <div class="card">
                                    <div class="card-header" id="heading5" data-toggle="collapse"
                                        data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                        <h5 class="mb-0 collapsed">
                                            <button class="btn btn-link w-100 text-left">
                                                Image Post
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapse5" class="collapse" aria-labelledby="heading5"
                                        data-parent="#accordion">
                                        <div class="card-body justify-content-center d-flex align-items-center"
                                            id="imagePostBody">
                                            <input type="file" id="post-thumbnail" hidden />
                                            <div id="imageInput" class="cursor-pointer"
                                                style="height: auto; width: 100%;">
                                                <img @if ($status == 'Edit') src="{{ url('/') . '/storage/images/' . $editPost->post_thumbnail }}" @endif
                                                    style="width: 100%;" alt="">
                                            </div>
                                            <div class="cropme" hidden style="height: 405px; width: 720px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- post excerpt --}}
                                <div class="card">
                                    <div class="card-header" id="heading6" data-toggle="collapse"
                                        data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                        <h5 class="mb-0 collapsed">
                                            <button class="btn btn-link w-100 text-left">
                                                Excerpt
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapse6" class="collapse" aria-labelledby="heading6"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <textarea name="excerpt" id="post-excerpt" cols="30" rows="1" class="form-control textareaInput">
@if ($status == 'Edit')
{{ $editPost->post_excerpt }}
@endif
</textarea>
                                            <small>Enter Excerpt for your post</small>
                                        </div>
                                    </div>
                                </div>
                                {{-- Group card --}}
                                <div id="accordion">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Post --}}
                    <div class="col-xl-9 order-xl-1 scroll h-100" style="height: 100vh">
                        <!-- post title -->
                        <div class="card-header">
                            <textarea name="" id="inputTitlePost" cols="30" rows="1"
                                class="form-control border-0 shadow-none font-weight-bold textareaInput"
                                placeholder="Title">
@if ($status == 'Edit')
{{ $editPost->post_title }}
@endif
</textarea>
                        </div>

                        {{-- post content --}}
                        <div class="table-responsive" id="divTinymce">
                            <form action="" method="post">
                                <textarea id="postContent" hidden>
                                    @if ($status == 'Edit')
{{ $editPost->post_content }}
@else
<p><span style="font-size: 14pt; font-family: helvetica, arial, sans-serif; background-color: #ffffff; color: #34495e;"><strong><span style="padding: 0px; margin: 0px; outline: none; list-style: none; border: 0px none; box-sizing: border-box;">Videohive </span><span style="padding: 0px; margin: 0px; outline: none; list-style: none; border: 0px none; box-sizing: border-box;">Wedding Photos Beautiful Slideshow 36649400 Free Download Premiere Pro Templates</span></strong></span></p>
<blockquote>
<p><span style="font-size: 14pt; font-family: helvetica, arial, sans-serif; background-color: #ffffff; color: #34495e;"><strong style="padding: 0px; margin: 0px; outline: none; list-style: none; border: 0px none; box-sizing: border-box;"><span style="font-weight: 400;">Premiere Pro CC, After Effects CC | 1920&times;1080 | 636 Mb</span><br style="padding: 0px; margin: 0px; outline: none; list-style: none; border: 0px none; box-sizing: border-box; font-weight: 400;" /><strong style="padding: 0px; margin: 0px; outline: none; list-style: none; border: 0px none; box-sizing: border-box;">Preview Page:</strong><a style="padding: 0px; margin: 0px; outline: none; list-style: none; border: 0px none; box-sizing: border-box; color: #34495e; transition: all 0.2s ease-in-out 0s; font-weight: 400; background-color: #ffffff;" href="https://videohive.net/item/wedding-photos-beautiful-slideshow/36649400">https://videohive.net/item/wedding-photos-beautiful-slideshow/36649400</a></strong></span></p>
</blockquote>
<p style="padding: 0px; margin: 0px 0px 20px; outline: none; list-style: none; border: 0px none; box-sizing: border-box; color: #333333; font-family: 'Droid Sans', Arial, Verdana, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;"><span style="font-size: 14pt; font-family: helvetica, arial, sans-serif; background-color: #ffffff; color: #34495e;"><strong style="padding: 0px; margin: 0px; outline: none; list-style: none; border: 0px none; box-sizing: border-box;">Preview Project:</strong></span></p>
<p style="padding: 0px; margin: 0px 0px 20px; outline: none; list-style: none; border: 0px none; box-sizing: border-box; color: #333333; font-family: 'Droid Sans', Arial, Verdana, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: center; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;"><video style="width: 506px; height: 253px;" controls="controls" width="1280" height="720">
                                        <source src="https://previews.customer.envatousercontent.com/h264-video-previews/865c6b90-50d6-4386-9298-488bd7418b92/36649400.mp4" type="video/mp4" /></video></p>
<p style="padding: 0px; margin: 0px 0px 20px; outline: none; list-style: none; border: 0px none; box-sizing: border-box; color: #333333; font-family: 'Droid Sans', Arial, Verdana, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: center; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;">&nbsp;</p>
<h2 id="item-description__project-features" style="box-sizing: border-box; margin: 0px 0px 20px; padding: 0px 0px 10px; color: #545454; font-weight: inherit; font-size: 20px; line-height: 30px; border-bottom: 1px solid #d4d4d4;"><span style="background-color: #ffffff; color: #34495e; font-size: 14pt;">Project features:</span></h2>
<ul style="box-sizing: border-box; list-style-position: initial; list-style-image: initial; margin: 0px; padding: 0px 0px 0px 35px;">
<li style="box-sizing: border-box; color: #545454; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px;"><span style="background-color: #ffffff; color: #34495e; font-size: 14pt;">No plugins required</span></li>
<li style="box-sizing: border-box; color: #545454; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px;"><span style="background-color: #ffffff; color: #34495e; font-size: 14pt;">Premiere Pro 2021 and above</span></li>
<li style="box-sizing: border-box; color: #545454; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px;"><span style="background-color: #ffffff; color: #34495e; font-size: 14pt;">Full HD resolution</span></li>
<li style="box-sizing: border-box; color: #545454; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px;"><span style="background-color: #ffffff; color: #34495e; font-size: 14pt;">Video tutorial included</span></li>
<li style="box-sizing: border-box; color: #545454; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px;"><span style="background-color: #ffffff; color: #34495e; font-size: 14pt;">All images used in the preview video are licensed for commercial use (<a style="box-sizing: border-box; color: #34495e; background-color: #ffffff;" href="https://unsplash.com/" rel="nofollow">unsplash.com</a>)</span></li>
<li style="box-sizing: border-box; color: #545454; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px;"><span style="background-color: #ffffff; color: #34495e; font-size: 14pt;"><a style="background-color: #ffffff; color: #34495e;" href="https://audiojungle.net/item/wedding-piano/6730328?_ga=2.144128245.1996835178.1647530701-1687734910.1636436684">Music&nbsp;</a>not included</span></li>
</ul>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;"><span style="font-size: 14pt; background-color: #ffffff; color: #34495e;"><strong>Download</strong></span></p>
<p style="text-align: center;"><span style="font-size: 14pt;"><a class="btn text-white" href="https://prefiles.com/p4hnpz7i5ylx">Download File</a></span></p>@endif
                                </textarea>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- Success Modal --}}
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="width: 65%;margin: auto;">
                    <div class="modal-body row text-success" style="font-style: oblique;font-weight: 900;">
                        <div class="col-4 text-right">
                            <i class="fas fa-check-circle" style="font-size: 4rem;"></i>
                        </div>
                        <div class="col-7 d-flex align-items-center text-success" name="successModal"
                            style='font-size: 1.5rem;'>
                            Success !
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Success Modal --}}
        {{-- Error Modal --}}
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-danger d-flex justify-content-around"
                        style="font-style: oblique;font-weight: 700;">
                        <div class="col-4 d-flex align-items-center justify-content-around text-right">
                            <i class="fas fa-exclamation-triangle" style="font-size: 4rem;"></i>
                        </div>
                        <div class="col-7  " name="errorModal">
                            <h1 class="text-danger">Error!!</h1>
                            <div id="statusError">
                                <ul></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Error Modal --}}
    </div>
    <style>
        .card {
            margin: 0;
        }

        .card-header {
            padding: 0;
        }

        #inputTitlePost {
            font-size: 20px;
        }

        #cardHearder {
            padding: 1.2rem;
        }

        #input-tag {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        #input-tag>input {
            flex: 1;
            display: inline-block;
            min-width: 20%;
        }

        input::-webkit-picker-indicator {
            display: none;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        textarea {
            resize: none;
        }

        .border-0 {
            outline: none;

        }

        /* For other boilerplate styles, see: /docs/general-configuration-guide/boilerplate-content-css/ */
        /*
        * For rendering images inserted using the image plugin.
        * Includes image captions using the HTML5 figure element.
        */

        figure.image {
            display: inline-block;
            border: 1px solid gray;
            margin: 0 2px 0 1px;
            background: #f5f2f0;
        }

        figure.align-left {
            float: left;
        }

        figure.align-right {
            float: right;
        }

        figure.image img {
            margin: 8px 8px 0 8px;
        }

        figure.image figcaption {
            margin: 6px 8px 6px 8px;
            text-align: center;
        }


        img.align-left {
            float: left;
        }

        img.align-right {
            float: right;
        }

        /* Basic styles for Table of Contents plugin (toc) */
        .mce-toc {
            border: 1px solid gray;
        }

        .mce-toc h2 {
            margin: 4px;
        }

        .mce-toc li {
            list-style-type: none;
        }

    </style>
    <script src="{{ url('/') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('/') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/vendor/js-cookie/js.cookie.js"></script>

    <script type="text/javascript" src="{{ url('/') }}/vendor/image-cropper/scripts/jquery.Jcrop.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/vendor/image-cropper/scripts/jquery.SimpleCropper.js"></script>

    <script src="{{ url('/') }}/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="{{ url('/') }}/js/admin/categoriesManage.js"></script>
    <script src="{{ url('/') }}/js/admin/detailPost.js"></script>

    <script src="{{ url('/') }}/js/demo.min.js"></script>

    <script>
        setHeightDetailPost();
        var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

        tinymce.init({
            selector: 'textarea#postContent',
            plugins: 'preview importcss searchreplace autolink autosave directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            // menubar: 'file edit view insert format tools table help',
            menu: {
                file: {
                    title: 'File',
                    items: 'newdocument restoredraft | preview | print '
                },
                edit: {
                    title: 'Edit',
                    items: 'undo redo | cut copy paste | selectall | searchreplace'
                },
                view: {
                    title: 'View',
                    items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen'
                },
                insert: {
                    title: 'Insert',
                    items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime'
                },
                format: {
                    title: 'Format',
                    items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align lineheight | forecolor backcolor | removeformat'
                },
                tools: {
                    title: 'Tools',
                    items: 'spellchecker spellcheckerlanguage | code wordcount'
                },
                table: {
                    title: 'Table',
                    items: 'inserttable | cell row column | tableprops deletetable'
                },
                help: {
                    title: 'Help',
                    items: 'help'
                }
            },
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect  fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview print | insertfile image media link anchor blockquote | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            importcss_append: true,
            // images_upload_base_path: '/storage/images',
            images_upload_credentials: true,
            file_picker_types: 'image',
            images_upload_handler: function(blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/posts/upload-image');
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader("X-CSRF-Token", token);
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                formData.append('ssImage', ssImage);
                xhr.send(formData);
            },

            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                };
                input.click();
            },
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: '90vh',
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            // skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
    @if ($status == 'Edit')
        <script>
        </script>
    @endif
</body>

</html>
