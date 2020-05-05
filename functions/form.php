<?php

    function patchValue($formField){
        if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {
            echo "value=".$_SESSION['formData'][$formField];
        }
    }

?>