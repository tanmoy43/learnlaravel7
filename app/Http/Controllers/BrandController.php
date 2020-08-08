<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Multiimg;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
        $this->middleware('auth');
    }
    public function AllBrand(){
        $brands = Brand::paginate(3);
        return view('admin.brand.index', compact('brands'));
    }

    public function Addbrand(Request $request){
        $request->validate([
            'brand_name' => 'required|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png'
        ],
        [
            'brand_name.required' => 'Please Input Your Brand Name',
            'brand_name.min' => 'Brand name is at least 4 character',
        ]);


        $brand_image = $request->file('brand_image');
        
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $upload_location = 'images/brand/';
        // $last_img = $upload_location.$img_name;
        // $brand_image->move($upload_location, $img_name);
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(200,200)->save('images/brand/'.$name_gen);
        $last_img = 'images/brand/'.$name_gen;

        Brand::insert([

            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),

        ]);
        return Redirect()->back()->with('success', 'Brand Added');
    }

    // Edit
    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }

    public function Update(Request $request, $id){
        $request->validate([
            'brand_name' => 'required|min:4',
        ],
        [
            'brand_name.required' => 'Please Input Your Brand Name',
            'brand_name.min' => 'Brand name is at least 4 character',
        ]);

        $old_brand_image = $request->old_image;
        $new_brand_image = $request->file('brand_image');
        print_r($new_brand_image);
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($new_brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $upload_location = 'images/brand/';
        $last_img = $upload_location.$img_name;
        $new_brand_image->move($upload_location, $img_name);

        unlink($old_brand_image);
        Brand::find($id)->update([

            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),

        ]);
        return Redirect()->back()->with('success', 'Brand Added');
    }


    //Delete
    public function Delete($id){
        $img = Brand::find($id);
        $old_image = $img->brand_image;
        unlink($old_image);
        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Deleted');
    }



    // Multiple Image
    public function index(){
        $images = Multiimg::all();
        return view('admin.multi_img.index', compact('images'));
    }
    public function StoreImg(Request $request){

        $image = $request->file('image');
        foreach($image as $multi_img){

        $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
        Image::make($multi_img)->resize(200,200)->save('images/multiple_image/'.$name_gen);
        $last_img = 'images/multiple_image/'.$name_gen;

        Multiimg::insert([

            'image' => $last_img,
            'created_at' => Carbon::now(),

        ]);
        }
        return Redirect()->back()->with('success', 'Brand Added');
    }

    // User Profile
    public function Profile(){
        return view('admin.profile.index');
    }
}
