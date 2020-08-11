<div class="modal fade slide-up disable-scroll show" id="modalLoading" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-body p-t-5 p-b-20 text-center">
                    <div class="progress-circle-indeterminate m-t-10 m-b-10" data-pages-progress="circle" data-color="complete" data-thick="true"></div>
                    <span class="fs-15 light">Выполняется...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade slide-up disable-scroll show" id="modalConfirm" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-body text-center m-t-20">
                    <h4 class="no-margin p-b-20">Вы уверены?</h4>
                    <form action="#" method="post" id="confirmForm" class="inline no-margin">
                        {!! csrf_field() !!}
                    </form>
                    <div class="btn-group">
                        <button form="confirmForm" class="btn btn-sm btn-primary btn-cons no-margin">Да</button>
                        <button type="button" class="btn btn-sm btn-default btn-cons no-margin" data-dismiss="modal">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
