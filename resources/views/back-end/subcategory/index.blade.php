@extends('back-end.layout.master_back_end')

@section('subcategory')active @endsection
@section('product')active @endsection

@section('master_title')Multikart - Sub Category @endsection
@section('page_title')Sub Category @endsection
@section('bread_title')Sub Category @endsection

@push('custom_css')
<!-- jsgrid css-->
<link rel="stylesheet" type="text/css" href="{{ asset('back-end/assets/css/jsgrid.css') }}">
@endpush


@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Products SubCategory</h5>
                </div>
                <div class="card-body">
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-primary" data-type="add-category" data-toggle="modal" data-original-title="test"data-target="#subcategoryModal">Add Sub Category</button>

                        {{-- Modal Start --}}
                        <div class="modal fade" id="subcategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title f-w-600" id="categoryHead">Add Physical SubCategory</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="needs-validation" action="{{ route('subcategory.create') }}" method="POST" enctype="multipart/form-data" id="subcategory-form">
                                            @csrf

                                            <input type="hidden" name="name" value="null" class="source_id">

                                            <div class="form">
                                                <div class="form-group">
                                                    <label for="validationCustom01" class="mb-1">SubCategory Name :</label>
                                                    <input class="form-control subcat-name" id="validationCustom01" type="text" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="validationCustom01" class="mb-1">Select Category</label>
                                                    {!! Form::select('category', $category, null, ['class'=>'custom-select', 'id' => 'category', 'placeholder' => 'Select Category', 'required']) !!}
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label for="validationCustom02" class="mb-1">SubCategory Image:</label>
                                                    <input class="form-control cat-image" id="validationCustom02" type="file" name="subcategory_image">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label>Status</label>
                                                    <select class="form-control" name="status" id="cat-status">
                                                        <option>Select Status</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary submit-btn" type="submit">Save</button>
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- Modal End --}}
                    </div>
                    <div class="table-responsive">
                        <div id="basicScenario" class="product-physical jsgrid"
                            style="position: relative; height: auto; width: 100%;">
                            <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                <table class="jsgrid-table">
                                    <tr class="jsgrid-header-row">
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable" style="width: 50px;">Image</th>
                                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 100px;">SubCategory Name</th>
                                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 100px;">Category Name</th>
                                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 50px;">Status</th>
                                        <th class="jsgrid-header-cell jsgrid-control-field jsgrid-align-center"style="width: 50px;">
                                            <input class="jsgrid-button jsgrid-mode-button jsgrid-insert-mode-button" type="button" title="Switch to inserting">
                                        </th>
                                    </tr>
                                </table>
                            </div>
                            <div class="jsgrid-grid-body">
                                <table class="jsgrid-table">
                                    <tbody>
                                        @foreach ($subcategory as $item)

                                        <tr class="jsgrid-row">
                                            <td class="jsgrid-cell jsgrid-align-center" style="width: 50px;"><img
                                                src="{{asset('/')}}images/subcategory/{{ $item->images ??'' }}"
                                                class="blur-up lazyloaded" style="height: 50px; width: 50px;">
                                            </td>
                                            <td class="jsgrid-cell" style="width: 100px;">{{ $item->name }}</td>
                                            <td class="jsgrid-cell" style="width: 100px;">{{ $item->categories_item->name }}</td>
                                            <td class="jsgrid-cell" style="width: 50px;">
                                                @if ($item->status == 1)
                                                    <i class="fa fa-circle font-success f-12" aria-hidden="true"></i>
                                                    @else
                                                    <i class="fa fa-circle font-danger f-12" aria-hidden="true"></i>
                                                @endif
                                            </td>
                                            <td class="jsgrid-cell jsgrid-control-field jsgrid-align-center"style="width: 50px;">
                                                <a href="#" class="jsgrid-button jsgrid-edit-button editsubCategoryModal" type="button" data-url="{{ route('subcategory.update', [$item->id]) }}" data-subcategory_name="{{$item->name}}" data-category_image={{ $item->images ?? ''}} data-subcat_status={{ $item->status }} data-category={{ $item->categories_id }} data-source_id="{{$item->id}}" data-type="edit" title="Edit" data-toggle="modal" data-original-title="test"data-target="#subcategoryModal"></a>
                                                <a href="{{ route('subcategory.delete', $item->id) }}" class="jsgrid-button jsgrid-delete-button" type="button"title="Delete" onclick="return confirm('Are you sure you want to delete ?')">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="jsgrid-pager-container" style="">
                                <div class="jsgrid-pager">Pages:
                                    <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button"><a href="javascript:void(0);">First</a></span>
                                    <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button"><a href="javascript:void(0);">Prev</a></span>
                                    <span class="jsgrid-pager-page jsgrid-pager-current-page">1</span>
                                    <span class="jsgrid-pager-page"><a href="javascript:void(0);">2</a></span>
                                    <span class="jsgrid-pager-nav-button"><a href="javascript:void(0);">Next</a></span>
                                    <span class="jsgrid-pager-nav-button"><a href="javascript:void(0);">Last</a></span>
                                    &nbsp;&nbsp; 1 of 2
                                </div>
                            </div>
                            <div class="jsgrid-load-shader" style="display: none; position: absolute; inset: 0px; z-index: 1000;"></div>
                            <div class="jsgrid-load-panel" style="display: none; position: absolute; top: 50%; left: 50%; z-index: 1000;">Please, wait...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
<!-- Jsgrid js-->
<script src="{{ asset('back-end/assets/js/jsgrid/jsgrid.min.js') }}"></script>
<script src="{{ asset('back-end/assets/js/back-panel/category.js') }}"></script>
{{-- <script src="{{ asset('back-end/assets/js/jsgrid/griddata-manage-product.js') }}"></script> --}}
{{-- <script src="{{ asset('back-end/assets/js/jsgrid/jsgrid-manage-product.js') }}"></script> --}}
<script>
    function myFunction() {
      alert("Are You Sure You Want to Delete??");
    }
    </script>
@endpush