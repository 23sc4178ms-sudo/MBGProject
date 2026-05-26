$(function () {
    var adminPaths = [
        '/home',
        '/dashboard',
        '/students',
        '/users',
        '/degrees',
        '/courses',
        '/course-enrollments',
        '/profiles',
        '/posts',
        '/maintenance',
        '/about',
        '/pdf',
        '/upload',
        '/excel'
    ];

    var excludedPaths = [
        '/login',
        '/logout'
    ];

    function isAdminPage() {
        return $('body').data('auth-role') === 'admin';
    }

    function parseUrl(url) {
        try {
            return new URL(url, window.location.origin);
        } catch (e) {
            return null;
        }
    }

    function isManagedUrl(url) {
        var parsed = parseUrl(url);

        if (!parsed || parsed.origin !== window.location.origin) {
            return false;
        }

        var path = parsed.pathname;

        if (excludedPaths.some(function (excluded) {
            return path === excluded || path.indexOf(excluded + '/') === 0;
        })) {
            return false;
        }

        if (path.indexOf('/change-password') !== -1 || path.indexOf('/first-login') !== -1) {
            return false;
        }

        return adminPaths.some(function (adminPath) {
            return path === adminPath || path.indexOf(adminPath + '/') === 0;
        });
    }

    function contentTarget(context) {
        var $context = context ? $(context) : $(document);
        var $target = $context.find('main .container').first();

        if (!$target.length) {
            $target = $context.find('main').first();
        }

        return $target;
    }

    function ensureFlashArea() {
        var $container = contentTarget();
        var $area = $container.find('[data-ajax-flash]').first();

        if (!$area.length) {
            $area = $('<div data-ajax-flash></div>');
            $container.prepend($area);
        }

        return $area;
    }

    function showMessage(message, type) {
        if (!message) {
            return;
        }

        var isError = type === 'error';
        var $alert = $('<div class="ajax-alert" role="alert"></div>')
            .text(message)
            .css({
                padding: '1rem',
                marginBottom: '1rem',
                borderRadius: '6px',
                borderLeft: '4px solid ' + (isError ? '#dc2626' : '#16a34a'),
                background: isError ? '#fef2f2' : '#f0fdf4',
                color: isError ? '#991b1b' : '#166534',
                fontWeight: 600
            });

        ensureFlashArea().html($alert);
    }

    function setLoading(isLoading) {
        contentTarget().css('opacity', isLoading ? '0.55' : '1');
        contentTarget().css('pointer-events', isLoading ? 'none' : '');
    }

    function updateActiveMenu() {
        $('.menu a').each(function () {
            var link = parseUrl($(this).attr('href'));

            if (!link) {
                return;
            }

            var current = window.location.pathname;
            var target = link.pathname;
            var active = current === target || (target !== '/dashboard' && current.indexOf(target + '/') === 0);

            $(this).toggleClass('active', active);
        });
    }

    function replaceContentFromHtml(html, url, pushState, flash) {
        var doc = new DOMParser().parseFromString(html, 'text/html');

        var nextContent = contentTarget(doc).html();
        var nextTitle = $(doc).find('title').text();

        if (!nextContent) {
            window.location.href = url;
            return;
        }

        contentTarget().html(nextContent);

        if (nextTitle) {
            document.title = nextTitle;
        }

        if (pushState) {
            window.history.pushState({ ajaxPage: true }, document.title, url);
        }

        updateActiveMenu();

        if (flash && flash.message) {
            showMessage(flash.message, flash.type || 'success');
        }

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function loadPage(url, pushState, flash) {
        if (!isManagedUrl(url)) {
            window.location.href = url;
            return;
        }

        setLoading(true);

        $.ajax({
            url: url,
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).done(function (html) {
            replaceContentFromHtml(html, url, pushState, flash);
        }).fail(function () {
            window.location.href = url;
        }).always(function () {
            setLoading(false);
        });
    }

    function clearErrors($form) {
        $form.find('.ajax-field-error').remove();
        $form.find('.is-invalid').removeClass('is-invalid');
    }

    function showValidationErrors($form, errors) {
        $.each(errors || {}, function (field, messages) {
            var name = field.replace(/\./g, '\\.');
            var $field = $form.find('[name="' + name + '"]').first();
            var text = $.isArray(messages) ? messages[0] : messages;

            if (!$field.length) {
                return;
            }

            $field.addClass('is-invalid');
            $('<div class="ajax-field-error"></div>')
                .text(text)
                .css({
                    color: '#dc2626',
                    fontSize: '0.85rem',
                    marginTop: '0.35rem',
                    fontWeight: 600
                })
                .insertAfter($field);
        });
    }

    function submitForm($form) {
        var action = $form.attr('action') || window.location.href;

        if (!isManagedUrl(action)) {
            $form.off('submit.ajaxAdmin');
            $form.trigger('submit');
            return;
        }

        clearErrors($form);

        var formData = new FormData($form[0]);
        var method = ($form.attr('method') || 'GET').toUpperCase();
        var $buttons = $form.find('[type="submit"]');

        $buttons.prop('disabled', true).css('opacity', '0.7');

        $.ajax({
            url: action,
            method: method,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || ''
            }
        }).done(function (response) {
            loadPage(response.redirect || window.location.href, true, {
                message: response.message || 'Saved successfully.',
                type: 'success'
            });
        }).fail(function (xhr) {
            var response = xhr.responseJSON || {};
            var message = response.message || 'Something went wrong. Please check the form and try again.';

            showMessage(message, 'error');

            if (xhr.status === 422) {
                showValidationErrors($form, response.errors);
            }
        }).always(function () {
            $buttons.prop('disabled', false).css('opacity', '');
        });
    }

    function showUploadMessage($form, message, type) {
        var isError = type === 'error';
        var $card = $form.closest('.card-body');
        var $message = $card.find('[data-upload-message]').first();

        if (!$message.length) {
            $message = $('<div data-upload-message></div>');
            $card.prepend($message);
        }

        $message.html(
            $('<div class="alert"></div>')
                .addClass(isError ? 'alert-danger' : 'alert-success')
                .text(message)
        );
    }

    function submitUploadForm($form) {
        clearErrors($form);

        var action = $form.attr('action') || window.location.href;
        var formData = new FormData($form[0]);
        var $buttons = $form.find('[type="submit"]');
        var $card = $form.closest('.card-body');

        $buttons.prop('disabled', true).css('opacity', '0.7');

        $.ajax({
            url: action,
            method: ($form.attr('method') || 'POST').toUpperCase(),
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || ''
            }
        }).done(function (response) {
            showUploadMessage($form, response.message || 'Image uploaded successfully.', 'success');

            if (response.uploaded_image) {
                $card.find('[data-upload-preview]').html(
                    $('<img>', {
                        src: response.uploaded_image,
                        alt: 'Uploaded image'
                    }).css({
                        width: '150px',
                        height: '150px',
                        objectFit: 'cover',
                        borderRadius: '10px',
                        marginTop: '1rem',
                        border: '1px solid var(--border)'
                    })
                );
            }

            $form[0].reset();
        }).fail(function (xhr) {
            var response = xhr.responseJSON || {};
            var message = response.message || 'Upload failed. Please check the image and try again.';

            showUploadMessage($form, message, 'error');

            if (xhr.status === 422) {
                showValidationErrors($form, response.errors);
            }
        }).always(function () {
            $buttons.prop('disabled', false).css('opacity', '');
        });
    }
    function studentModal() {
        var modalElement = document.getElementById('studentAjaxModal');

        if (!modalElement || !window.bootstrap) {
            return null;
        }

        return window.bootstrap.Modal.getOrCreateInstance(modalElement);
    }

    function openStudentModal(url, mode) {
        var $modal = $('#studentAjaxModal');
        var $body = $modal.find('[data-student-modal-body]');
        var title = mode === 'edit' ? 'Edit Student' : 'Student Details';

        $modal.find('#studentAjaxModalTitle').text(title);
        $body.html('<div class="text-center py-4">Loading...</div>');
        studentModal().show();

        $.ajax({
            url: url,
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-Modal-Request': mode === 'edit' ? 'student-edit' : 'student-view'
            }
        }).done(function (html) {
            $body.html(html);
        }).fail(function () {
            $body.html('<div class="alert alert-danger mb-0">Hindi ma-load ang student details. Subukan ulit.</div>');
        });
    }

    function submitStudentModalForm($form) {
        clearErrors($form);

        var action = $form.attr('action') || window.location.href;
        var method = ($form.attr('method') || 'POST').toUpperCase();
        var formData = new FormData($form[0]);
        var $buttons = $form.find('[type="submit"]');

        $buttons.prop('disabled', true).css('opacity', '0.7');

        $.ajax({
            url: action,
            method: method,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || ''
            }
        }).done(function (response) {
            var modal = studentModal();

            if (modal) {
                modal.hide();
            }

            loadPage(response.redirect || '/students', false, {
                message: response.message || 'Student updated successfully.',
                type: 'success'
            });
        }).fail(function (xhr) {
            var response = xhr.responseJSON || {};
            var message = response.message || 'Hindi na-save ang changes. Pakicheck ang fields.';

            showMessage(message, 'error');

            if (xhr.status === 422) {
                showValidationErrors($form, response.errors);
            }
        }).always(function () {
            $buttons.prop('disabled', false).css('opacity', '');
        });
    }

    if (!isAdminPage()) {
        return;
    }

    $(document).on('click', '.js-student-view, .js-student-edit', function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        openStudentModal($(this).attr('href'), $(this).hasClass('js-student-edit') ? 'edit' : 'view');
    });

    $(document).on('submit.ajaxStudentModal', '#studentAjaxModal form.student-modal-form', function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        submitStudentModalForm($(this));
    });

    $(document).on('click', 'a[href]', function (event) {
        var href = $(this).attr('href');

        if (event.ctrlKey || event.metaKey || event.shiftKey || event.altKey || $(this).attr('target') || $(this).is('[data-no-ajax]') || !isManagedUrl(href)) {
            return;
        }

        event.preventDefault();
        loadPage(href, true);
    });

    $(document).on('submit.ajaxUpload', 'form[data-upload-form]', function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        submitUploadForm($(this));
    });
    $(document).on('submit.ajaxAdmin', 'form', function (event) {
        var $form = $(this);
        var action = $form.attr('action') || window.location.href;

        if (!isManagedUrl(action)) {
            return;
        }

        event.preventDefault();
        submitForm($form);
    });

    window.addEventListener('popstate', function () {
        loadPage(window.location.href, false);
    });
});
