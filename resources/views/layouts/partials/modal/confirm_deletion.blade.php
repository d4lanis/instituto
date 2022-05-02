<a id="confirm_deletion_link" type="hidden" data-toggle="modal" data-target="#confirm_deletion">
</a>
<div class="modal" id="confirm_deletion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div id="modal-delete-title" class="modal-title"></div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-window-close blue-text"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>{{$modal_question}}</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{route($route.'.delete', 'confirm_deletion_item_id')}}" 
                    id="confirm_modal_deletion_buttons_form">

                    @csrf

                    <button type="button" class="btn btn-sm btn-default blank" data-dismiss="modal">Cancelar <i class="fa fa-undo ml-1"></i></button>
                    <button type="submit" class="btn btn-sm btn-danger" 
                    id="modal-delete-btn">
                        Eliminar <i class="fa fa-trash ml-1"></i></button>
                 </form>
            </div>
        </div>
    </div>
</div>