<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $category = Category::get();

        if (!empty($category)) {
            $response = [
                'error' => false,
                'message' => 'Data load successfully',
                'categories' => $category
            ];
            
        } else {
            $response = [
                'error' => true,
                'message' => 'Data not found',
                'categories' => null
            ];
        }
        
        return response($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::where('slug', $request->slug)->first();

        if (!empty($category)){
            return [
                'error' => true,
                'message' => 'There is already category with slug ' . $request->slug
            ];
        }

        $category = new Category;
        $category->slug = $request->slug;
        $category->image = $request->image;
        $result = $category->save();

        if (!empty($result)) {
            $response = [
                'error' => false,
                'message' => 'Created successfully!'
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Failed to create a new category!'
            ];
        }

        return response($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!empty($category)) {
            $response = [
                'error' => false,
                'message' => 'Data load successfully',
                'categories' => $category
            ];
            
        } else {
            $response = [
                'error' => true,
                'message' => 'Data not found',
                'categories' => null
            ];
        }
        
        return response($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category = Category::find($request->id);

        if (empty($category)){
            return [
                'error' => true,
                'message' => 'There is no category with id ' . $request->id
            ];
        }

        $category->slug = $request->slug;
        $category->image = $request->image;
        $result = $category->save();

        if (!empty($result)) {
            $response = [
                'error' => false,
                'message' => 'Updated successfully!'
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Failed to update category!'
            ];
        }

        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (empty($category)) {
            return [
                'error' => true,
                'message' => 'There is no category id by '.$id
            ];
        }
        
        $category = $category->delete($id);

        if (!empty($category)) {
            $response = [
                'error' => false,
                'message' => 'Deleted successfully!'
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Failed to delete category!'
            ];
        }

        return response($response);
    }
}
