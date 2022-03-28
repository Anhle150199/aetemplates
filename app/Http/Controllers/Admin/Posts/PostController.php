<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\Posts\MediaController;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\CategoryRelationship;
use App\Models\Image;
use App\Models\ImageRelationship;
use App\Models\TagRelationship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function getAllPost(Request $request)
    {
    }
    //
    public function getNewPost(Request $request)
    {
        $session = "image" . strtotime("now");
        session([$session => []]);
        return view('posts.detailPost', ['status' => 'New', 'session' => $session]);
    }

    // Add new post
    public function addNewPost(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'post_title' => ['required', 'string', 'max:150'],
                'post_excerpt' => ['required', 'string', 'max:1000'],
                'post_content' => ['required', 'string'],
                'post_type' => ['required', 'string', function ($attribute, $value, $fail) {
                    if (!in_array($value, ['Drafts', 'Public'])) {
                        return $fail(__('Post type valid!' . $value));
                    }
                }],
                'post_slug' => ['required', 'string', 'max:150', 'unique:ae_posts'],
                'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'created_at' => 'required|string',
                'cate_slug' => ['string', function ($attribute, $value, $fail) {
                    $checkCategory = Category::where('cate_slug', $value)->first();

                    if ($checkCategory == null) {
                        return $fail(__('Category is valid!' . $value));
                    }
                }],
                'tag_list.*.name' => 'string',
                'tag_list.*.slug' => 'string',
                'ssImage' => 'required| string| regex: /^image+[0-9]+$/',
            ]
        );
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 419);
        } else {
            $file = $request->file('file');
            $fileName = (new MediaController)->saveImage($file);
            $imageArr = Session::get($request->ssImage);
            array_push($imageArr, $fileName);
            try {
                $newPost = new Post();
                $newPost->user_id = Auth::user()->id;
                $newPost->post_title = $request->post_title;
                $newPost->post_excerpt = $request->post_excerpt;
                $newPost->post_content = $request->post_content;
                $newPost->post_type = $request->post_type;
                $newPost->post_slug = $request->post_slug;
                $newPost->post_thumbnail = $fileName;
                $newPost->post_views = 0;
                $newPost->created_at = $request->created_at;
                $newPost->updated_at = $request->created_at;
                $newPost->save();
            } catch (\Throwable $th) {
                return new JsonResponse(['errors' => ['Have error when pushlist post']], 419);
            }
            // process image
            try {
                $this->addImageRelation($imageArr, $newPost->id);
            } catch (\Throwable $th) {
                return new JsonResponse(['errors' => ['An error occurred while connecting the image to this post. But this post and image stored. Rest assured, the article will still work normally.']], 419);
            }
            // process category
            try {
                if ($request->has('cate_slug') == true) {
                    $this->addCategoryRelationship($request->cate_slug, $newPost->id);
                }
            } catch (\Throwable $th) {
                return new JsonResponse(['errors' => ['Have error when save category. Please update latter.']], 419);
            }

            // process tag
            try {
                $newTag = [];
                if ($request->has('tag_list') == true) {
                    $newTag = $this->addTagRelationship($request->tag_list, $newPost->id);
                }
            } catch (\Throwable $th) {
                return new JsonResponse(['errors' => [`Have error when save tag`]], 419);
            }
            session([$request->ssImage => []]);
            return response()->json(['newPost' => $newPost, 'newTag' => $newTag]);
        }
    }

    public function getEditPost($id)
    {
        $session = "image" . strtotime("now");
        session([$session => []]);

        $editPost = Post::where('id', $id)->first();
        $tags = TagRelationship::where('post_id', $editPost->id)->join('ae_tags', 'ae_tags.id', 'tag_id')->get();
        $category = CategoryRelationship::where('post_id', $editPost->id)->join('ae_categories', 'ae_categories.id', 'cate_id')->select('ae_categories.id', 'cate_name', 'cate_slug')->first();
        return view('posts.detailPost', ['status' => 'Edit', 'session' => $session, 'editPost' => $editPost, 'tags' => $tags, 'category' => $category]);
    }

    public function updatePost(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'post_id' => ['required', 'integer'],
                'post_title' => ['required', 'string', 'max:150'],
                'post_excerpt' => ['required', 'string', 'max:1000'],
                'post_content' => ['required', 'string'],
                'post_type' => ['required', 'string', function ($attribute, $value, $fail) {
                    if (!in_array($value, ['Drafts', 'Public'])) {
                        return $fail(__('Post type valid!' . $value));
                    }
                }],
                'post_slug' => ['required', 'string', 'max:150', /*'unique:ae_posts'*/],
                'file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'created_at' => 'required|string',
                'cate_slug' => ['string', function ($attribute, $value, $fail) {
                    $checkCategory = Category::where('cate_slug', $value)->first();

                    if ($checkCategory == null) {
                        return $fail(__('Category is valid!' . $value));
                    }
                }],
                'tag_list' => 'string',
                'tag_delete' => 'string',
                'ssImage' => 'required| string| regex: /^image+[0-9]+$/',
            ]
        );
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 419);
        } else {
            $editPost = Post::where('id', $request->post_id)->first();

            if ($editPost != null) {
                $editPost->post_title = $request->post_title;
                $editPost->post_excerpt = $request->post_excerpt;
                $editPost->post_content = $request->post_content;
                $editPost->post_type = $request->post_type;
                if ($editPost->post_slug != $request->post_slug) {
                    $checkSlug = Post::where('post_slug', $request->post_slug)->first();
                    if ($checkSlug != null) return new JsonResponse(['errors' => ['This slug post is must be unique!']], 419);
                    else $editPost->post_slug = $request->post_slug;
                }
            } else
                return new JsonResponse(['errors' => ['This post is not available on the server!']], 419);

            if ($request->has('file')) {
                $file = $request->file('file');
                $fileName = (new MediaController)->saveImage($file);
                $editPost->post_thumbnail = $fileName;
                ImageRelationship::where('post_id', $editPost->id)
                    ->where('img_name', 'regex', '^thumbnail([\w-]{8})+([0-9]{13,14}\.)+[a-zA-Z]{3,4}$')
                    ->update(['img_name' => $fileName]);
                $imageArr = Session::get($request->ssImage);
                try {
                    $this->addImageRelation($imageArr, $editPost->id);
                } catch (\Throwable $th) {
                    return new JsonResponse(['errors' => ['An error occurred while connecting the image to this post. But this post and image stored. Rest assured, the article will still work normally.']], 419);
                }
            }

            // process category
            if ($request->has('cate_slug')) {
                try {
                    $this->addCategoryRelationship($request->cate_slug, $editPost->id);
                } catch (\Throwable $th) {
                    return new JsonResponse(['errors' => ['An error occurred while connecting the category to this post. But this post and image stored.']], 419);
                }
            }

            $editPost->save();
            // process tag
            try {
                $newTag = [];
                if ($request->has('tag_delete') == true) {
                    $deleteTags = json_decode($request->tag_delete);
                    foreach ($deleteTags as $tag) {
                        TagRelationship::where('tag_id', $tag->id)->where('post_id', $editPost->id)->delete();
                    }
                }
                if ($request->has('tag_list') == true) {
                    $newTag = $this->addTagRelationship($request->tag_list, $editPost->id);
                }
            } catch (\Throwable $th) {
                return new JsonResponse(['errors' => [`Have error when save tag`]], 419);
            }

            session([$request->ssImage => []]);
            return new JsonResponse(['newTag' => $newTag], 419);
        }
    }

    public function getDetailPost(Request $request)
    {
    }

    public function deletePost(Request $request)
    {
    }

    public function addImageRelation($imageArr, $id)
    {
        $data = [];
        foreach ($imageArr as $image) {
            array_push($data, array('post_id' => $id, 'img_name' => $image));
        }
        ImageRelationship::insert($data);
    }

    public function addCategoryRelationship($slug, $id)
    {
        $category = Category::where('cate_slug', $slug)->first();
        CategoryRelationship::insert(['cate_id' => $category->id, 'post_id' => $id]);
    }

    public function addTagRelationship($tagListStr, $id)
    {
        $newTag = [];
        $tagIdArr = array();
        $tagSlugArr = array();
        $tags = Tag::all();
        foreach ($tags as $tag) {
            array_push($tagIdArr, $tag->id);
            array_push($tagSlugArr, $tag->tag_slug);
        }
        $tagList  = json_decode($tagListStr);
        foreach ($tagList as $addTag) {
            $arrKey = array_search($addTag->slug, $tagSlugArr);
            if ($arrKey == null) {
                $dataTag = ['tag_name' => $addTag->name, 'tag_slug' => $addTag->slug, 'posts_count' => 1];
                $tagId = Tag::insertGetId($dataTag);
                $dataTag = ['id' => $tagId, 'name' => $addTag->name, 'slug' => $addTag->slug, 'posts' => 1];
                array_push($newTag, (object)$dataTag);
            } else {
                $tagId = $tagIdArr[$arrKey];
            }
            TagRelationship::insert(['tag_id' => $tagId, 'post_id' => $id]);
        }

        return $newTag;
    }
}
