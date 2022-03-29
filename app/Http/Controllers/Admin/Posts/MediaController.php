<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Admin\Posts\PostController;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    // get all image
    public function getAllImage()
    {
        $images = Image::all();
        return view('medias', ['slidebar' => ['media'],'images'=>$images]);
    }

    // upload image
    public function uploadImange(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'ssImage' => 'required|string|regex: /^image+[0-9]+$/'
            ]
        );
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 419);
        } else {
            try {
                if (Session::has($request->ssImage) == false) {
                    session(["ssImage" => []]);
                }
                $file = $request->file('file');
                $fileName = $file->getClientOriginalName();
                if (in_array($fileName, Session::get($request->ssImage))) {
                    return response()->json(['location' => "/storage/images/" . $fileName]);
                }
                $fileName = $this->saveImage($file, 'image');
                Session::push($request->ssImage, $fileName);
            } catch (\Throwable $th) {
                return new JsonResponse(['errors' => 'Have error when upload image'], 419);
            }
            return response()->json(['location' => url('/') . "/storage/images/" . $fileName]);
        }
    }

    public function saveImage($file, $typeImg)
    {
        $fileName = $file->getClientOriginalName();
        $fileExt = $file->getClientOriginalExtension();
        if ($fileExt == "") {
            $fileName = $fileName . '.jpg';
        }
        while (file_exists("storage/images/" . $fileName)) {
            $fileName = $typeImg . strtotime("now") . $fileExt;
        }
        $newImage = new Image();
        $newImage->img_name = $fileName;
        $newImage->save();
        $file->move('storage/images/', $fileName);
        return $fileName;
    }
}
