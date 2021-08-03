@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="btn-group col-lg-10 col-md-9 col-10 mt-1 mb-1 pr-md-2">
                            <a href="{{ route('catalog.index') }}" class="btn btn-secondary">Xonalar</a>
                            <a href="{{ route('catalog.quality', [$quality_id]) }}" class="btn btn-primary">Sifatlar</a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-2 pl-0 pl-sm-3 pl-md-0">
                            <a href="" class="btn btn-info btnAdd mt-1 pl-2 pr-2" data-toggle="modal" data-target="#add-model">Qo'shish</a>
                        </div>
                    </div>
                    <div class="modal fade" id="add-model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add-model-Lavel">{{ 'Gilam qo\'shish' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="POST" action="{{ route('catalog.ajax_add') }}" id="js_modal_add_form_product" class="form-group" enctype="multipart/form-data">
                                    @csrf
                                    @include('catalog.formAdd')
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="sub-category-btn btn-group">

                        @foreach($qualities as $k => $q)
                            <a href="{{ route('catalog.quality', [$q->id]) }}" class="btn @if(Request::segment(3) == $q->id) btn-primary @else btn-secondary @endif">{{ $q->name }}</a>
                        @endforeach

                    </div>

                    <hr>
                    @if($array)
                        <div class="all-catalogs js_all_products">

                            @foreach($array as $k => $product)
                                <div class="catalog js_one_product" data-id="{{  $product['id'] }}">
                                    <a class="room_image image" data-fancybox="gallery" style="background-image: url({{ asset('uploaded/product/'.$product['room_image']) }})" href="{{ asset('uploaded/product/'.$product['room_image']) }}"></a>
                                    <div class="table-btns">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td width="25%">Artikul:</td>
                                                    <td>{{ $product['articul'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Kod:</td>
                                                    <td>{{ $product['code'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Narx:</td>
                                                    <td>{{ $product['price'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="edit-delete-btn">
                                            <a href="" data-toggle="modal" data-target="#edit-model_{{ $product['id'] }}" class="btn btn-sm btn-outline-info mr-2" title="Taxrirlash">
                                                <svg class="c-icon">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                                </svg>
                                            </a>
                                            {{-- Edit product modal--}}
                                            <div class="modal fade" id="edit-model_{{ $product['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="add-model-Lavel">{{ $product['articul'] }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post" action="{{ route('catalog.ajax_edit',[$product['id']]) }}" class="js_edit_product_modal_form_quality form-group" enctype="multipart/form-data">

                                                            @csrf
                                                            @include('catalog.formEdit')
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- ./Edit product modal--}}

                                            <a href="#" data-url="{{ route('catalog.ajax_delete') }}" data-name="{{ $product['articul'] }}" data-id="{{ $product['id'] }}" class="btn btn-sm js_delete_btn btn-outline-danger" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                                <svg class="c-icon">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-trash') }}"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- ./catalog -->
                            @endforeach

                        </div>
{{--                    <a href="{{ route('catalog.ajax_see_again_quality') }}"--}}
{{--                       data-sub_category_id="{{ Request::segment(3) }}"--}}
{{--                       class="btn btn-outline-info btn-block ajax_see_again">Yana ko'rish</a>--}}
                        <a data-sub_category_id="{{ Request::segment(3) }}" class="ajax_see_again"></a>
                    @else
                        <p class="text-center text-danger">Mahsulot mavjud emas.</p>
                    @endif

                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
