@extends('admin-layout')
@section('admin-content')


@foreach($edit_category_product as $key => $edit_value)
<form class="mx-4" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
  {{ csrf_field() }}
  <div class="form-group">
    <h3 class="align-items-center text-center">Cập nhật mục sản phẩm</h3>
    
    <label for="exampleInputEmail1">Tên danh mục</label>

    <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$edit_value->category_name}}">
  </div>
  <div class="form-group">
    <label for="">Mô tả danh mục</label>
    <textarea class="form-control" name="category_product_desc" aria-label="With textarea" style="resize: none; " rows=5>{{$edit_value->category_desc}}</textarea>
  </div>
  @endforeach



  <button type="submit" name="edit_category_product" class="btn btn-primary">Cập nhật danh mục</button>
</form>
@endsection