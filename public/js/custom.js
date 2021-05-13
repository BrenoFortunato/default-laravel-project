// Initialize select2
$.fn.select2.defaults.set("language", "pt-BR");
$.fn.select2.defaults.set("placeholder", "Selecionar");

// Initialize bootstrap switch
$("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch("state", $(this).prop("checked"));
});

// Initialize custom file input
$(document).ready(function() {
    bsCustomFileInput.init();
});

// Initialize loading overlay
function showLoading() {
    $.LoadingOverlay("show", {
        // image            : "",
        imageColor       : "#ccc",
        // text             : customText,
        // textResizeFactor : 0.2,
        // textColor        : "#fff",
        background       : "rgba(0, 0, 0, 0.5)",
        fade             : [200, 200],
    });
}
function hideLoading() {
    $.LoadingOverlay("hide");
}

// Tooltip
$(document).tooltip({
    selector: "[data-toggle='tooltip']",
    container: "body",
    placement: "top",
    boundary: "window",
    html: true,
});

// Toggle logo on menu toggle or resize
function toggleLogo() {
    if ($(document.body).hasClass("sidebar-closed") || $(document.body).hasClass("sidebar-collapse")) {
        $(".brand-image").attr("src", "/images/icon_white.png");
    } else {
        $(".brand-image").attr("src", "/images/logo_white.png");
    }
}
$(window).on("resize", function(){
    clearTimeout(window.resizedFinished);
    window.resizedFinished = setTimeout(function(){
        toggleLogo();
    }, 250);   
});
$(document).on("click", "[data-widget='pushmenu']", function() {
    toggleLogo();
});

// AJAX flash message
$(document).ready(function() {
    $(".content").prepend("<div class='alert-ajax'></div>");
});

// File selected
$(document).on("change", "input[type=file]", function() {
    // Preview image upload
    if (this.files && this.files[0]) {
        let reader = new FileReader();
        let elem = $(this).parent().parent().find("img");
        reader.onload = function (e) {
            elem.attr("src", e.target.result);
            elem.addClass("img-thumbnail")
        }
        reader.readAsDataURL(this.files[0]);
        $(this).next("label").text(this.files[0].name);
    }

    // Update placeholder color
    $(this).next("label").css("color", "#495057");
});
$(window).on("load", function(){
    setTimeout(function() {
        $(".custom-file-label").each(function(){
            let text = $(this).text();
            if (text.indexOf("...") === -1) {
                $(this).css("color", "#495057");
            }
        });   
    }, 100);
});

// Confirm message
function confirmMessage(e) {
    e.preventDefault();
    let target = e.target;
    if ($(target).is("i")) {
        target = $(target).closest("button")[0];
    }
    Swal.fire({
        icon: "question",
        title: confirmationTitle,
        text: confirmationText,
        confirmButtonText: confirmButton,
        cancelButtonText: cancelButton,
        showCloseButton: true,
        showConfirmButton: true,
        showCancelButton: true,
        focusConfirm: false,
        buttonsStyling: false,
        customClass: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default",
        }
    }).then((result) => {
        if (result.value) {
            showLoading();
            $(target).removeAttr("onclick").trigger("click");
        }
    });
}

// Convert \n to <br>
function nl2br(str) {
    var breakTag = "<br>";
    return (str + "").replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "$1" + breakTag + "$2");
}

// Format text as money
function formatMoney(value){
    return (value!=undefined)? parseFloat(value).toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2, style: "currency", currency: "BRL" }) : null;
}

// Format text as percentage
function formatPercentage(value){
    return (value!=undefined)? parseFloat(value).toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2, style: "percent" }) : null;
}

// Format text as decimal
function formatDecimal(value){
    return (value!=undefined)? parseFloat(value).toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2, style: "decimal" }) : null;
}

// Format text as integer
function formatInteger(value){
    return (value!=undefined)? parseInt(value).toLocaleString("pt-BR", { minimumFractionDigits: 0, maximumFractionDigits: 0, style: "decimal" }) : null;
}