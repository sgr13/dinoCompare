$(document).ready(function () {
    $first = ($("#weight").children().children().html());
    $second = ($("#weight").children().next().next().children().html());

    $first = parseFloat($first);
    $second = parseFloat($second);

    if ($first > $second) {
        $("#weight").children().first().addClass('winner');
    } else if ($first < $second) {
        $("#weight").children().next().next().addClass('winner');
    } else {
        $("#weight").children().addClass('winner');
        $("#weight").children().next().next().addClass('winner');
    }

    //////////////////////////////////////////////////

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


    /////////////////////////////////////////
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

    $('#entranceButton').mouseover(function() {
        $('#entranceButton').animate({
            width: 850
        }, 2000)

    });

    $('#entranceButton').mouseout(function() {
        $('#entranceButton').animate({
            width: 700
        }, 2000)
    });

    //$('.selectionPhoto').mouseover(function () {
    //    console.log("wtf");
    //    $(this).width(195);
    //    $(this).height(152);
    //})

    //$('.selectionPhoto').mouseout(function () {
    //    $(this).width(165);
    //    $(this).height(132);
    //})


})