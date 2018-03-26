<?php

Route::get('/add-to-cart/{id}', [
	'uses' => "ProductController@add_to_cart",
	'as' => 'product.add_cart'
]);