<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $title = 'Category';
        $categories = Category::latest()->paginate(9);

        return view('dashboard.category.index', compact('title','categories'));
    }

    public function create(){
        $title = 'Create Category';
        return view('dashboard.category.create', compact('title'));
    }

    public function store(Request $request){
        $Validate = $request->validate([
            'name' => 'required|min:2|string|max:255|unique:categories',
            'slug' => 'required|string|max:255|unique:categories'
        ]);

        Category::create($Validate);
        return redirect('/dashboard/category')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category){
        $title = 'Edit Category';
        return view('dashboard.category.edit', compact('title','category'));
    }

    public function update(Request $request, Category $category){
        $rules = [
            'name' => 'required|min:2|string|max:255|',
        ];
        if ($request->slug != $category->slug){
            $rules['slug'] = 'required|string|max:255|unique:categories';
        }

        $Validate = $request->validate($rules);

        $category->update($Validate);
        return redirect('/dashboard/category')->with('success', 'Category updated successfully.');
    }

    public function delete(Category $category){
        $category->delete();
        return redirect('/dashboard/category')->with('success', 'Category deleted successfully.');
    }
}
