import './bootstrap';

$(function () {

    console.log("jQuery is working!");

    // CLICK
    $('#demoButton').on('click', function () {
        $('#clickResult').text('Button clicked!');
    });

    // HOVER
    $('#demoHover').on('mouseenter', function () {
        $(this).css('background-color', 'yellow');
    });

    $('#demoHover').on('mouseleave', function () {
        $(this).css('background-color', '');
    });

    // SHOW / HIDE / TOGGLE
    $('#showBtn').on('click', function () {
        $('#toggleText').show();
    });

    $('#hideBtn').on('click', function () {
        $('#toggleText').hide();
    });

    $('#toggleBtn').on('click', function () {
        $('#toggleText').toggle();
    });

    // FADE
    $('#fadeInBtn').on('click', function () {
        $('#fadeText').fadeIn();
    });

    $('#fadeOutBtn').on('click', function () {
        $('#fadeText').fadeOut();
    });

    // SLIDE
    $('#slideBtn').on('click', function () {
        $('#slideText').slideToggle();
    });

    // AJAX
    $('#ajaxBtn').on('click', function () {
        $.ajax({
            url: '/demo-data',
            type: 'GET',
            success: function (res) {
                $('#ajaxResult').text(res.message);
            },
            error: function () {
                $('#ajaxResult').text('AJAX error');
            }
        });
    });

});