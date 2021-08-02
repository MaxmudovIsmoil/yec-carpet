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
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-6 mb-2">
                                                        <label for="quality_id">Sifat</label>
                                                        <select type="text" name="quality_id" id="quality_id" class="form-control">
                                                            <option value="">---</option>
                                                            @foreach($qualities as $q)
                                                                <option value="{{ $q->id }}">{{ $q->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="valid-feedback text-danger room_id_error"></span>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="articul">Artikul</label>
                                                        <input type="text" name="articul" id="articul" class="form-control">
                                                        <span class="valid-feedback text-danger articul_error"></span>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="code">Kodi</label>
                                                        <input type="text" name="code" id="code" class="form-control">
                                                        <span class="valid-feedback text-danger code_error"></span>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="price">Narx</label>
                                                        <input type="text" name="price" id="price" class="form-control">
                                                        <span class="valid-feedback text-danger price_error"></span>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <label for="image">Rasm</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="image" multiple="true" id="image">
                                                            <label class="custom-file-label" for="image">Rasmni yuklang</label>
                                                        </div>
                                                        <span class="valid-feedback text-danger image_error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 offset-md-1">
                                                <label for="room_selects">Xonalar</label>
                                                <div class="room_checkbox">
                                                    @foreach($rooms as $r)
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input" name="room_id[]" type="checkbox" value="{{ $r->id }}" id="room{{ $r->id }}">
                                                        <label class="form-check-label" for="room{{ $r->id }}">
                                                            {{ $r->name }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <span class="text-danger room_checkbox_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer mt-3 pb-0">
                                        <button class="btn btn-success btn-square">Saqlash</button>
                                        <button type="button" class="btn btn-secondary js_modal_closeBtn btn-square" data-dismiss="modal">Bekor qilish</button>
                                    </div>
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
                                <a class="image" data-fancybox="gallery" style="background-image: url({{ asset('uploaded/product/'.$product['image']) }})" href="{{ asset('uploaded/product/'.$product['image']) }}"></a>
                                <div class="table-btns">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="25%">Articul:</td>
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
                                                        <input type="hidden" name="id" value="{{ $product['id'] }}">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-2">
                                                                            <label for="quality_id{{ $product['id'] }}">Sifat</label>
                                                                            <select type="text" name="quality_id" id="quality_id{{ $product['id'] }}" class="form-control">
                                                                                <option value="">---</option>
                                                                                @foreach($qualities as $q)
                                                                                    <option @if($product['quality_id'] == $q->id) selected @endif value="{{ $q->id }}">{{ $q->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <span class="valid-feedback text-danger room_id_error"></span>
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label for="articul{{ $product['id'] }}">Artikul</label>
                                                                            <input type="text" name="articul" id="articul{{ $product['id'] }}" class="form-control" value="{{ $product['articul'] }}">
                                                                            <span class="valid-feedback text-danger articul_error"></span>
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label for="code{{$product['id']}}">Kodi</label>
                                                                            <input type="text" name="code" id="code{{$product['id']}}" class="form-control" value="{{ $product['code'] }}">
                                                                            <span class="valid-feedback text-danger code_error"></span>
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label for="price{{$product['id']}}">Narx</label>
                                                                            <input type="text" name="price" id="price{{$product['id']}}" class="form-control" value="{{ $product['price'] }}">
                                                                            <span class="valid-feedback text-danger price_error"></span>
                                                                        </div>
                                                                        <div class="col-md-12 col-12">
                                                                            <label for="image{{$product['id']}}">Rasm</label>
                                                                            <div class="custom-file">
                                                                                <input type="hidden" name="image_hidden" value="{{ $product['image'] }}">
                                                                                <input type="file" class="custom-file-input" name="image" id="image{{$product['id']}}">
                                                                                <label class="custom-file-label" for="image{{$product['id']}}">{{ $product['image'] }}</label>
                                                                            </div>
                                                                            <span class="valid-feedback text-danger invalid_image">Rasmni yuklang</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3 offset-md-1">
                                                                    <label for="rooms{{$product['id']}}">Xonalar</label>
                                                                    <div class="room_checkbox">
                                                                        @foreach($rooms as $r)
                                                                            <div class="form-check mb-1">
                                                                                <input class="form-check-input" name="room_id[]" type="checkbox" @if(in_array($r->id, $product['room_id'])) checked @endif value="{{ $r->id }}" id="room{{ $r->id.$product['id'] }}">
                                                                                <label class="form-check-label" for="room{{ $r->id.$product['id'] }}">
                                                                                    {{ $r->name }}
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <span class="text-danger room_checkbox_error"></span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer mt-3 pb-0">
                                                            <button class="btn btn-success btn-square">Saqlash</button>
                                                            <button type="button" class="btn btn-secondary js_modal_closeBtn btn-square" data-dismiss="modal">Bekor qilish</button>
                                                        </div>
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
                    <a href="{{ route('catalog.ajax_see_again_quality') }}"
                       data-sub_category_id="{{ Request::segment(3) }}"
                       class="btn btn-outline-info btn-block ajax_see_again">Yana ko'rish</a>
                    @else
                        <p class="text-center text-danger">Mahsulot mavjud emas.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
