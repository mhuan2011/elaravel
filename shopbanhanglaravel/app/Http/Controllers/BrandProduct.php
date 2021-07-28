<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
class BrandProduct extends Controller
{
    public function add_brand_product()
    {
        return view('admin.add_brand_product');
    }
    public function all_brand_product()
    {
        $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
  
        return view('admin-layout')->with('admin.all_brand_product', $manager_brand_product);
    }
    public function save_brand_product(Request $request)
    {
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        
        DB::table('tbl_brand')->insert($data);
        Session::put('massage', 'Thêm thiết bị thành công');
        return redirect::to('all-brand-product');
    }
    public function unactive_brand_product($brand_product_id)
    {
        DB::table('tbl_brand')
              ->where('brand_id',$brand_product_id )
              ->update(['brand_status' => 1]);
        return redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id)
    {
        DB::table('tbl_brand')
              ->where('brand_id',$brand_product_id )
              ->update(['brand_status' => 0]);
        return redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id)
    {
        $brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $brand_product);
  
        return view('admin-layout')->with('admin.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request, $brand_product_id)
    {
        
        $brand_name = $request->brand_product_name;
        $brand_desc = $request->brand_product_desc;
        echo $brand_product_id;

        DB::table('tbl_brand')
              ->where('brand_id',$brand_product_id )
              ->update(['brand_name' => $brand_name], ['brand_desc' => $brand_desc]);
        Session::put('massage', 'Cập nhật danh mục thiết bị thành công !!');
        return redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id    )
    {
        DB::table('tbl_brand')
              ->where('brand_id',$brand_product_id )
              ->delete();
        Session::put('massage', 'Danh mục thiết bị được xóa thành công !!');
        return redirect::to('all-brand-product');
    }
}
