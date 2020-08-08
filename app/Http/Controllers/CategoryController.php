<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
        $this->middleware('auth');
    }
    public function Allcat(){
        $categories = Category::paginate(5);
        $trash_category = Category::onlyTrashed()->paginate(3);
        return view('admin.category.index', compact('categories', 'trash_category'));
    }
    public function Addcat(Request $request){
        $request->validate([
            'category_name' => 'required|max:255',
        ],
        [
            'category_name.required' => 'Please Input Your Category Name',
        ]);


        Category::insert([

            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),

        ]);
        return Redirect()->back()->with('success', 'Category Added');

    }

    public function Edit($id){
        $categories = Category::find($id);
        return view('admin.category.edit',compact('categories'));
    }

    public function Update(Request $request, $id){
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);
        return Redirect()->route('All.category')->with('success', 'Category Updated');
    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category '.$id.' Deleted');
    }


    public function Restore($id){
        $restore = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category '.$id.' Restore');
    }

    public function ParmanentDelete($id){
        $parmanent_delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category '.$id.' Parmanently Deleted');
    }
}
