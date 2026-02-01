const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
const Default = {
    scrollbarTheme: 'os-theme-light',
    scrollbarAutoHide: 'leave',
    scrollbarClickScroll: true,
};
document.addEventListener('DOMContentLoaded', function () {
    const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

    // Disable OverlayScrollbars on mobile devices to prevent touch interference
    const isMobile = window.innerWidth <= 992;

    if (
        sidebarWrapper &&
        OverlayScrollbars?.OverlayScrollbars !== undefined &&
        !isMobile
    ) {
        OverlayScrollbars.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
                theme: Default.scrollbarTheme,
                autoHide: Default.scrollbarAutoHide,
                clickScroll: Default.scrollbarClickScroll,
            },
        });
    }
});

$(function () {
    $('.select2').select2();


    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-full-width",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "slideDown",
        "hideMethod": "slideUp"
    }

    function updateCKEditors() {
        for(let editor in CKEDITOR.instances) {
            CKEDITOR.instances[editor].updateElement();
        }
    }

    $('.ajax-form').on('submit', function (e) {
        e.preventDefault();

        updateCKEditors();

        let form = $(this);
        let btn = form.find('button[type=submit]');
        let btnText = btn.text();
        let action = form.attr('action');
        let method = form.attr('method');
        if (method) {
            method = method.toLowerCase();
        }

        $.ajax({
            url: action,
            type: method === 'get' ? 'get' : 'post',
            data: form.serialize(),
            beforeSend: function () {
                btn.prop('disabled', true).text('sending...');
            },
            success: function (res) {
                if (res.status === 'success') {

                    if(res.redirect) {
                        toastr.options.onHidden = function() {
                            location = res.redirect;
                        }
                    }
                    toastr.success(res.data);

                    if(res.clear) {
                        form.trigger('reset');
                    }
                }
            },
            error: function (data) {
                if (data.status === 422) {
                    let errors = data.responseJSON;
                    let output = "<ul>";
                    $.each(errors.errors, function (key, value) {
                        output += `<li>${value[0]}</li>`;
                    });
                    output += '</ul>';
                    toastr.error(output);
                } else {
                    // alert('Error');
                }
                console.log(data);
            },
            complete: function () {
                btn.prop('disabled', false).text(btnText);
            }
        });
    });

    // toastr.success('have fun storming the castle!', 'Miracle Max says');

})