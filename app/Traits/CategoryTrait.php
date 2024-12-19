<?php

namespace App\Traits;

use App\Models\Catigory;
use Illuminate\Http\Request;

trait CategoryTrait
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'cat_name' => 'required|unique:catigories,cat_name',
            'degre' => 'required|integer|min:1|max:100',
        ]);
        // Create a new category instance
        $category = new Catigory();
        $category->cat_name = $validatedData['cat_name'];
        $category->cat_grade = $validatedData['degre'];
        $category->save();
    }
}
