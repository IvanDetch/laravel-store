<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryFormRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\View\View;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index(): View
    {
        $categories = Category::paginate(20);
        $trashedCategories = Category::onlyTrashed()->get();
        return view('admin.categories.index', compact('categories','trashedCategories'));
        //
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function indexPublic(): View
    {
        $categories = Category::paginate(20);
        return view('categories.index', compact('categories'));
        //
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @param string $slug
     * @return mixed
     */
    public function show(Request $request,string $slug): mixed
    {
        $category=Category::where('slug', $slug)->first();

        $paginate = 12;

        $products = $category->products()->paginate($paginate);

        if(isset($request->orderBy)){
            if($request->orderBy == 'default')
            {
                $products = $category->products()->paginate($paginate);
            }
        }

        if(isset($request->orderBy)){
            if($request->orderBy == 'price-low-high')
            {
                $products = $category->products()->orderBy('price')->paginate($paginate);
            }
        }

        if(isset($request->orderBy)){
            if($request->orderBy == 'price-high-low')
            {
                $products = $category->products()->orderBy('price','desc')->paginate($paginate);
            }
        }

        if(isset($request->orderBy)){
            if($request->orderBy == 'name-a-z')
            {
                $products = $category->products()->orderBy('title')->paginate($paginate);
            }
        }

        if(isset($request->orderBy)){
            if($request->orderBy == 'name-z-a')
            {
                $products = $category->products()->orderBy('title','desc')->paginate($paginate);
            }
        }

        if($request->ajax())
        {
            return view('ajax.order-by',[
                'products' => $products
            ])->render();
        }

        return view('categories.show', compact('category','products'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create():View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryFormRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryFormRequest $request): RedirectResponse
    {
        Category::create($request->all());

        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryFormRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryFormRequest $request, Category $category): RedirectResponse
    {

        $category->update($request->all());

        return redirect()->route('admin.categories.index');
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index');
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
        $category = Category::onlyTrashed()->whereId($id)->first();
        $this->authorize('restore', $category);
        $category->restore();

        return redirect()->route('admin.categories.index');
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
        $category = Category::onlyTrashed()->whereId($id)->first();
        $this->authorize('forceDelete', $category);

        $category->forceDelete();

        return redirect()->route('admin.categories.index');
    }

}

