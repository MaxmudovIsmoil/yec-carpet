<div class="modal fade" id="edit_model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-model-Lavel">Taxrirlash</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('salesman.update', [$user[0]->id]) }}" class="js_salesman_update form-group">

                @csrf
                {{ method_field('PUT') }}

                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="username">Login</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $user[0]->username) }}" required>
                            <div class="valid-feedback text-danger">
                                Loginni kiriting !
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="password">Parol</label>
                            <input type="text" name="password" id="password" class="form-control" value="{{ $user[0]->phone }}" required>
                            <div class="valid-feedback text-danger">
                                Parolni kiriting !
                            </div>
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
