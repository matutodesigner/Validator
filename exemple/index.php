<?php

    require '../Validator.php';


    $val = '';

    $validate = new \Validator\Validator();

    $validate->val('Nome', $val, 'required|maxLeng:20|minLeng:3');

    echo '<pre>';

    if(!$validate->isValid())
        echo $validate->getErrorMessage();

    echo '</pre>';
    echo $validate->isValid();