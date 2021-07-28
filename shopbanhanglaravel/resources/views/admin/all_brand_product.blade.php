@extends('admin-layout')
@section('admin-content')
<?php
  use Illuminate\Support\Facades\Session;
?>
<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Danh mục thương hiệu sản phẩm</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                            <?php

                            $message = Session::get('massage');
                            if ($message) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>'.$message.'!</strong> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>';
                                Session::put('massage', null);
                            }

                            ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Thương hiệu sản phẩm</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 79px;">Tên danh mục</th>
                                                            <th  aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 118px;">Trạng thái</th>
                                                            <th  aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 57px;">Mô tả</th>
                                                            <th aria-controls="dataTable" rowspan="1" colspan="1" style="width: 20px;">Sửa</th>
                                                            <th aria-controls="dataTable" rowspan="1" colspan="1" style="width: 20px;">Xóa</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th rowspan="1" colspan="1">Tên danh mục</th>
                                                            <th rowspan="1" colspan="1">Trạng thái</th>
                                                            <th rowspan="1" colspan="1">Mô tả</th>
                                                            <th rowspan="1" colspan="1"></th>
                                                            <th rowspan="1" colspan="1"></th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        @foreach($all_brand_product as $key => $cate_pro)
                                                        <tr class="odd">
                                                            <td class="sorting_1">{{$cate_pro->brand_name}}</td>
                                                            <td>
                                                            <?php
                                                                if($cate_pro->brand_status == 0){
                                                            ?>
                                                                <a href="{{URL::to('/unactive-brand-product/'.$cate_pro->brand_id)}}"><i class="fas fa-eye-slash"></i> Hidden</a>
                                                            <?php
                                                                }else {
                                                            ?>
                                                                <a href="{{URL::to('/active-brand-product/'.$cate_pro->brand_id)}}"><i class="fas fa-eye"></i> Show</a>
                                                                
                                                            <?php
                                                                }
                                                            ?>
                                                                
                                                                
                                                                
                                                            
                                                            </td>
                                                            <td>{{$cate_pro->brand_desc}}</td>
                                                            <td><a href="{{URL::to('/edit-brand-product/'.$cate_pro->brand_id)}}" class="btn btn-primary">Sửa</a></td>
                                                            <td><a href="{{URL::to('/delete-brand-product/'.$cate_pro->brand_id)}}"  class="btn btn-danger" onclick="return confirm('Danh mục xẽ được xóa?')">Xóa</a></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                </div>

                                
                            </div>
                            
                        </div>
                    </div>
                    

</div>

@endsection