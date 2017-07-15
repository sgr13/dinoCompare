$(document).ready(function () {




    $('#weight .progres-bar').css('width', '0%');
    $('#weight .progress-bar180').css('width', '100%');
    $('#lenght .progres-bar').css('width', '0%');
    $('#lenght .progress-bar180').css('width', '100%');
    $('#height .progres-bar').css('width', '0%');
    $('#height .progress-bar180').css('width', '100%');

    $(window).scroll(function() {
        var bottomPos = $(window).scrollTop() + $(window).height();
        var weightRowPosition = $('#weight').offset().top;

        if (bottomPos > weightRowPosition) {
            var progresBar180 = $('.progress-bar180').attr('percentValue');
            var progresBar = $('.progres-bar').attr('percentValue');

            $('#weight .progres-bar').animate({width:progresBar  + '%'}, 2000);
            $('#weight .progress-bar180').animate({width: progresBar180 + '%'}, 2000, function() {
                $first = parseFloat($("#weight").children().children().html());
                $second = parseFloat($("#weight").children().next().next().children().html());

                if ($first > $second) {
                    $('#weight .progress180').css("background-color", "yellowgreen");
                    $('#weight .progres-bar').css("background-color", "red");

                } else if ($first < $second) {
                    $('#weight .progres-bar').css("background-color", "yellowgreen");
                    $('#weight .progress180').css("background-color", "red");

                } else {
                    $('#weight .progress180').css("background-color", "yellowgreen");
                    $('#weight .progres-bar').css("background-color", "yellowgreen");
                }
            });
        }
        var lenghtRowPosition = $('#lenght').offset().top;

        if (bottomPos > lenghtRowPosition) {
            var progresBar180 = $('#lenght .progress-bar180').attr('percentValue');
            var progresBar = $('#lenght .progres-bar').attr('percentValue');

            $('#lenght .progres-bar').animate({width:progresBar  + '%'}, 2000);

            $('#lenght .progress-bar180').animate({width: progresBar180 + '%'}, 2000, function() {
                $first = parseFloat($("#lenght").children().children().html());
                $second = parseFloat($("#lenght").children().next().next().children().html());

                if ($first > $second) {
                    $('#lenght .progress180').css("background-color", "yellowgreen");
                    $('#lenght .progres-bar').css("background-color", "red");

                } else if ($first < $second) {
                    $('#lenght .progres-bar').css("background-color", "yellowgreen");
                    $('#lenght .progress180').css("background-color", "red");

                } else {
                    $('#lenght .progress180').css("background-color", "yellowgreen");
                    $('#lenght .progres-bar').css("background-color", "yellowgreen");
                }
            });
        }

        var heightRowPosition = $('#height').offset().top;

        if (bottomPos > heightRowPosition) {
            var progresBar180 = $('#height .progress-bar180').attr('percentValue');
            var progresBar = $('#height .progres-bar').attr('percentValue');

            $('#height .progres-bar').animate({width:progresBar  + '%'}, 2000);

            $('#height .progress-bar180').animate({width: progresBar180 + '%'}, 2000, function() {
                $first = parseFloat($("#height").children().children().html());
                $second = parseFloat($("#height").children().next().next().children().html());

                if ($first > $second) {
                    $('#height .progress180').css("background-color", "yellowgreen");
                    $('#height .progres-bar').css("background-color", "red");

                } else if ($first < $second) {
                    $('#height .progres-bar').css("background-color", "yellowgreen");
                    $('#height .progress180').css("background-color", "red");

                } else {
                    $('#height .progress180').css("background-color", "yellowgreen");
                    $('#height .progres-bar').css("background-color", "yellowgreen");
                }
            });
        }

    }).scroll();
});