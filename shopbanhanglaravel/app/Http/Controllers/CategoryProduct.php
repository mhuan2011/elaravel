<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use League\CommonMark\Extension\Table\Table;

session_start();
class CategoryProduct extends Controller
{
    public function add_category_product()
    {
        return view('admin.add_category_product');
    }
    public function all_category_product()
    {
        if(!isset($_SERVER['HTTP_REFERER'])){
            // redirect them to your desired location
            
            return view('error');  
        }
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
  
        return view('admin-layout')->with('admin.all_category_product', $manager_category_product);
    }
    public function save_category_product(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        
        DB::table('tbl_category_product')->insert($data);
        Session::put('massage', 'Thêm thiết bị thành công');
        return redirect::to('all-category-product');
    }
    public function unactive_category_product($category_product_id)
    {
        DB::table('tbl_category_product')
              ->where('category_id',$category_product_id )
              ->update(['category_status' => 1]);
        return redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id)
    {
        DB::table('tbl_category_product')
              ->where('category_id',$category_product_id )
              ->update(['category_status' => 0]);
        return redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id)
    {
        if(!isset($_SERVER['HTTP_REFERER'])){
            // redirect them to your desired location
            
            return view('error');  
        }
        $category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $category_product);
  
        return view('admin-layout')->with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request, $category_product_id)
    {
        if(!isset($_SERVER['HTTP_REFERER'])){
            // redirect them to your desired location
            
            return view('error');  
        }
        
        $category_name = $request->category_product_name;
        $category_desc = $request->category_product_desc;
        echo $category_product_id;

        DB::table('tbl_category_product')
              ->where('category_id',$category_product_id )
              ->update(['category_name' => $category_name], ['category_desc' => $category_desc]);
        Session::put('massage', 'Cập nhật danh mục thiết bị thành công !!');
        return redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id    )
    {
        if(!isset($_SERVER['HTTP_REFERER'])){
            // redirect them to your desired location
            
            return view('error');  
        }
        DB::table('tbl_category_product')
              ->where('category_id',$category_product_id )
              ->delete();
        Session::put('massage', 'Danh mục thiết bị được xóa thành công !!');
        return redirect::to('all-category-product');
    }
}
