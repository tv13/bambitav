/**
 * Created by aleks on 11.02.16.
 */


var bootstrap_alert = {
    warning: function (message, id) {
        $('#alert_placeholder' + id).html('<div class="alert alert-danger" id="upload-danger"><a class="close custom_close" data-dismiss="alert">×</a><span>' + message + '</span></div>')
    },
    success: function (message, id) {
        $('#alert_placeholder' + id).html('<div class="alert alert-success" id="upload-success"><a class="close custom_close" data-dismiss="alert">×</a><span>' + message + '</span></div>')
    }
};