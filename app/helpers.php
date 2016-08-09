<?php

function toStatus($int){
    if ($int == 0){
         echo '<strong class="btn btn-default" disabled="">User normal</strong>';
    }else{
         echo '<strong class="btn btn-success" disabled="">Administrateur</strong>';
    }
}



?>