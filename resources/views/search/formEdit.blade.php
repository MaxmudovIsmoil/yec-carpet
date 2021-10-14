<div class="modal fade" id="edit-model_{{ $p['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-model-Lavel">{{ $p['articul'] }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('catalog.ajax_edit',[$p['id']]) }}" class="js_search_product_edit_btn form-group mb-0" enctype="multipart/form-data">

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
                                <div class="col-md-6 mb-3">
                                    <label for="articul{{ $p['id'] }}">Artikul</label>
                                    <input type="text" name="articul" id="articul{{ $p['id'] }}" class="form-control" value="{{ $p['articul'] }}">
                                    <span class="valid-feedback text-danger articul_error"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="code{{$p['id']}}">Kodi</label>
                                    <input type="text" name="code" id="code{{$p['id']}}" class="form-control" value="{{ $p['code'] }}">
                                    <span class="valid-feedback text-danger code_error"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="room_image{{$p['id']}}">Xona rasmi</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="room_image_hidden" value="{{ $p['room_image'] }}">
                                        <input type="file" class="custom-file-input" name="room_image" id="room_image{{$p['id']}}">
                                        <label class="custom-file-label" for="room_image{{$p['id']}}">{{ $p['room_image'] }}</label>
                                    </div>
                                    <span class="valid-feedback text-danger invalid_room_image">Rasmni yuklang</span>
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
                            </div>
                            <span class="text-danger room_checkbox_error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-3 pb-2">
                    <button class="btn btn-success btn-square">Saqlash</button>
                    <button type="button" class="btn btn-secondary js_modal_closeBtn btn-square" data-dismiss="modal">Bekor qilish</button>
                </div>
            </form>

        </div>
    </div>
</div>

