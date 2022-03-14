<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tag;

class TagController extends Controller
{
    public function showTag()
    {
        $tagList = Tag::all();
        return view('posts.tag', ['slidebar' => ['posts', 'tags'], 'tags' => $tagList]);
    }

    // API get all tags
    public function getAllTags()
    {
        try {
            $tags = Tag::orderBy('tag_name', 'asc')->get();
        } catch (\Throwable $th) {
            return new JsonResponse(['errors' => 'Have error when get data'], 422);
        }
        return new JsonResponse(['tags' => $tags], 200);
    }

    public function addTag(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'tag_name' => ['required', 'string', 'max:50', 'unique:ae_tags'],
                'tag_slug' => ['required', 'string', 'max:50', 'unique:ae_tags'],
            ]
        );
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 406);
        } else {
            try {
                $newTag = new Tag();
                $newTag->tag_name = $request->tag_name;
                $newTag->tag_slug = $request->tag_slug;
                $newTag->save();
            } catch (\Throwable $th) {
                return new JsonResponse(['errors' => 'Have error when insert data'], 406);
            }
            return new JsonResponse(['newTag' => $newTag], 200);
        }
    }

    public function editTag(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tag_name' => ['required', 'string', 'max:50', 'unique:ae_tags'],
                'tag_slug' => ['required', 'string', 'max:50', 'unique:ae_tags'],
                'slug_old_tag' => ['required', 'string', 'max:50'],
            ]
        );
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 422);
        } else {
            try {
                $tagEdit = Tag::where('tag_slug', $request->slug_old_tag)->first();
                $tagEdit->tag_name = $request->tag_name;
                $tagEdit->tag_slug = $request->tag_slug;
                $tagEdit->save();
            } catch (\Throwable $th) {
                return new JsonResponse(['errors' => ['other' => 'Have error when insert data']], 422);
            }
            return new JsonResponse(['tagEdit' => $tagEdit], 200);
        }
    }

    public function deleteTag(Request $request)
    {
        $checkTag = Tag::where('tag_slug', $request->tag_slug)->first();
        if ($checkTag == null) {
            return new JsonResponse(['errors' => 'Have error when delete tag'], 406);
        }
        try {
            $checkTag->delete();
        } catch (\Throwable $th) {
            return new JsonResponse(['errors' => 'Have error when delete tag'], 406);
        }
        return new JsonResponse(['success' => 'success'], 200);
    }
}
