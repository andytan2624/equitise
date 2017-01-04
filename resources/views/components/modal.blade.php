<!--Modal-->
<div
        class="modal fade"
        id="{{ $id }}"
        tabindex="-1"
        role="dialog"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {!! $message or '' !!}
            </div>
            <div class="modal-footer">
                <button class="modal-confirm-btn"
                        type="{{ $confirmButtonType or 'submit' }}"
                >
                    <span class="confirm-modal-content">{{ $confirm or 'Confirm' }}</span>
                </button>

                <button type="button" data-dismiss="modal">{{ $cancel or 'Cancel' }}</button>
            </div>
        </div>
    </div>
</div>
<!--/Modal-->
