<?php

    require '../Validator.php';

    $val = 'alisson@email.com';

    $validate = new \Validator\Validator();

    $validate->val('Nome', $val, 'email');

    echo '<pre>';

    if(!$validate->isValid())
        echo $validate->getErrorMessage();

    echo '</pre>';