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
                    <label for="room_image{{$product['id']}}">Xona rasmi</label>
                    <div class="custom-file">
                        <input type="hidden" name="room_image_hidden" value="{{ $product['room_image'] }}">
                        <input type="file" class="custom-file-input" name="room_image" id="room_image{{$product['id']}}">
                        <label class="custom-file-label" for="room_image{{$product['id']}}">{{ $product['room_image'] }}</label>
                    </div>
                    <span class="valid-feedback text-danger invalid_room_image">Rasmni yuklang</span>
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
