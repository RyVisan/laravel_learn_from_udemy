<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request){
        $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,png'
        ],[
            'brand_name.required' => 'Please input brand name.',
            'brand_image.min' => 'Brand longer than 4 characters.'
        ]);

        $brand_img = $request->file('brand_name');
        $img_gen = hexdec(uniqid());


    }
}
