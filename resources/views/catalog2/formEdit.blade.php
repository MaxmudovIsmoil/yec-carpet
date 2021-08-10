<input type="hidden" name="id" value="{{ $product['id'] }}">
<div class="modal-body">
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
            <label for="image{{$product['id']}}">Sifat rasmi</label>
            <div class="custom-file">
                <input type="hidden" name="image_hidden" value="{{ $product['image'] }}">
                <input type="file" class="custom-file-input" name="image" id="image{{$product['id']}}">
                <label class="custom-file-label" for="image{{$product['id']}}">{{ $product['image'] }}</label>
            </div>
            <span class="valid-feedback text-danger invalid_image">Rasmni yuklang</span>
        </div>
    </div>
</div>
<div class="modal-footer mt-3 pb-0">
    <button class="btn btn-success btn-square">Saqlash</button>
    <button type="button" class="btn btn-secondary js_modal_closeBtn btn-square" data-dismiss="modal">Bekor qilish</button>
</div>
