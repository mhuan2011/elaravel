@extends('admin-layout')
@section('admin-content')

<?php
    use Illuminate\Support\Facades\Session;
?>
@foreach($edit_product as $key => $edit_value)
<form class="mx-4" action="{{URL::to('/update-product/'.$edit_value->product_id)}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
  <div class="form-group" >
    <h3 class="align-items-center text-center">Cập nhật sản phẩm</h3>
    <?php
      
      $message = Session::get('massage');
      if($message){
        echo '<div class="alert alert-success" role="alert">
        '.$message.'
        </div>';
        Session::put('massage', null);
      }
      
    ?>
    <label for="exampleInputEmail1">Tên sản phẩm</label>
    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$edit_value->product_name}}">
  </div>
  <div class="form-group">
    <label for="">Danh mục sản phẩm</label>
    <select class="custom-select" name="product_category">
        <?php
          foreach($cate_product as $key => $items){
            if($items->category_id == $edit_value->category_id){
              echo  '<option value="'.$items->category_id.'" selected>'.$items->category_name.'</option>';
            }
            else {
              echo  '<option value="'.$items->category_id.'">'.$items->category_name.'</option>';
            }
          }
        ?>
        
    </select>
  </div>
  <div class="form-group">
    <label for="">Thương hiệu sản phẩm</label>
    <select class="custom-select" name="product_brand" >
        
        <?php
          foreach($brand_product as $key => $items){
            if($items->brand_id == $edit_value->brand_id){
              echo  '<option value="'.$items->brand_id.'" selected>'.$items->brand_name.'</option>';
            }
            else {
              echo  '<option value="'.$items->brand_id.'">'.$items->brand_name.'</option>';
            }
          }
        ?>
    </select>
  </div>
  <div class="form-group" >
    <label for="productImage">Hình ảnh sản phẩm</label>
    <input type="file" class="form-control-file" id="productImage" name="product_image" onchange="previewFile(this);">
    <img id="previewImg" src="{{asset('uploads/product/'.$edit_value->product_image)}}" alt="Placeholder">
  </div>
  <div class="form-group" >
    <label for="exampleInputEmail1">Giá sản phẩm</label>
    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$edit_value->product_price}}">
  </div>
  <div class="form-group">
    <label for="">Mô tả sản phẩm</label>
    <textarea class="form-control" name="product_desc" aria-label="With textarea" style="resize: none; " rows=5>{{$edit_value->product_desc}}</textarea>
  </div>
  <div class="form-group">
    <label for="">Nội dung sản phẩm</label>
    <textarea class="form-control" name="product_content" aria-label="With textarea" style="resize: none; " rows=5>{{$edit_value->product_content}}</textarea>
  </div>


  
  <button type="submit" name="update_product" class="btn btn-primary">Cập nhật sản phẩm</button>
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
@endforeach
@endsection