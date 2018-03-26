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

