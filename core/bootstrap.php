<?php
$app = [];

$app['config'] = require 'config.php';

require 'core/database/Connection.php';
require 'core/database/QueryBuilder.php';
require 'helper.php';

$app['database'] = new QueryBuilder(
    Connection::make($app['config']['database'])
);
