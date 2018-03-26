---
title: laravel-cart
layout: post
---

### for validating email 

~~~php
$this->validate($request, [
	'email' => 'email|required|unique:users'
	]);
~~~

### For authentication in laravel

~~~php
if (
Auth::attempt([
	'email' => $request->input('email'),
	'password' => $request->input('password')
	])

) {
	// do login
}
return redirect()->route('home');
return redirect()->back();

~~~

### for login and  logout 

~~~php
$user = "user table instance";
Auth::login($user);
Auth::logout();
~~~

### Middleware

~~~php
Route::group(['middleware' => 'auth'], function () {
  Route::get('/logout', [
    'uses' => 'SigninController@logout',
    'as' => 'logout'
  ]);
});

~~~
redirect after login can be found inside `http/Middleware/Autenticate.php` file `handle` function 


### checking authentication in blade file

~~~php
@guest
@else 
@endguest

// or 

@auth
@else
@endauth

//or old school
@if (Auth::check()) {}
~~~


### cart using session 
session drive is file by default    

###  cart model 

~~~php
<?php

namespace App;

class Cart {
  public $items = null;
  public $totalQty = 0;
  public $totalPrice = 0;
  public function __construct($oldCart)
  {
    if ($oldCart) {
      $this->items = $oldCart->items;
      $this->qty = $oldCart->qty;
      $this->totalPrice = $oldCart->totalPrice;
    }
  }

  public function addItem($item, $id)
  {
    $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
    if ($this->items) {
      if (array_key_exists($id, $this->items)) {
        $storedItem = $items[$id];
      }
    }
    $storedItem['qty']++;
    $storedItem['price'] = $storedItem['qty'] * $item->price;
    $this->items[$id] = $storedItem;
    $this->totalQty++;
    $this->totalPrice += $item->price;

  }
}

~~~

### add to cart function inside controller 


~~~php

public function getAddToCart(Request $request, $id) {

  // dd($request->session()->get('cart')); //for checking 
  $product = Product::find($id);
  $oldCart = Session::has('cart') ? Session::get('cart') : null;
  $cart = new Cart($oldCart);
  $cart->addItem($product, $product->id);
  $request->session()->put('cart', $cart);
  return redirect()->route('home');
}
~~~


### showing total quantity inside blade file 


~~~php
Session::has('cart') ? Session::get('cart')->totalQty : '';
~~~


### function inside controller to get the cart view 

~~~php
  public function getCart()
  {
    if (!Session::has('cart'))
    {
      return view('cart_page');
    }

    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    return view('cart_page', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
  }
~~~

### to destroy cart from session

~~~php
Session::forget('cart');
~~~























