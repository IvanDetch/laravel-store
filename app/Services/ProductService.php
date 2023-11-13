<?php

namespace App\Services;

use App\Http\Requests\ProductFormRequest;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Product;
use Exception;

class ProductService
{
    /**
     * @param ProductFormRequest $request
     * @return void
     */
    public function storeProduct(ProductFormRequest $request): void
    {
        $product = Product::create($request->all());

        foreach ($request->categories as $categoryId) {
            $product->categories()->attach($categoryId);
        }
        Gallery::create([
            'product_id' => $product->id,
        ]); // Присвоение ID продукта, в базе Gallery столбцу product_id

        for($i = 0; $i < 4; $i++) {
            Image::create([
                'gallery_id' => $product->gallery->id,
                'path' => $request->input("path.$i"),
            ]);
        }// Присвоение ID галлереи, в базе Images столбцу gallery_id, Добавление ссылок в Path

    }

    /**
     * @param ProductFormRequest $request
     * @param Product $product
     * @return void
     */
    public function updateProduct(ProductFormRequest $request, Product $product): void
    {
        $product->update($request->all());

        $product->categories()->sync($request->categories);

        $product->save();
    }

    /**
     * @param Product $product
     * @return void
     * @throws Exception
     */
    public function deleteProduct(Product $product): void
    {
        $product->delete();
    }

    /**
     * @param Product $product
     * @return void
     */
    public function restoreProduct(Product $product): void
    {
        $product->restore();
    }

    /**
     * @param Product $product
     * @return void
     */
    public function destroyProduct(Product $product): void
    {
        $product->forceDelete();
    }
}
