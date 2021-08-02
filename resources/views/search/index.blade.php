@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card border-secondary">
                <div class="card-header">
                    <a href="{{ route('catalog.index') }}" class="btn btn-info">Orqaga qaytish</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('search.index') }}" method="GET" class="form-group">

                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" name="name" class="form-control" placeholder="Mahsulot nomini, articulini, kodini yoki narxini kiriting !" @if(isset($_GET['name'])) value="{{ $_GET['name'] }}" @endif>
                                @error('search')
                                    <span class="text-danger">Mahsulot nomini kiriting!</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success btn-block">Izlash</button>
                            </div>
                        </div>
                    </form>

                    @if($array)
                        <table id="dataTable_search" class="display bg-secondary" style="width:100%;">
                            <thead>
                                <tr>
                                    <th width="6%">№</th>
                                    <th>Rasm</th>
                                    <th>Articul</th>
                                    <th>Kodi</th>
                                    <th>Narxi</th>
                                    <th width="15%" class="text-right">Harakatlar</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($array as $p)
                                    <tr class="js_this_tr" data-id="{{ $p['id'] }}">
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="js_td_image dataTable-td-image">
                                            <a class="image" data-fancybox="gallery" style='background: url("{{ asset('uploaded/product/'.$p['image']) }}")' href="{{ asset('uploaded/product/'.$p['image']) }}"></a>
                                        </td>
                                        <td>{{ $p['articul'] }}</td>
                                        <td>{{ $p['code'] }}</td>
                                        <td>{{ $p['price'] }}</td>

                                        {{-- Edit product modal--}}
                                        <div class="modal fade" id="edit-model_{{ $p['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="add-model-Lavel">{{ $p['articul'] }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" action="{{ route('catalog.ajax_edit',[$p['id']]) }}" class="js_search_product_edit_btn form-group" enctype="multipart/form-data">

                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $p['id'] }}">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-2">
                                                                            <label for="quality_id{{ $p['id'] }}">Sifat</label>
                                                                            <select type="text" name="quality_id" id="quality_id{{ $p['id'] }}" class="form-control">
                                                                                <option value="">---</option>
                                                                                @foreach($qualities as $q)
                                                                                    <option @if($p['quality_id'] == $q->id) selected @endif value="{{ $q->id }}">{{ $q->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <span class="valid-feedback text-danger room_id_error"></span>
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label for="articul{{ $p['id'] }}">Artikul</label>
                                                                            <input type="text" name="articul" id="articul{{ $p['id'] }}" class="form-control" value="{{ $p['articul'] }}">
                                                                            <span class="valid-feedback text-danger articul_error"></span>
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label for="code{{$p['id']}}">Kodi</label>
                                                                            <input type="text" name="code" id="code{{$p['id']}}" class="form-control" value="{{ $p['code'] }}">
                                                                            <span class="valid-feedback text-danger code_error"></span>
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <label for="price{{$p['id']}}">Narx</label>
                                                                            <input type="text" name="price" id="price{{$p['id']}}" class="form-control" value="{{ $p['price'] }}">
                                                                            <span class="valid-feedback text-danger price_error"></span>
                                                                        </div>
                                                                        <div class="col-md-12 col-12">
                                                                            <label for="image{{$p['id']}}">Rasm</label>
                                                                            <div class="custom-file">
                                                                                <input type="hidden" name="image_hidden" value="{{ $p['image'] }}">
                                                                                <input type="file" class="custom-file-input" name="image" id="image{{$p['id']}}">
                                                                                <label class="custom-file-label" for="image{{$p['id']}}">{{ $p['image'] }}</label>
                                                                            </div>
                                                                            <span class="valid-feedback text-danger invalid_image">Rasmni yuklang</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3 offset-md-1">
                                                                    <label for="rooms{{$p['id']}}">Xonalar</label>
                                                                    <div class="room_checkbox">
                                                                        @foreach($rooms as $r)
                                                                            <div class="form-check mb-1">
                                                                                <input class="form-check-input" name="room_id[]" type="checkbox" @if(in_array($r->id, $p['room_id'])) checked @endif value="{{ $r->id }}" id="room{{ $r->id.$p['id'] }}">
                                                                                <label class="form-check-label" for="room{{ $r->id.$p['id'] }}">
                                                                                    {{ $r->name }}
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                        <span class="text-danger js_checkbox_error_room_id d-none">salom</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer mt-3">
                                                            <button class="btn btn-success btn-square">Saqlash</button>
                                                            <button type="button" class="btn btn-secondary js_modal_closeBtn btn-square" data-dismiss="modal">Bekor qilish</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- ./Edit product modal--}}

                                        <td class="text-right">
                                            <div class="btn-group js_btn_group" role="group" aria-label="Basic example">
                                                <a href="#" data-toggle="modal" data-target="#edit-model_{{ $p['id'] }}" class="btn btn-info btn-square btn-sm" title="Тахрирлаш">
                                                    <svg class="c-icon c-icon-lg">
                                                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                                    </svg>
                                                </a>

                                                <button type="button" data-url="{{ route('search.ajax_delete') }}" data-name="{{ $p['articul'] }}" data-id="{{ $p['id'] }}" class="btn btn-danger js_delete_btn btn-square btn-sm" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                                    <svg class="c-icon c-icon-lg" title="O'chirish">
                                                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-trash') }}"></use>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @else
                        <h6 class="text-center text-danger">Ma'lumot topilmadi</h6>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
