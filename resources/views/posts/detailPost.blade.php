<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Admin</title>
    <link href="{{ url('/') }}/img/logo/TF.png" rel="icon" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('/') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css"
        type="text/css">

    <link rel="stylesheet" href="{{ url('/') }}/vendor/select2/dist/css/select2.min.css">

    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/css/admin.css" type="text/css">
    <script src="{{ url('/') }}/js/app.js" defer></script>

    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/vendor/image-cropper/css/style.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/vendor/image-cropper/css/jquery.Jcrop.min.css" />

    {{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}

</head>

<body style="">
    <div class="main-content " id="panel">
        <!-- Page content -->
        <div class="container-fluid ">
            <div class="card">
                <div class="row" style="height: 100vh">
                    {{-- Custom Detail Post --}}
                    <div class="col-xl-3 order-xl-2 " style="height: 100vh">
                        <div class="card " style="height: 100vh">
                            <div class="card-header" id="cardHearder">
                                <h3 class="mb-0">Post Detail </h3>
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
                                                    <select name="" id="" class="btn btn-sm" select="Public"
                                                        style="box-shadow: none;">
                                                        <option value="Drafts">Drafts</option>
                                                        <option value="Public">Public</option>
                                                    </select>
                                                </div>
                                                <div class="w-100">
                                                    <label for="" class="col-form-label">Create Time: </label>
                                                    <span>{{ date('Y/m/d H:i:s') }}</span>
                                                </div>
                                                <button class="btn btn-danger btn-sm"> Move to trash</button>
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
                                                aria-describedby="slug Post" placeholder="Enter slug" required>
                                            <small id="urlPost" class="form-text text-muted"></small>
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
                                            <input type="text" id="slugCategory" value="" hidden>
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

                                                    <input type="text" value="" class="border-0 shadow-none p-1" list="tag-list-available" />
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
                                            <div id="imageInput" class="cursor-pointer"
                                                style="height: auto; width: 100%;">
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
                                            <textarea name="excerpt" id="" cols="30" rows="1"
                                                class="form-control textareaInput"></textarea>
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

                    {{-- Tags List --}}
                    <div class="col-xl-9 order-xl-1 scroll h-100" style="height: 100vh">
                        <!-- Card header -->
                        <div class="card-header">
                            <textarea name="" id="inputTitlePost" cols="30" rows="1"
                                class="form-control border-0 shadow-none font-weight-bold textareaInput"
                                placeholder="Title"></textarea>
                        </div>

                        <div class="table-responsive" id="divTinymce">
                            <textarea id="postContent"></textarea>
                        </div>

                    </div>
                </div>
            </div>
        </div>

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
        .border-0{
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
    {{-- <script src="{{ url('/') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{ url('/') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="{{ url('/') }}/vendor/select2/dist/js/select2.min.js"></script>
    <script src="{{ url('/') }}/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script> --}}

    <script type="text/javascript" src="{{ url('/') }}/vendor/image-cropper/scripts/jquery.Jcrop.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/vendor/image-cropper/scripts/jquery.SimpleCropper.js"></script>

    <script
        src="https://cdn.tiny.cloud/1/pao7pcxj39wj2sh92diz9jtbf9njkfrqnlezjckjtrsz891m/tinymce/5.10.3-128/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script src="{{ url('/') }}/js/admin/categoriesManage.js"></script>
    <script src="{{ url('/') }}/js/admin/detailPost.js"></script>

    {{-- <script src="{{ url('/') }}/js/argon.js?v=1.1.0 "></script> --}}
    <script src="{{ url('/') }}/js/demo.min.js"></script>

    <script>
        setHeightDetailPost();
        var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

        tinymce.init({
            selector: 'textarea#postContent',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_class_list: [{
                    title: 'None',
                    value: ''
                },
                {
                    title: 'Some class',
                    value: 'class-name'
                }
            ],
            importcss_append: true,
            file_picker_callback: function(callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', {
                        text: 'My text'
                    });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', {
                        alt: 'My alt text'
                    });
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', {
                        source2: 'alt.ogg',
                        poster: 'https://www.google.com/logos/google.jpg'
                    });
                }
            },
            templates: [{
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {
                    title: 'Starting my story',
                    description: 'A cure for writers block',
                    content: 'Once upon a time...'
                },
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: heightPostDiv,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>

    <script>

    </script>
</body>

</html>
