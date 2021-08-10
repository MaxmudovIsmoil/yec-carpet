<div class="modal-body">
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
            <label for="image">Sifat rasmi</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image" id="image" multiple="true">
                <label class="custom-file-label" for="image">Rasmni yuklang</label>
            </div>
            <span class="valid-feedback text-danger image_error"></span>
        </div>
    </div>
</div>
<div class="modal-footer mt-3 pb-0">
    <button class="btn btn-success btn-square">Saqlash</button>
    <button type="button" class="btn btn-secondary js_modal_closeBtn btn-square" data-dismiss="modal">Bekor qilish</button>
</div>
