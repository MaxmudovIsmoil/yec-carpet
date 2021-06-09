@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body" style="position: relative;">
                    <a href="" class="btn btn-square btn-primary" data-toggle="modal" data-target="#add-model" style="position: absolute; z-index: 1;">Qo'shish</a>

                    {{-- Add Modal--}}
                    <div class="modal fade" id="add-model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add-model-Lavel">{{ 'Xona qo\'shish' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="post" action="{{ route('quality.ajax_add') }}" id="js_modal_add_form" class="form-group" enctype="multipart/form-data">

                                    @csrf
                                    <div class="modal-body text-left">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="name">Nomi</label>
                                                <input type="text" name="name" id="name" class="form-control">
                                                <div class="valid-feedback text-danger">
                                                    Ma'lumotni kiriting !
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="image">Rasm</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image" multiple="true" id="image">
                                                    <label class="custom-file-label" for="image">Rasm file...</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div id="message"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer mt-3 pb-0">
                                        <input type="submit" value="Saqlash" class="js_add_modal_btn btn btn-success btn-square">
                                        <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Bekor qilish</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table id="dataTable_staff" class="display bg-info" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="6%">№</th>
                                <th width="30%">Rasm</th>
                                <th>Nomi</th>
                                <th width="15%" class="text-right">Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($quality as $q)
                                <tr class="js_this_tr">
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="js_td_image dataTable-td-image">
                                        <a data-fancybox="gallery" style='background: url("{{ asset('uploaded/quality/'.$q->image) }}")' href="{{ asset('uploaded/quality/'.$q->image) }}"></a>
                                    </td>
                                    <td>
                                        <span class="js_room_name room-name">{{ $q->name }}</span>

                                        <form method="post" action="{{ route('quality.ajax_edit') }}" class="js_edit_from room-form-edit form-group d-none mb-0" enctype="multipart/form-data">

                                            @csrf
                                            <input type="hidden" name="id" value="{{ $q->id }}" >
                                            <input type="hidden" name="image_hidden" value="{{ $q->image }}" >
                                            <input type="text" name="name" value="{{ old('name', $q->name) }}" class="form-control col-md-4">
                                            <div class="js_image_div custom-file ml-3">
                                                <input type="file" class="custom-file-input" name="image" multiple="true" id="image{{ $q->id }}">
                                                <label class="custom-file-label" for="image{{ $q->id }}" data-img='{{ $q->image }}'>{{ $q->image }}</label>
                                            </div>
                                            <button class="js_edit_btn_save btn btn-success btn-sm btn-square ml-3" title="Saqlash">
                                                <svg class="c-icon c-icon-lg" title="Saqlash">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-check') }}"></use>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group js_btn_group" role="group" aria-label="Basic example">
                                            <a href="" class="js_edit_btn btn btn-info btn-square btn-sm" title="Тахрирлаш">
                                                <svg class="c-icon c-icon-lg">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                                </svg>
                                            </a>
                                            <a href="" class="js_edit_btn_back d-none btn btn-secondary btn-square btn-sm" title="Bekor qilish">
                                                <svg class="c-icon c-icon-lg" title="Bekor qilish">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-action-undo') }}"></use>
                                                </svg>
                                            </a>

                                            <button type="button" data-url="{{ route('quality.destroy', [$q->id]) }}" data-name="{{ $q->name }}" class="btn btn-danger js_delete_btn btn-square btn-sm" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
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
                </div>
            </div>

        </div>
    </div>

@endsection
