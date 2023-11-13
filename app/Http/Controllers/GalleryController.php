<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index(): View
    {
        $galleries = Image::paginate(20);
        return view('admin.gallery.index', compact('galleries'));
        //
    }
}
