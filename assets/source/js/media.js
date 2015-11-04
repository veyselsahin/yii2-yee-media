function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

$(document).ready(function () {
    var ajaxRequest = null,
        fileInfoContainer = $("#fileinfo"),
        strictThumb = $(window.frameElement).parents('[role="media-modal"]').attr("data-thumb");

    function setAjaxLoader() {
        $("#fileinfo").html('<div class="loading"><span class="glyphicon glyphicon-refresh spin"></span></div>');
    }

    $('[href="#mediafile"]').on("click", function (e) {
        e.preventDefault();

        if (ajaxRequest) {
            ajaxRequest.abort();
            ajaxRequest = null;
        }

        $(".item a").removeClass("active");
        $(this).addClass("active");

        var id = $(this).attr("data-key"),
            url = $("#media").attr("data-url-info"),
            mode = $("#media").attr("data-frame-mode");

        ajaxRequest = $.ajax({
            type: "GET",
            url: url,
            data: "id=" + id + "&strictThumb=" + strictThumb + "&mode=" + mode,
            beforeSend: function () {
                setAjaxLoader();
            },
            success: function (html) {
                $("#fileinfo").html(html);
                $(document).trigger("mediaDetailsLoaded");
            }
        });
    });

    fileInfoContainer.on("click", '[role="delete"]', function (e) {
        e.preventDefault();

        var url = $(this).attr("href"),
            id = $(this).attr("data-id"),
            confirmMessage = $(this).attr("data-message");

        $.ajax({
            type: "POST",
            url: url,
            data: "id=" + id,
            beforeSend: function () {
                if (!confirm(confirmMessage)) {
                    return false;
                }
                $("#fileinfo").html('<div class="loading"><span class="glyphicon glyphicon-refresh spin"></span></div>');
            },
            success: function (json) {
                if (json.success) {
                    $("#fileinfo").html('');
                    $('[data-key="' + id + '"]').fadeOut();
                }
            }
        });
    });

    fileInfoContainer.on("submit", "#control-form", function (e) {
        e.preventDefault();

        var url = $(this).attr("action"),
            data = $(this).serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            beforeSend: function () {
                setAjaxLoader();
            },
            success: function (html) {
                $("#fileinfo").html(html);
                $(document).trigger("mediaDetailsLoaded");
            }
        });
    });
});