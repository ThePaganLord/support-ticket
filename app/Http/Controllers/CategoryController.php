<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('tickets.index');
    }

    public function create()
    {
        //
        $categories = Category::all();
        return view('tickets.index');
    }

    public function store(Request $request)
    {
        //
        $categories = Category::all();
        return view('tickets.index');
    }

    public function show(Category $category)
    {
        //
        $categories = Category::all();
        return view('tickets.index');
    }

    public function edit(Category $category)
    {
        //
        $categories = Category::all();
        return view('tickets.index');
    }

    public function update(Request $request, Category $category)
    {
        //
        $categories = Category::all();
        return view('tickets.index');
    }

    public function destroy(Category $category)
    {
        //
        $categories = Category::all();
        return view('tickets.index');
    }
}
