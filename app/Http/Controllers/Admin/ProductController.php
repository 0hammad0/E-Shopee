<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use Throwable;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index');
    }

    public function createProduct()
    {
        return view('admin.product.create', [
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }

    public function editProduct()
    {
        return view('admin.product.edit');
    }

    public function createstore(ProductFormRequest $request)
    {
        $validatedData = $request->validated();

        try{
            $category = Category::findOrFail($validatedData['category']);

            $product = $category->products()->create([
                'category_id' => $validatedData['category'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'brand' => $validatedData['brand'],
                'small_description' => $validatedData['small_description'],
                'description' => $validatedData['description'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' => $request->trending == true ? '1' : '0',
                'status' => $request->status == true ? '1' : '0',
                'meta_title' => $validatedData['meta_title'],
                'meta_keyword' => $validatedData['meta_keyword'],
                'meta_description' => $validatedData['meta_description'],
            ]);

            if ($request->hasFile('image'))
            {
                $uploadPath = 'uploads/products/';

                foreach ($request->file('image') as $imageFile)
                {
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time().rand(1,10).'.'.$extension;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath.$filename;

                    $product->ProductImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }
        }catch(Throwable $e) {
            return redirect(route('product'))->with('error', 'Product could not be added');
        }

        return redirect(route('product'))->with('message', 'Product Added Successfully');
    }
}
