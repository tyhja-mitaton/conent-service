<?php
return [
    'class' => \yii\symfonymailer\Mailer::class,
    'viewPath' => '@app/mail',
    // send all mails to a file by default.
    'useFileTransport' => true,
];