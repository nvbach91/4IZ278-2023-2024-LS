<?php

function currentDate($offset=null){
    if($offset){
        return date('Y-m-d H:i:s', strtotime($offset));
    }
    return date('Y-m-d H:i:s', time());
}

?>