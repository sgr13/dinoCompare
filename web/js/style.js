$(document).ready(function () {
    $first = ($("#weight").children().html());
    $second = ($("#weight").children().next().next().html());

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

    $first = ($("#lenght").children().html());
    $second = ($("#lenght").children().next().next().html());

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
        $("#lenght").children().next().next().addClass('winner');
    }

    $first = ($("#height").children().html());
    $second = ($("#height").children().next().next().html());

    $first = parseFloat($first);
    $second = parseFloat($second);

    console.log($first);
    console.log($second);

    if ($first > $second) {
        $("#height").children().first().addClass('winner');
    } else if ($first < $second) {
        $("#height").children().next().next().addClass('winner');
    } else {
        $("#height").children().addClass('winner');
        $("#height").children().next().next().addClass('winner');
    }
})