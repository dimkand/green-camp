<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii',
    'username' => 'yii',
    'password' => 'admin',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => true

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
