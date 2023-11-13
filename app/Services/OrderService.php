<?php

namespace App\Services;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderService
{
    /**
     * @param StoreOrderRequest $request
     * @return Order
     */
    public function storeOrder(StoreOrderRequest $request): Order
    {
        $order = Order::create([
            'customerName' => $request->customerName,
            'customerLastName' => $request->customerLastName,
            'customerEmail' => $request->customerEmail,
            'customerPhone' => $request->customerPhone,
            'customerAddress' => $request->customerAddress,
            'comment' => $request->customerComment,
            'total' => Cart::total()
        ]);

        foreach (Cart::content() as $cartRow){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartRow->model->id,
                'product_title' => $cartRow->model->title,
                'price' => $cartRow->model->price,
                'quantity' => $cartRow->qty,
            ]);
        }

        if ($request->has('updateUser')){
            $user = auth()->guest() ? User::where('email', $request->customerEmail)->first() : auth()->user();

            if(!is_null($user)) {
                $user->update([
                    'name' => $request->customerName,
                    'lastname' => $request->customerLastName,
                    'email' => $request->customerEmail,
                    'phone' => $request->customerPhone,
                    'address' => $request->customerAddress,
                ]);

                $order->update([
                    'user_id' => $user->id,
                ]);
            }
        }

        Cart::destroy();

        return $order;
    }

    /**
     * @param Order $order
     * @return void
     */
    public function deleteOrder(Order $order): void
    {
        $order->delete();
    }

    /**
     * @param Order $order
     * @return void
     */
    public function restoreProduct(Order $order): void
    {
        $order->restore();
    }

    /**
     * @param Order $order
     * @return void
     */
    public function destroyProduct(Order $order): void
    {
        $order->forceDelete();
    }
}
