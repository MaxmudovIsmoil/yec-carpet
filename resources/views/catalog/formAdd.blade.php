<div class="modal-body">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="quality_id">Sifat</label>
                    <select type="text" name="quality_id" id="quality_id" class="form-control">
                        <option value="">---</option>
                        @foreach($qualities as $q)
                            <option value="{{ $q->id }}">{{ $q->name }}</option>
                        @endforeach
                    </select>
                    <span class="valid-feedback text-danger room_id_error"></span>
                </div>
                <div class="col-md-6 mb-4">
                    <label for="articul">Artikul</label>
                    <input type="text" name="articul" id="articul" class="form-control">
                    <span class="valid-feedback text-danger articul_error"></span>
                </div>
                <div class="col-md-6 mb-4">
                    <label for="code">Kodi</label>
                    <input type="text" name="code" id="code" class="form-control">
                    <span class="valid-feedback text-danger code_error"></span>
                </div>
                <div class="col-md-6 mb-4">
                    <label for="room_image">Xona rasmi</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="room_image" id="room_image">
                        <label class="custom-file-label" for="room_image">Xona rasmni yuklang</label>
                    </div>
                    <span class="valid-feedback text-danger room_image_error"></span>
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
