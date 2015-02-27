$('.skin-preview').hover(function () {
    $(this).attr('src', $(this).data('to'));
}, function () {
    $(this).attr('src', $(this).data('from'));
});