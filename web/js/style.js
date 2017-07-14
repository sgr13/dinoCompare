$(document).ready(function () {

//--------------------------
    $('#weight .progres-bar').css('width', '0%')
    $('#weight .progres-bar').animate({width: 88 + '%'}, 2000);

    $first = ($("#weight").children().children().html());
    $second = ($("#weight").children().next().next().children().html());

    $first = parseFloat($first);
    $second = parseFloat($second);

    if ($first > $second) {
        $('#weight .progress180').css("background-color", "yellowgreen");
    } else if ($first < $second) {
        $('#weight .progres-bar').css("background-color", "yellowgreen");

    } else {
        $('#weight .progress180').css("background-color", "yellowgreen");
        $('#weight .progress-bar').css("background-color", "yellowgreen");
    }

//--------------------------

    $first = ($("#lenght").children().children().html());
    $second = ($("#lenght").children().next().next().children().html());

    $first = parseFloat($first);
    $second = parseFloat($second);

    if ($first > $second) {
        $("#lenght").children().first().addClass('winner');
    } else if ($first < $second) {
        $("#lenght").children().next().next().addClass('winner');
    } else {
        $("#lenght").children().addClass('winner');
        $("#lenght").children().next().next().children().addClass('winner');
    }


//-------------------------

    $first = ($("#height").children().children().html());
    $second = ($("#height").children().next().next().children().html());

    $first = parseFloat($first);
    $second = parseFloat($second);

    if ($first > $second) {
        $("#height").children().first().addClass('winner');
    } else if ($first < $second) {
        $("#height").children().next().next().addClass('winner');
    } else {
        $("#height").children().addClass('winner');
        $("#height").children().next().next().addClass('winner');
    }

    //-----------------------

    $('.imgSelectedDino').mouseover(function () {
        console.log("Działa");
        var path = $(this).attr('src');
        console.log(path);
        console.log($('#bgPicture'));
        $('#bigPictureSelected').attr({src: path});
    });

})