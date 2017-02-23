<?php
require 'core/bootstrap.php';

$sites = $app['database']->countAll('woocommerce_list');

var_dump($sites);

return 0;
