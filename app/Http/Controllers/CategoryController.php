<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = new Category;
        $category->name = $validatedData['cateogoryName'];
        $category->slug = Str::slug($validatedData['categorySlug']);
        $category->description = $validatedData['categoryDescription'];

        if ($request->hasFile('categoryImage'))
        {
            $file = $request->file('categoryImage');
            $ext = $file->getClientOriginalExtension();
            $filename = time().".".$ext;

            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }

        $category->meta_title = $validatedData['categoryMetaTitle'];
        $category->meta_keyword = $validatedData['categoryMetaKeyword'];
        $category->meta_description = $validatedData['categoryMetaDescription'];

        $category->status = $validatedData['categoryStatus'];

        try{
            $category->save();
        }
        catch(\Exception $e) {
            report($e);
            return redirect()->back()->with('error', 'somthing went wrong');
        }
        return redirect(route('category'))->with('message', 'Category added successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

    public function update(CategoryFormRequest $request, Category $category)
    {
        $validatedData = $request->validated();

        // $category = Category::findOrFail($category);
        $category->name = $validatedData['cateogoryName'];
        $category->slug = Str::slug($validatedData['categorySlug']);
        $category->description = $validatedData['categoryDescription'];

        if ($request->hasFile('categoryImage'))
        {
            $path = 'uploads/category/'.$category->image;
            if(File::exists($path))
            {
                File::delete($path);
            }

            $file = $request->file('categoryImage');
            $ext = $file->getClientOriginalExtension();
            $filename = time().".".$ext;

            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }

        $category->meta_title = $validatedData['categoryMetaTitle'];
        $category->meta_keyword = $validatedData['categoryMetaKeyword'];
        $category->meta_description = $validatedData['categoryMetaDescription'];

        $category->status = $validatedData['categoryStatus'];

        try{
            $category->update();
        }
        catch(\Exception $e) {
            report($e);
            return redirect()->back()->with('error', 'somthing went wrong');
        }
        return redirect(route('category'))->with('message', 'Category updated successfully');
    }

    public function delete(Category $category)
    {
        dd ($category);
    }
}
