<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ControllerCategory extends Controller
{
    public function AllCat(){
        // $categories = DB::table('categories')
        //             ->join('users', 'users.id', 'categories.user_id')
        //             ->select('categories.*', 'users.name')
        //             ->latest()->paginate(5);
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        // $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'trashCat'));
    }

    public function AddCat(Request $request){
        $request->validate(
            ['category_name' => 'required|unique:categories|max:10'],
            [
                'category_name.required' => 'Please input category name',
                'category_name.max' => 'Please input less than 10 chars',
            ]
        );

        // Category::insert([
        //     'user_id' => Auth::user()->id,
        //     'category_name' => $request->category_name,
        //     'created_at' => Carbon::now()
        // ]);

        // $category = new Category;
        // $category->user_id = Auth::user()->id;
        // $category->category_name = $request->category_name;
        // $category->save();

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($data);

        return redirect()->back()->with('success','Category inserted successfully!');
    }

    public function Edit($id){
        // $categories = Category::find($id);
        $categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit', compact('categories'));
    }

    public function Update(Request $request, $id){
        // $categories = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id
        // ]);
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);
        return redirect()->route('all.category')->with('success','Category updated successfully!');
    }
    
    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success','Category soft deleted successfully!');
    }

    public function Restore($id){
        $restore = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Category restore successfully!');
    }

    public function pdelete($id){
        $pdelte = Category::onlyTrashed()->find($id)->forcedelete();
        return redirect()->back()->with('success','Category permanenetly deleted!');        
    }

}