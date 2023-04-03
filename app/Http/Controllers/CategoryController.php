<?php

namespace App\Http\Controllers;

use App\Http\Filters\CategoryFilter;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryFilter $filter)
    {
        try {
            return new CategoryCollection(
                Category::filter($filter)->latest()->paginate(request('limit') ?? 10)
            );
        } catch (Exception $e) {
            return respondError(SERVER_ERROR, $e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $form)
    {
        try {
            $data = Category::create($form->persist());
            return respondSuccess(SUCCESS, new CategoryResource($data), 201);
        } catch (Exception $e) {
            return respondError('Failed to create category', $e->getMessage(), 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $form, $id)
    {
        try {
            $category = Category::find($id);
            $category->update($form->persist());
            return respondSuccess(UPDATE_SUCCESS, new CategoryResource($category), 200);
        } catch (\Exception $e) {
            return respondError('Failed to update School.', $e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
