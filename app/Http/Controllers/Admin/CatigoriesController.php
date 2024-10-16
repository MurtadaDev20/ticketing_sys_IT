<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catigory;
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
}
