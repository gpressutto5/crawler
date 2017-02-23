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
		"url"
	]);

foreach ($sites as $value) {
	if (check($value->url, ['woocommerce'])) {
		echo $value->url;
		if (check($value->url, $words)) {
			echo "\t\tSIM";
		}
		echo "\n";
	}
}

return 0;
