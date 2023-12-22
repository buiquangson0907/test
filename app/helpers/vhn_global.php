<?php
function currency_vn($data) {
    $currency = $data ? intval($data) : 0 ;
    return number_format($currency, 0, '', '.');
}
