@extends('admin-layout')
@section('admin-content')
<form class="mx-4" action="{{URL::to('/save-brand-product')}}" method="post">
    {{ csrf_field() }}
  <div class="form-group" >
    <h3 class="align-items-center text-center">Thêm thương hiệu sản phẩm</h3>
    <?php
      use Illuminate\Support\Facades\Session;
      $message = Session::get('massage');
      if($message){
        echo '<div class="alert alert-success" role="alert">
        '.$message.'
        </div>';
        Session::put('massage', null);
      }
      
    ?>
    <label for="exampleInputEmail1">Tên thương hiệu</label>
    <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="">Mô tả thương hiệu</label>
    <textarea class="form-control" name="brand_product_desc" aria-label="With textarea" style="resize: none; " rows=5></textarea>
  </div>

  <div class="form-group">
    <label for="">Hiển thị</label>
    <select class="custom-select" name="brand_product_status">
        <option value="0">Ẩn</option>
        <option value="1">Hiển thị</option>
    </select>
  </div>

  
  <button type="submit" name="add_brand_product" class="btn btn-primary">Thêm thương hiệu</button>
</form>
@endsection