<div class="modal fade" id="add-model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-model-Lavel">{{ 'Sifat qo\'shish' }}</h5>
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
                            <label for="price">Narxi</label>
                            <input type="text" name="price" id="price" class="form-control">
                            <div class="valid-feedback text-danger">
                                Narxni kiriting !
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="image">Rasmi</label>
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
