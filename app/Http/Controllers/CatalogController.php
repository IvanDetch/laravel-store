<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request): mixed
    {

        $paginate = 10;

        $products = Product::orderBy('created_at','desc')->paginate($paginate);

        if(isset($request->orderBy)){
            if($request->orderBy == 'default')
            {
                $products = Product::orderBy('created_at','desc')->paginate($paginate);
            }
        }

        if(isset($request->orderBy)){
            if($request->orderBy == 'price-low-high')
            {
                $products = Product::orderBy('price')->paginate($paginate);
            }
        }

        if(isset($request->orderBy)){
            if($request->orderBy == 'price-high-low')
            {
                $products = Product::orderBy('price','desc')->paginate($paginate);
            }
        }

        if(isset($request->orderBy)){
            if($request->orderBy == 'name-a-z')
            {
                $products = Product::orderBy('title')->paginate($paginate);
            }
        }

        if(isset($request->orderBy)){
            if($request->orderBy == 'name-z-a')
            {
                $products = Product::orderBy('title','desc')->paginate($paginate);
            }
        }

        if($request->ajax())
        {
            return view('ajax.order-by',[
                'products' => $products
            ])->render();
        }

        return view('catalog.index', compact('products'));
    }

    /**
     * Display the specified resource
     *
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        $product = Product::where('slug', $slug)->first();

        return view('catalog.product', compact('product'));
    }
}
