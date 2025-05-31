<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $category = $request->query('category');
            $sort = $request->query('sort');
            $page = $request->query('page', 1); 

            $cacheKeyParts = ['products'];

            if ($category) {
                $cacheKeyParts[] = 'category_' . Str::slug($category); 
            } else {
                $cacheKeyParts[] = 'all_categories';
            }

            if ($sort) {
                $cacheKeyParts[] = 'sort_' . Str::slug($sort); 
            } else {
                $cacheKeyParts[] = 'no_sort';
            }

            $cacheKeyParts[] = 'page_' . $page;

            $cacheKey = implode('_', $cacheKeyParts);

            $cacheDuration = 60 * 60; 

            $products = Cache::remember($cacheKey, $cacheDuration, function () use ($category, $sort) {
                $productsQuery = Product::query();

                if ($category) {
                    $productsQuery->whereHas('category', function ($query) use ($category) {
                        $query->where('slug', $category);
                    });
                }

                if ($sort) {
                    [$column, $direction] = explode('_', $sort);
                    $productsQuery->orderBy($column, $direction ?? 'asc');
                }

                return $productsQuery->with(['category' => fn($query) => $query->select(['id', 'name'])])->paginate(100);
            });

            return $products; 
        }catch(\Exception $e){
            return response()->json(['error' => 'An error occurred while fetching products.', 'exactError' => $e->getMessage()], 500);
        }    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
