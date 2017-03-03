<?php
require 'core/bootstrap.php';

const NUMBER_OF_INSTANCES_TO_RUN = 10;

if (count($argv) == 1) {
    $count = $app['database']->countAll('woocommerce_list');
    $limit = ceil($count / NUMBER_OF_INSTANCES_TO_RUN);

    for ($i=0; $i < NUMBER_OF_INSTANCES_TO_RUN; $i++) {
        echo "Iniciando serviço ". ($i+1) ." de ".NUMBER_OF_INSTANCES_TO_RUN;
        $offset = $limit * $i;
        system("nohup php ~/Code/crawler/index.php $limit $offset > ~/Code/crawler/out". ($i+1) .".txt &");
        echo "\t\t\tINICIADO\n";
    }
    echo NUMBER_OF_INSTANCES_TO_RUN . " serviços iniciados com sucesso!\n";
    return 0;
}

if (isset($argv[1]) && isset($argv[2])) {
    $limit = $argv[1];
    $offset = $argv[2];
    $sites = $app['database']->select('woocommerce_list', [
        'id',
        'url'
    ], $limit, $offset);

    $max = count($sites);
    $now = 1;
    foreach ($sites as $value) {
        echo date("d/m/Y H:i:s");
        echo " | Checando site ".$now++." de $max | ";
        echo $value->url;
        if (is_valid($value->url)) {
            echo "\tVÁLIDO";
            $app['database']->selected($value->id);
        }
        echo "\n";
        $app['database']->crawled($value->id);
    }
}

return 0;
