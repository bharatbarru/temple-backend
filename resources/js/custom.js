import { TempusDominus } from '@eonasdan/tempus-dominus';

// active and open dropdown menu if child is active
$(function () {
    $('.nav-treeview .nav-link.active').parents('.nav-item').addClass('menu-open');
    $('.nav-treeview .nav-link.active').parents('.nav-item').children('a').addClass('active');

    $('.nav-item').on('click', function () {
        // Close other open menus
        $('.nav-item').not(this).removeClass('menu-open');
        $('.nav-treeview').not($(this).find('.nav-treeview')).css('display', 'none');
    });
});

$("form").parsley();

$(".select2").select2({
    allowClear: true,
});

var letters = /^[A-Za-z\s]+$/;
var digits = /^[0-9]+$/;
var numbers = /^[0-9.]+$/;
$(".letters-input").on("keypress", function (event) {
    var key = String.fromCharCode(event.which);
    if (!letters.test(key)) {
        event.preventDefault();
    }
});
$(".letters-input").on("input", function () {
    var value = $(this).val();
    if (!letters.test(value)) {
        $(this).val(value.replace(/[^A-Za-z\s]/g, ""));
    }
});

$(".digits-input").on("keypress", function (event) {
    var key = String.fromCharCode(event.which);
    if (!digits.test(key)) {
        event.preventDefault();
    }
});
$(".digits-input").on("input", function () {
    var value = $(this).val();
    if (!digits.test(value)) {
        $(this).val(value.replace(/[^0-9]/g, ""));
    }
});

$(".numbers-input").on("keypress", function (event) {
    var key = String.fromCharCode(event.which);
    if (!numbers.test(key)) {
        event.preventDefault();
    }
});
$(".numbers-input").on("input", function () {
    var value = $(this).val();
    if (!numbers.test(value)) {
        $(this).val(value.replace(/[^0-9.]/g, ""));
    }
});

$('input[type="file"]').on("change", function (e) {
    var fileName = e.target.files[0].name;
    $(this).next(".custom-file-label").html(fileName);
});

window.Parsley.addValidator("maxFileSize", {
    validateString: function (_value, maxSize, parsleyInstance) {
        if (!window.FormData) {
            alert(
                "You are making all developpers in the world cringe. Upgrade your browser!"
            );
            return true;
        }
        var files = parsleyInstance.$element[0].files;
        return files.length != 1 || files[0].size <= maxSize * 1024;
    },
    requirementType: "integer",
    messages: {
        en: "This file should not be larger than %s Kb",
        fr: "Ce fichier est plus grand que %s Kb.",
    },
});

window.ParsleyValidator.addValidator(
    "fileextension",
    function (value, requirement) {
        var fileExtension = value.split(".").pop();

        return fileExtension === requirement;
    },
    32
).addMessage("en", "fileextension", "Upload only csv file to import");

$(function () {
    // Basic instantiation:
    $('.colorpicker').colorpicker({
        container: true,
        customClass: 'colorpicker-2x',
        readOnly: false,
        autoInputFallback: false,
        allowEmpty: true,
    });
    $('.colorpicker').on('colorpickerChange', function (event) {
        var id = $(this).attr('id').replace('colorpicker', '');
        $('#colorpicker' + id + ' .fa-square').css('color', event.color.toString());
    });
});

function dateFormater() {
    const elements1 = document.getElementsByClassName('dateonlypicker');
    // Iterate over the collection of elements
    Array.from(elements1).forEach(element => {
        new TempusDominus(element, {
            useCurrent: false,
            display: {
                components: {
                    clock: false
                }
            },
            localization: {
                locale: 'en',
                format: 'dd MMMM yyyy',
            }
        });
    });
}
dateFormater();


//datetimepicker code
const elements = document.getElementsByClassName('datetimepicker');
// Iterate over the collection of elements
Array.from(elements).forEach(element => {
    new TempusDominus(element, {
        useCurrent: false,
        display: {
            sideBySide: true,
        },
        localization: {
            locale: 'en',
            format: 'dd MMMM yyyy hh:mm T',
        },
    });
});

// Disable text entering for the date input
$('.dateonlypicker').on('keypress paste', function (e) {
    e.preventDefault();
});


$(".ajax-popup-link").magnificPopup({
    type: "ajax",
    mainClass: "modal-style",
    midClick: true,
    closeOnBgClick: true,
    showCloseButton: true
});
