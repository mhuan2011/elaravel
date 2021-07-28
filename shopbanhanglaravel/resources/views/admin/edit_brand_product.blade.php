@extends('admin-layout')
@section('admin-content')


@foreach($edit_brand_product as $key => $edit_value)
<form class="mx-4" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="post">
  {{ csrf_field() }}
  <div class="form-group">
    <h3 class="align-items-center text-center">Cập nhật thương hiệu sản phẩm</h3>
    
    <label for="exampleInputEmail1">Tên thương hiệu</label>

    <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$edit_value->brand_name}}">
  </div>
  <div class="form-group">
    <label for="">Mô tả thương hiệu</label>
    <textarea class="form-control" name="brand_product_desc" aria-label="With textarea" style="resize: none; " rows=5>{{$edit_value->brand_desc}}</textarea>
  </div>
  @endforeach



  <button type="submit" name="edit_brand_product" class="btn btn-primary">Cập nhật danh mục</button>
</form>
@endsection