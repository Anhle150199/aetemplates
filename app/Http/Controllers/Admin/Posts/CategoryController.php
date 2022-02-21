<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function showCategory(Request $request)
    {
        return view('posts.category', ['slidebar' => ['posts', 'categories']]);
    }

    public function getAllCategories(Request $request)
    {
        try {
            $categories = Category::all();
        } catch (\Throwable $th) {
            return new JsonResponse(['errors' => 'Have error when get data'], 422);
        }
        return new JsonResponse(['categories' => $categories], 200);
    }

    public function addCategory(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'cate_name' => ['required', 'string', 'max:100'],
                'cate_slug' => ['required', 'string', 'max:100', 'unique:ae_categories'],
                'parent_id' => ['required'],
            ]
        );
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 422);
        } else {
            try {
                $newCategory = new Category();
                $newCategory->cate_name = $request->cate_name;
                $newCategory->cate_slug = $request->cate_slug;
                $newCategory->parent_id = $request->parent_id;

                if ($request->parent_id != 0) {
                    $parent = Category::where('id', $request->parent_id)->first();
                    $parent->children_count = $parent->children_count + 1;
                    $parent->save();
                }
                $newCategory->posts_count = 0;
                $newCategory->save();
            } catch (\Throwable $th) {
                return new JsonResponse(['errors' => 'Have error when insert data',], 422);
            }
            return new JsonResponse(['newCategory' => $newCategory], 200);
        }
    }

    public function editCategory(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'cate_name' => ['required', 'string', 'max:100'],
                'cate_old_slug' => ['required', 'string', 'max:100'],
                'cate_slug' => ['required', 'string', 'max:100', 'unique:ae_categories'],
                'parent_id' => ['required'],
            ]
        );
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->toArray()], 422);
        } else {
            $editCate = Category::where('cate_slug', $request->cate_old_slug)->first();
            if ($editCate == null) {
                return new JsonResponse(['errors' => 'Haven\'t object to edit'], 422);
            }
            try {
                if ($editCate->parent_id != 0) {

                    $oldParentCate = Category::where('id', $editCate->parent_id)->first();
                    $oldParentCate->children_count -= 1;
                    $oldParentCate->save();
                }

                $editCate->cate_name = $request->cate_name;
                $editCate->cate_slug = $request->cate_slug;
                $editCate->parent_id = $request->parent_id;

                if ($request->parent_id != 0) {
                    $newParentCate = Category::where('id', $request->parent_id)->first();
                    $newParentCate->children_count += 1;
                    $newParentCate->save();
                }
                $editCate->save();
            } catch (\Throwable $th) {
                return new JsonResponse(['errors' => 'Have error when edit data',], 422);
            }
            return new JsonResponse(["cateEdit" => $editCate], 200);
        }
    }

    public function deleteCategory(Request $request)
    {
        $deleteCate = Category::where('cate_slug', $request->cate_slug)->first();
        if ($deleteCate == null) {
            return new JsonResponse(['errors' => 'Haven\'t object to delete'], 406);
        }
        try {
            if ($deleteCate->parent_id != 0) {

                $parentCate = Category::where('id', $deleteCate->parent_id)->first();
                $parentCate->children_count -= 1;
                $parentCate->save();
            }
            if ($deleteCate->children_count > 0) {
                $this->deleteChildCate($deleteCate->id);
            }
            $idDelete = $deleteCate->id;
            $deleteCate->delete();
        } catch (\Throwable $th) {
            return new JsonResponse(['errors' => 'Error when delete'], 406);
        }
        return new JsonResponse(['idDelete' => $idDelete], 200);
    }

    public function deleteChildCate(int $parentId)
    {
        $childCate = Category::where('parent_id', $parentId)->get();
        foreach ($childCate as $category) {
            $children_count = $category->children_count;
            $id = $category->id;
            $category->delete();
            if ($children_count > 0)
                $this->deleteChildCate($id);
        }
    }
}
