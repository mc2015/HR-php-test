<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public static function getOrderProductListArray($order_id)
    {
    	$orderProducts = OrderProduct::all()->where('order_id', $order_id);

    	$product_list = [];
    	
    	foreach ($orderProducts as $orderProduct) {
    		$product_list[] = [
    			'name' => $orderProduct->product->name,
    			'quantity' => $orderProduct->quantity
    		];
    	}
        
        return $product_list;
    }
}
