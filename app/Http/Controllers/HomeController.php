<?php

namespace App\Http\Controllers;

use App\Services\YaxApiService;

class HomeController extends Controller
{
    public function __construct(
        protected YaxApiService $yaxApiService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->yaxApiService->getProducts([
            'limit' => 20,
        ]);

        if (!$products) {
            $products = [];
        }

        return view('products.index', compact('products'));
    }
}
