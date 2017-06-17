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
    console.log($("#lenght").children().children().html());


    $first = ($("#lenght").children().children().html());
    $second = ($("#lenght").children().next().next().children().html());

    $first = parseFloat($first);
    $second = parseFloat($second);

    console.log($first);
    console.log($second);

    if ($first > $second) {
        $("#lenght").children().first().addClass('winner');
    } else if ($first < $second) {
        $("#lenght").children().next().next().addClass('winner');
    } else {
        $("#lenght").children().addClass('winner');
        $("#lenght").children().next().next().children().addClass('winner');
    }


    ///////////////////////////////////////////
    //$first = ($("#height").children().html());
    //$second = ($("#height").children().next().next().html());
    //
    //$first = parseFloat($first);
    //$second = parseFloat($second);
    //
    //console.log($first);
    //console.log($second);
    //
    //if ($first > $second) {
    //    $("#height").children().first().addClass('winner');
    //} else if ($first < $second) {
    //    $("#height").children().next().next().addClass('winner');
    //} else {
    //    $("#height").children().addClass('winner');
    //    $("#height").children().next().next().addClass('winner');
    //}
})