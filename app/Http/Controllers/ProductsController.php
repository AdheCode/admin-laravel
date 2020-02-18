<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductsController extends Controller
{

    public function addProduct (Request $request) {
		if ($request->isMethod('post')) {
    		$data = $request->all();

    		// dd($data);

    		$product = new Product;
    		$product->category_id = $data['category_id'];
    		$product->product_name = $data['product_name'];
    		$product->product_code = $data['product_code'];
    		$product->product_color = $data['product_color'];
    		$product->description = $data['description'];
    		$product->price = $data['price'];

            if ($request->hasFile('image')) {
            	$image_tmp = Input::file('image');
            	if ($image_tmp->isValid()) {
            		$extension = $image_tmp->getClientOriginalExtension();
            		$filename = rand(111,99999).'.'.$extension;
            		$large_image_path = 'images/backend_images/products/large/'.$filename;
            		$medium_image_path = 'images/backend_images/products/medium/'.$filename;
            		$small_image_path = 'images/backend_images/products/small/'.$filename;

            		//Resize Images
            		Image::make($image_tmp)->save($large_image_path);
            		Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
            		Image::make($image_tmp)->resize(300,300)->save($small_image_path);

            		$product->image = $filename;
            	}
            }

    		$product->save();
            return redirect('/admin/view-products')->with('flash_message_success', 'Add Product Successfully.');
		}

    	$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option value='' selected disabled>Select</option>";
    	foreach ($categories as $cat) {
    		$categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
    		$sub_categories = Category::where(['parent_id'=> $cat->id])->get();
    		foreach ($sub_categories as $sub_cat) {
    			$categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
    		}
    	}

    	// dd($categories_dropdown);

    	return view('admin.products.add-product')->with(compact('categories_dropdown'));
    }

    public function editProduct (Request $request, $id = null) {
        $productDetails = Product::where(['id'=>$id])->first();

        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $cat) {
            $categories_dropdown .= "<option value='".$cat->id."' ";
            $categories_dropdown .= ($productDetails['category_id'] == $cat->id) ? 'selected' : '';
            $categories_dropdown .= ">".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=> $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value='".$sub_cat->id."' ";
                $categories_dropdown .= ($productDetails['category_id'] == $sub_cat->id) ? 'selected' : '';
                $categories_dropdown .= ">&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }

        return view('admin.products.edit-product')->with(['productDetails' => $productDetails, 'categories_dropdown' => $categories_dropdown]);
    }

    public function viewProducts () {
        $products = Product::get();
        $products = json_decode(json_encode($products));
        foreach ($products as $key => $value) {
            $category_name = Category::where(['id'=> $value->category_id])->first();
        // dd($category_name);
            $products[$key]->category_name = $category_name->name;
        }

        return view('admin.products.view_products')->with(compact('products'));
    }
}
