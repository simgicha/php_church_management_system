$("#busyIndicator").ajaxStart(function () {
    $("#busyIndicator").css("display", "block");
});

$("#busyIndicator").ajaxStop(function () {
    $("#busyIndicator").css("display", "none");
});

