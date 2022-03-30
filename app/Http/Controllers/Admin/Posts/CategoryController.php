<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryRelationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function showCategory(Request $request)
    {
        return view('posts.category', ['slidebar' => ['posts', 'categories']]);
    }

    // API get all category
    public function getAllCategories(Request $request)
    {
        try {
            $categories = Category::orderBy('parent_id', 'asc')->get();
            foreach ($categories as $category) {
                $postCount = CategoryRelationship::where('cate_id', $category->id)->count();
                $category->posts_count = $postCount;
                $category->save();
            }
        } catch (\Throwable $th) {
            return new JsonResponse(['errors' => 'Have error when get data'], 422);
        }
        return new JsonResponse(['categories' => $categories], 200);
    }

    // Add Category
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
            try {
                $this->updateMenu();
            } catch (\Throwable $th) {
                return new JsonResponse(['errors' => $th], 419);
            }
            return new JsonResponse(['newCategory' => $newCategory], 200);
        }
    }

    // Edit Category
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

                if ($editCate->children_count > 0) {
                    foreach ($request->child as $child) {
                        $childCate = Category::where('id', $child['id'])->first();
                        $childCate->cate_slug = $child['slug'];
                        $childCate->save();
                    }
                }
                $editCate->save();
            } catch (\Throwable $th) {
                return new JsonResponse(['errors' => 'Have error when edit data',], 422);
            }
            try {
                $this->updateMenu();
            } catch (\Throwable $th) {
                return new JsonResponse(['errors' => $th], 419);
            }
            return new JsonResponse(["cateEdit" => $editCate], 200);
        }
    }

    // Delete Category
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
        try {
            $this->updateMenu();
        } catch (\Throwable $th) {
            return new JsonResponse(['errors' => $th], 419);
        }
        return new JsonResponse(['idDelete' => $idDelete], 200);
    }

    // Recursive child delete
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

    public function updateMenu()
    {
        $categories = Category::all();
        $startMenu = '<div class="main-menu d-none d-md-block"><nav><ul id="navigation"><li><a href="' . url('/') . '">Home</a></li>';
        $startMenu = $this->printItemMenu($categories, 0, $startMenu);
        $menu = $startMenu . "</ul></nav></div>";
        DB::table('ae_system')->where('system_key', 'menu_html')->update(['system_value' => $menu]);
    }

    public function printItemMenu($data, $parentId, $text)
    {
        foreach ($data as $key => $category) {
            if ($category->parent_id == $parentId && $category->children_count > 0) {

                $text = $text . "<li><a href=" . url('/') . "/category" . $category->cate_slug . ">" . $category->cate_name . '</a><ul class="submenu">';

                $text = $this->printItemMenu($data, $category->id, $text);
                $text = $text . "</ul></li>";
            } else if ($category->parent_id == $parentId && $category->children_count == 0) {

                $text = $text . "<li><a href=" . url('/') . "/category" . $category->cate_slug . ">" . $category->cate_name . "</a></li>";

                $text = $this->printItemMenu($data, $category->id, $text);
            }
        }
        return $text;
    }
}
