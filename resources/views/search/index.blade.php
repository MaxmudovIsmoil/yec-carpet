@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card border-secondary">
                <div class="card-header">
                    <a href="{{ route('catalog.index') }}" class="btn btn-info">
                        <svg class="c-icon mr-2 mt-0">
                            <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-arrow-thick-left') }}"></use>
                        </svg> Orqaga qaytish</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('search.products') }}" method="POST" class="form-group">

                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <select name="search_type" class="form-control">
                                    <option value="">Xona yoki sfatni tanlang</option>
                                    <option value="room" @if(isset($name) && $search_type == 'room') selected @endif>Xonadan izlash</option>
                                    <option value="quality" @if(isset($name) && $search_type == 'quality') selected @endif>Sifatdan izlash</option>
                                </select>
                                @error('search_type')
                                    <span class="text-danger">Tanlang!</span>
                                @enderror
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="name" class="form-control" placeholder="Mahsulot nomini, articulini, kodini yoki narxini kiriting !" value="@if(isset($name)) {{ $name }} @endif">
                                @error('name')
                                    <span class="text-danger">Izlanayotgan ma'lumotni kiriting!</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success btn-block" name="search_btn">Izlash</button>
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
                                    <th>Narx</th>
                                    <th width="15%" class="text-right">Harakatlar</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($array as $p)
                                    <tr class="js_this_tr" data-id="{{ $p['id'] }}">
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="js_td_image dataTable-td-image">
                                            @if(isset($p['room_image']))
                                                <a class="image" data-fancybox="gallery" style='background: url("{{ asset('uploaded/product/'.$p['room_image']) }}")' href="{{ asset('uploaded/product/'.$p['room_image']) }}"></a>
                                            @endif

                                            @if(isset($p['image']))
                                                <a class="image" data-fancybox="gallery" style='background: url("{{ asset('uploaded/product2/'.$p['image']) }}")' href="{{ asset('uploaded/product2/'.$p['image']) }}"></a>
                                            @endif
                                        </td>
                                        <td>{{ $p['articul'] }}</td>
                                        <td>{{ $p['code'] }}</td>
                                        <td>{{ $p['price'] }}</td>

                                        {{-- Edit product modal--}}
                                        @if(isset($p['room_image']))
                                            @include('search.formEdit')
                                        @endif

                                        @if(isset($p['image']))
                                            @include('search.form2Edit')
                                        @endif
                                        {{-- ./Edit product modal--}}

                                        <td class="text-right">
                                            <div class="btn-group js_btn_group" role="group" aria-label="Basic example">
                                                <a href="#" data-toggle="modal" data-target="#edit-model_{{ $p['id'] }}" class="btn btn-info btn-square btn-sm" title="Тахрирлаш">
                                                    <svg class="c-icon c-icon-lg">
                                                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                                    </svg>
                                                </a>
                                                @if(isset($p['room_image']))
                                                    <button type="button" data-url="{{ route('search.ajax_product_delete') }}" data-name="{{ $p['articul'] }}" data-id="{{ $p['id'] }}" class="btn btn-danger js_delete_btn btn-square btn-sm" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                                        <svg class="c-icon c-icon-lg" title="O'chirish">
                                                            <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-trash') }}"></use>
                                                        </svg>
                                                    </button>
                                                @endif

                                                @if(isset($p['image']))
                                                    <button type="button" data-url="{{ route('search.ajax_product2_delete') }}" data-name="{{ $p['articul'] }}" data-id="{{ $p['id'] }}" class="btn btn-danger js_delete_btn btn-square btn-sm" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                                        <svg class="c-icon c-icon-lg" title="O'chirish">
                                                            <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-trash') }}"></use>
                                                        </svg>
                                                    </button>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @else
                        @if(isset($_POST['search_btn']))
                            <h6 class="text-center text-danger">Ma'lumot topilmadi</h6>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
