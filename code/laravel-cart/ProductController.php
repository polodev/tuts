<?php 
class ProductController {
	public function getAddToCart(Request $request, $id)
  {
    dd($request->session()->get('cart'));
    $product = Product::find($id);
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->addItem($product, $product->id);
    $request->session()->put('cart', $cart);
    return redirect()->route('home');
	}
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
}
