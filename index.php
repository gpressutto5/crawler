<?php
require 'core/bootstrap.php';

$words = [
	'comprar',
	'compras',
	'promoção',
	'hoje',
	'preço',
	'carrinho',
	'brasil',
	'brazil',
	'pt-br'
];

$sites = $app['database']->select('woocommerce_list', [
		"id",
		"url"
	]);

$now = 1;
$max = count($sites);
foreach ($sites as $value) {
	system("clear");
	echo "Site ".$now++." de $max\n";
	echo $value->url;
	if (check($value->url, $words)) {
		echo "\t\tSIM";
		$app['database']->selected($value->id);
	}
	echo "\n";
	$app['database']->crawled($value->id);
}

return 0;
