<div class="modal" id="change_password_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="change_password_modal_form">
                @csrf
                <div class="modal-header">
                    <h4 id="modal-title" class="modal-title">Modificar contraseña</h4>
                    <button id="close_change_password_modal" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-window-close blue-text"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="msg text-center alert"></p>
                    <div id="current_password" class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña actual') }}</label>

                        <div class="col-md-6">
                            <input id="password" name="password" type="password" item_id="0" autocomplete>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('Nueva Contraseña') }}</label>

                        <div class="col-md-6">
                            <input id="new_password" name="new_password" type="password" autocomplete>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar') }}</label>
                        <div class="col-md-6">
                            <input id="new_password_confirmation" 
                            name="new_password_confirmation" type="password" autocomplete>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" id="modal-update-password-btn">
                        Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
