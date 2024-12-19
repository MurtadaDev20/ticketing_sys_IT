<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catigory;
use App\Models\SubCatigory;
use Illuminate\Http\Request;
use App\Traits\CategoryTrait;

class CatigoriesController extends Controller
{
    use CategoryTrait;

    public function showCatigories()
    {
        $catigories = Catigory::orderBy('id','desc')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('layouts.admin.backend.catigory',compact('catigories'));
    }

    public function addCatigory(Request $request)
    {
        $this->store($request);
        toastr()->success('Add Category Successfully');
        return  redirect()->route('admin.showCatigories');
    }

    public function updateCatigory(Request $request, $id)
    {
        $category = Catigory::findOrFail($id);


        $validatedData = $request->validate([
            'cat_name' => 'required',
            'degre' => 'required|integer|min:1|max:100',
        ]);
        // Create a new category instance

        $category->cat_name = $validatedData['cat_name'];
        $category->cat_grade = $validatedData['degre'];
        $category->save();

        toastr()->success('category updated successfully');
        return  redirect()->route('admin.showCatigories');
    }

    public function destroyCatigory($id)
    {
        $Subcategory = Catigory::findOrFail($id);
        $Subcategory->delete();
        toastr()->success('Delete Catigory Successfully');
        return  redirect()->route('admin.showCatigories');
    }
    ///////////////////////////////////// Sub Catigory /////////////////////////////////////////

    public function showSubCatigories()
    {
        $catigories = Catigory::orderBy('id','desc')->orderBy('created_at', 'desc')->get();

        $subcatigories = SubCatigory::orderBy('id','desc')->with('category')->orderBy('created_at', 'desc')->get();

        return view('layouts.admin.backend.SubCatigory',compact('subcatigories','catigories'));
    }

    public function addSubCategory(Request $request)
    {
        $validatedData = $request->validate([
            'catigory_id' => 'required|exists:catigories,id',
            'sub_cat_name' => 'required|unique:sub_catigories,sub_cat_name',
        ]);

        $Subcategory = new SubCatigory();
        $Subcategory->catigory_id = $validatedData['catigory_id'];
        $Subcategory->sub_cat_name = $validatedData['sub_cat_name'];
        $Subcategory->save();

        toastr()->success('Subcategory added successfully');
        return redirect()->route('admin.showSubCatigories');
    }






    public function updateSubCatigory(Request $request, $id)
    {
        $Subcategory = SubCatigory::findOrFail($id);


        $validatedData = $request->validate([
            'catigory_id' => 'required|exists:catigories,id',
            'sub_cat_name' => 'required',
        ]);

        // Update the user details
        $Subcategory->catigory_id = $validatedData['catigory_id'];
        $Subcategory->sub_cat_name = $validatedData['sub_cat_name'];



        $Subcategory->save();

        toastr()->success('Subcategory updated successfully');
        return  redirect()->route('admin.showSubCatigories');
    }

    public function destroySubCatigory($id)
    {
        $Subcategory = SubCatigory::findOrFail($id);
        $Subcategory->delete();
        toastr()->success('Delete Subcategory Successfully');
        return  redirect()->route('admin.showSubCatigories');
    }
}
