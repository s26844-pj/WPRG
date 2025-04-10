<?php
function dodaj($a, $b) {
    return $a + $b;
}

function odejmij($a, $b) {
    return $a - $b;
}

function pomnoz($a, $b) {
    return $a * $b;
}

function podziel($a, $b) {
    if ($b == 0) {
        return "Nie można dzielić przez zero!";
    }
    return round($a / $b, 2);
}
?>
