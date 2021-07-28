<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
class ProdcutController extends Controller
{
    public function add_product()
    {
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();


  
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);


    }
    public function all_product()
    {
        if(!isset($_SERVER['HTTP_REFERER'])){
            // redirect them to your desired location
            return view('error');  
        }
        $all_product = DB::table('tbl_product')->get();
        $manager = view('admin.all_product')->with('all_product', $all_product);
  
        return view('admin-layout')->with('admin.all_product', $manager);
    }
    public function save_product(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price; 
        $data['product_status'] = $request->product_status;

        // $file = $request->product_image;

        // $file->move('upload', $file->getClientOriginalName());
        $file_img = $request->file('product_image');
        if($file_img){
            $new_img = rand(0,99).'.'.$file_img->getClientOriginalExtension();
            $file_img->move('uploads/product',  $new_img);
            $data['product_image'] = $new_img; 
        }else {
            $data['product_image'] = ''; 
        }
        
        DB::table('tbl_product')->insert($data);

        Session::put('massage', 'Thêm sản phẩm thành công');
        return redirect::to('all-product');
    }
    public function unactive_product($product_id)
    {
        DB::table('tbl_product')
              ->where('product_id',$product_id )
              ->update(['product_status' => 1]);
        return redirect::to('all-product');
    }
    public function active_product($product_id)
    {
        DB::table('tbl_product')
              ->where('product_id',$product_id )
              ->update(['product_status' => 0]);
        return redirect::to('all-product');
    }
    public function edit_product($product_id)
    {
        if(!isset($_SERVER['HTTP_REFERER'])){
            // redirect them to your desired location
            
            return view('error');  
        }   
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        $product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        
        $manager = view('admin.edit_product')->with('edit_product', $product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        


        return view('admin-layout')->with('admin.edit_product', $manager);
    }
    public function update_product(Request $request, $product_id)
    {
        if(!isset($_SERVER['HTTP_REFERER'])){
            // redirect them to your desired location
            
            return view('error');  
        }
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price; 



        $file_img = $request->file('product_image');
        if($file_img){
            $new_img = rand(0,99).'.'.$file_img->getClientOriginalExtension();
            $file_img->move('uploads/product',  $new_img);
            $data['product_image'] = $new_img; 
        }
        DB::table('tbl_product')
              ->where('product_id',$product_id )
              ->update($data);
        Session::put('massage', 'Cập nhật sản phẩm thành công !!');
        return redirect::to('all-product');
    }
    public function delete_product($product_id    )
    {
        if(!isset($_SERVER['HTTP_REFERER'])){
            // redirect them to your desired location
            
            return view('error');  
        }
        DB::table('tbl_product')
              ->where('product_id',$product_id )
              ->delete();
        Session::put('massage', 'Sản phẩm được xóa thành công !!');
        return redirect::to('all-product');
    }
}
