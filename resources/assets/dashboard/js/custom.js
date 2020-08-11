
//--------------------------------------------------------------------------
// Sortable functions

var changePosition = function(requestData, action) {
    $.ajax({
        'url': action,
        'type': 'POST',
        'data': requestData,
        'success': function(data) {
            if (! data.success) {
                console.error(requestData, action, data.errors);
            }
        },
        'error': function() {
            console.error('Sortable: Order change failed!');
        }
    });
};

function sortableMove(a, b, entityName, action) {
    var $sorted = b.item;

    var $previous = $sorted.prev();
    var $next = $sorted.next();

    if ($previous.length > 0) {
        changePosition({
            parentId: $sorted.data('parent-id'),
            type: 'moveAfter',
            entityName: entityName,
            id: $sorted.data('item-id'),
            positionEntityId: $previous.data('item-id')
        }, action);
    } else if ($next.length > 0) {
        changePosition({
            parentId: $sorted.data('parent-id'),
            type: 'moveBefore',
            entityName: entityName,
            id: $sorted.data('item-id'),
            positionEntityId: $next.data('item-id')
        }, action);
    } else {
        console.error('Sortable: Something wrong!');
    }
}

$(document).ready(function() {

    //--------------------------------------------------------------------------
    // CSRF-token

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //--------------------------------------------------------------------------
    // Feather icons

    feather.replace({
        width  : 16,
        height : 16
    });

    //--------------------------------------------------------------------------
    // Alerts disappearance

    var $alerts = $('.alert');
    if ($alerts.length) {
        window.setTimeout(function() {
            $alerts.closest('.pgn-wrapper').fadeOut();
        }, 4000);
    }

    //--------------------------------------------------------------------------
    // Modals

    // Action confirmation:
    $('#modalConfirm').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            link   = button.data('link'),
            method = button.data('method') ? button.data('method') : 'post',
            modal  = $(this),
            form   = modal.find('#confirmForm');
        form.attr('action', link);
        form.attr('method', method);
    });

    // Loading:
    $('form.with-loading :submit').click(function () {
        var $form = $(this).closest('form');
        if ($form.length > 0 && $form[0].checkValidity()) {
            $('#modalLoading').modal('show');
        }
    });

    //--------------------------------------------------------------------------
    // Sortable

    // Simple lists:
    var $sortableBlocks = $('.sortable');
    $sortableBlocks.each(function() {
        var $block = $(this);
        $block.sortable({
            handle: '.list-group-handler',
            axis: 'y',
            update: function(a, b){
                sortableMove(a, b, $block.data('entity'), $block.data('action'));
            },
            placeholder: "list-placeholder",
            cursor: "move",
            items: "> li"
        });
    });

    //--------------------------------------------------------------------------
    // DataTables

    // General settings:
    var settings = {
        "sDom": "<'table-responsive't><'row'<p i>>",
        "sPaginationType": "bootstrap",
        "destroy": true,
        "scrollCollapse": true,
        "oLanguage": {
            "sLengthMenu": "_MENU_ ",
            "sInfo": "Показаны с <b>_START_ по _END_</b> из _TOTAL_ записей",
            "sZeroRecords": "Нет записей",
            "sInfoEmpty": "Нечего отображать",
            "sInfoFiltered": "(отфильтровано из _MAX_ записей)",
            "oPaginate": {
                "sPrevious": "Предыдущая",
                "sNext": "Следующая",
                "sLast": "Последняя",
                "sFirst": "Первая"
            }
        },
        "iDisplayLength": 20
    };

    // All tables init:
    $(".datatable").each(function () {
        var table = $(this),
            ownSettings = settings,
            searchInput = table.parent().parent().find('.search-table').first();

        if (table.data('sort-column') && table.data('sort-order')) {
            ownSettings['order'] = [[ table.data('sort-column'), table.data('sort-order') ]];
        }
        else {
            ownSettings["aaSorting"] = [];
        }
        table.dataTable(ownSettings);

        if (searchInput.length) {
            searchInput.keyup(function() {
                table.fnFilter($(this).val());
            });
        }
    });

    //--------------------------------------------------------------------------
    // Bootstrap-like file input

    $('.file-input').bootstrapFileInput();

    //--------------------------------------------------------------------------
    // Image input preview

    $(".image-input").change(function() {
        var input = this,
            result = $(this).closest('.form-group').find(".image-preview");
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                result.attr('src', e.target.result);
                result.data('src', e.target.result);
                result.show();
            };

            reader.readAsDataURL(input.files[0]);
        }
        else {
            result.attr('src', result.data('placeholder'));
        }
    });

    //--------------------------------------------------------------------------
    // Checkboxes for image/file inputs clear

    $('.remove-image-checkbox').change(function() {
        var checkbox = $(this),
            input = checkbox.closest('.form-group').find(".image-input"),
            preview = checkbox.closest('.form-group').find(".image-preview");
        if (checkbox.is(':checked')) {
            preview.attr('src', preview.data('placeholder'));
            input.addClass('disabled');
        }
        else {
            preview.attr('src', preview.data('src'));
            input.removeClass('disabled');
        }
    });

    $('.remove-file-checkbox').change(function() {
        var checkbox = $(this),
            input = checkbox.closest('.form-group').find(".file-input");
        if (checkbox.is(':checked')) {
            input.addClass('disabled');
        }
        else {
            input.removeClass('disabled');
        }
    });

    //--------------------------------------------------------------------------
    // Textareas autosizing

    autosize($('textarea:not(.not-resized)'));

    //--------------------------------------------------------------------------
    // Datepicker

    $('.dateonlypicker').datetimepicker({
        lang: 'ru',
        timepicker: false,
        format: 'd.m.Y',
        scrollInput: false,
        dayOfWeekStart: 1
    });

    //--------------------------------------------------------------------------
    // Timepicker

    $('.timepicker').datetimepicker({
        lang: 'ru',
        timepicker: true,
        datepicker:false,
        format: 'H:i',
        scrollInput: false,
        dayOfWeekStart: 1,
        step: 10
    });

    //--------------------------------------------------------------------------
    // Datetimepicker

    $('.datetimepicker').datetimepicker({
        lang: 'ru',
        timepicker: true,
        format: 'd.m.Y H:i',
        scrollInput: false,
        dayOfWeekStart: 1
    });

    //--------------------------------------------------------------------------
    // Disabling number inputs scroll and form submit on Enter

    $('form').on('focus', 'input[type=number]', function (e) {
        $(this).on('mousewheel.disableScroll', function (e) {
            e.preventDefault()
        })
    }).on('blur', 'input[type=number]', function (e) {
        $(this).off('mousewheel.disableScroll')
    });

    $('form:not(.enter-submit) input').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    //--------------------------------------------------------------------------
    // Select2

    $('.select2tags').each(function() {
        var source = $(this).data('source') ? $(this).data('source').split(",") : [];
        $(".select2tags").select2({
            tags: source,
            tokenSeparators: [","],
            placeholder: function() {
                $(this).data('placeholder');
            }
        });
    });

});
