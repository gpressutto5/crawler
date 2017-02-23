<?php
require 'core/bootstrap.php';

$words = [
	'comprar',
	'compre',
	'compras',
	'promoção',
	'hoje',
	'preço',
	'carrinho',
	'não',
	'brasil',
	'brazil',
	'pt-br'
];

$sites = $app['database']->select('woocommerce_list', [
		"id",
		"url"
	], 150000);

$now = 1;
$max = count($sites);
foreach ($sites as $value) {
	if (check($value->url, ['woocommerce'])) {
		system("clear");
		echo "Site ".$now++." de $max\n";
		echo $value->url;
		if (check($value->url, $words)) {
			echo "\t\tSIM";
			$app['database']->selected($value->id);
		}
		echo "\n";
	}
}

return 0;
