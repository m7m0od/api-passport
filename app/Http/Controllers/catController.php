<?php

namespace App\Http\Controllers;

use App\Http\Resources\categoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class catController extends Controller
{
    public function index()
    {
        $cats = Category::all();
        return response([ 'employees' => 
        categoryResource::collection($cats), 
        'message' => 'Successful'], 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data = $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:50'
        ]);

        $validator = Validator::make($data, [
            'title' => 'required|max:50',
            'description' => 'required|max:50'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 
            'Validation Error']);
        }

        $cat = Category::create($data);

        return response([ 'employee' => new 
        categoryResource($cat), 
        'message' => 'Success'], 200);
    }

    public function show(Category $cat)
    {
        return response([ 'cat' => new 
        categoryResource($cat), 'message' => 'Success', "message" => "Product retrieved successfully."], 200);
    }

    public function update(Request $request, Category $cat)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|max:50',
            'description' => 'required|max:50'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 
            'Validation Error']);
        }

        $cat->title = $data['title'];
        $cat->description = $data['description'];
        $cat->save();

        return response()->json([ 'cat' => new 
        categoryResource($cat), 'message' => 'Success'], 200);
    }

    public function destroy(Category $cat)
    {
        $cat->delete();

        return response()->json(['message' => 'cat deleted']);
    }
}
