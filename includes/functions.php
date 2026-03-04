<?php
function formatPrice($number){
    return number_format($number,0,",",".") . " đ";
}
?>