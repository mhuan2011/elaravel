@extends('admin-layout')
@section('admin-content')
<form class="mx-4" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
  <div class="form-group" >
    <h3 class="align-items-center text-center">Thêm sản phẩm</h3>
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
    <label for="exampleInputEmail1">Tên sản phẩm</label>
    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="">Danh mục sản phẩm</label>
    <select class="custom-select" name="product_category">
        @foreach($cate_product as $key => $items)
        <option value="{{$items->category_id}}">{{$items->category_name}}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="">Thương hiệu sản phẩm</label>
    <select class="custom-select" name="product_brand">
        @foreach($brand_product as $key => $items)
        <option value="{{$items->brand_id}}">{{$items->brand_name}}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group" >
    <label for="image">Hình ảnh sản phẩm</label>
    <input type="file" class="form-control-file" id="image" name="product_image" onchange="previewFile(this);">
    <img id="previewImg" src="https://thumbs.dreamstime.com/b/upload-to-cloud-icon-hosting-web-internet-153848856.jpg" alt="Placeholder">
  </div>
  <div class="form-group" >
    <label for="exampleInputEmail1">Giá sản phẩm</label>
    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="">Mô tả sản phẩm</label>
    <textarea class="form-control" name="product_desc" aria-label="With textarea" style="resize: none; " rows=5></textarea>
  </div>
  <div class="form-group">
    <label for="">Nội dung sản phẩm</label>
    <textarea class="form-control" name="product_content" aria-label="With textarea" style="resize: none; " rows=5></textarea>
  </div>
 

  <div class="form-group">
    <label for="">Hiển thị</label>
    <select class="custom-select" name="product_status">
        <option value="0">Ẩn</option>
        <option value="1">Hiển thị</option>
    </select>
  </div>

  
  <button type="submit" name="add_product" class="btn btn-primary">Thêm sản phẩm</button>
</form>

<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection