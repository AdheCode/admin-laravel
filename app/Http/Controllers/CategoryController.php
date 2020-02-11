<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function addCategory(Request $request){
		if ($request->isMethod('post')) {
    		$data = $request->all();

    		$category = new Category;
    		$category->name = $data['category_name'];
    		$category->description = $data['description'];
    		$category->url = $data['url'];
            $category->parent_id = $data['parent_id'];
    		$category->save();
            return redirect('/admin/view-categories')->with('flash_message_success', 'Add Category Successfully.');
		}

        $levels = Category::where(['parent_id'=>0])->get();

		return view('admin.categories.add_category')->with(compact('levels'));
	}

    public function viewCategories () {
        $categories = Category::get();
        return view('admin.categories.view_categories')->with(compact('categories'));
    }

    public function editCategory (Request $request, $id = null) {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $category['name']        = $data['category_name'];
            $category['description'] = $data['description'];
            $category['url']         = $data['url'];
            $category['parent_id']   = $data['parent_id'];

            Category::where(['id'=>$id])->update($category);

            return redirect('/admin/view-categories')->with('flash_message_success', 'Update Category Successfully.');
        }

        $category = Category::where(['id'=>$id])->first();

        $levels = Category::where(['parent_id'=>0])->get();
        // dd($category);
        return view('admin.categories.edit_category')->with(['category' => $category, 'levels' => $levels]);

    }

    public function deleteCategory ($id = null) {
        if (!empty($id)) {
            $categories = Category::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Delete Category Successfully.');
        }
    }
}
