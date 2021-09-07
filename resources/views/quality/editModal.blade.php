<div class="modal fade" id="edit-model{{ $q->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-model-Lavel">{{ $q->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('quality.ajax_edit') }}" class="js_quality_edit_modal_from form-group" enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="id" value="{{ $q->id }}" >
                <input type="hidden" name="image_hidden" value="{{ $q->image }}" >

                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name{{ $q->id }}">Nomi</label>
                            <input type="text" name="name" id="name{{ $q->id }}" class="form-control" value="{{ old('name', $q->name) }}">
                            <div class="valid-feedback text-danger">
                                Ma'lumotni kiriting !
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="price{{ $q->id }}">Narxi</label>
                            <input type="text" name="price" id="price{{ $q->id }}" class="form-control" value="{{ $q->price }}">
                            <div class="valid-feedback text-danger">
                                Narxni kiriting !
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="image{{ $q->id }}">Rasmi</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="image{{ $q->id }}">
                                <label class="custom-file-label" for="image{{ $q->id }}">{{ $q->image }}</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="message"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Saqlash" class="btn btn-success btn-square">
                    <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Bekor qilish</button>
                </div>
            </form>
        </div>
    </div>
</div>
