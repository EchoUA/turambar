/**
 * Created by Siada-Apius on 14.04.2016.
 */
$(document).ready(function () {
    var row =  '<div class="row">' +
        '<div class="col-md-5">' +
        '<div class="form-group">' +
        '<input type="text" name="key[]" placeholder="key" class="form-control">' +
        '</div>' +
        '</div>' +
        '<div class="col-md-5">' +
        '<div class="form-group">' +
        '<input type="text" name="value[]" placeholder="value" class="form-control">' +
        '</div>' +
        '</div>' +
        '<div class="col-md-2 help-block">' +
        '<div class="form-group">' +
        '<span class="glyphicon glyphicon-remove remove_row" role="button"></span>' +
        '</div>' +
        '</div>' +
        '</div>';

    $('select[name=method]').change(function() {
        var _this = $(this);

        if (_this.val() != 'GET') {
            if ($('.additional_fields').find('.row').length == 0) {
                $('.additional_fields').append(row);
            }
        } else {
            $('.additional_fields').find('.row').remove();
        }
    });

    $(document).on('focus', 'input[name="key[]"]', function() {
        $('.additional_fields').append(row);
    });

    $(document).on('click', '.remove_row', function() {
        var _this = $(this);

        _this.closest('div.row').remove();
    });
});