<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Auth\Access\AuthorizationException;

class OrderController extends Controller
{

    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * OrderController constructor
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index(): View
    {
        $orders = Order::paginate();
        $trashedOrders = Order::onlyTrashed()->get();

        return view('admin.orders.index', compact('orders', 'trashedOrders'));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreOrderRequest $request
     * @return RedirectResponse
     */
    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $order = $this->orderService->storeOrder($request);

        return redirect()->route('cart.success', ['orderId' => $order->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Delete the specified resource from storage.
     */
    public function delete(Order $order)
    {
        $this->orderService->deleteOrder($order);

        return redirect()->route('admin.orders.index');
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function restore(int $id): RedirectResponse
    {
        $order = Order::onlyTrashed()->whereId($id)->first();
        $this->authorize('restore', $order);

        $this->orderService->restoreProduct($order);

        return redirect()->route('admin.orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): RedirectResponse
    {
        $order = Order::onlyTrashed()->whereId($id)->first();
        $this->authorize('forceDelete', $order);

        $this->orderService->destroyProduct($order);

        return redirect()->route('admin.orders.index');
    }

}
