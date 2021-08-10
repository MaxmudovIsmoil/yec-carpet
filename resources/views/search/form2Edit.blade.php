<div class="modal fade" id="edit-model_{{ $p['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-model-Lavel">{{ $p['articul'] }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('catalog2.ajax_edit',[$p['id']]) }}" class="js_search_product_edit_btn form-group mb-0" enctype="multipart/form-data">

                <input type="hidden" name="id" value="{{ $p['id'] }}">
                <div class="modal-body">
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
                            <label for="image{{$p['id']}}">Sifat rasmi</label>
                            <div class="custom-file">
                                <input type="hidden" name="image_hidden" value="{{ $p['image'] }}">
                                <input type="file" class="custom-file-input" name="image" id="image{{$p['id']}}">
                                <label class="custom-file-label" for="image{{$p['id']}}">{{ $p['image'] }}</label>
                            </div>
                            <span class="valid-feedback text-danger invalid_image">Rasmni yuklang</span>
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
