<?php

namespace App\Services;

use App\Models\Lifting;
use Carbon\Carbon;

class CurrentMonthLiftingAggregationService
{
    public function getCurrentMonthGroupedLiftingData()
    {
        // Fetch all liftings grouped by house
        return Lifting::whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
        ])
            ->get()
            ->groupBy(fn($lifting) => optional($lifting->ddHouse)->name)
            ->map(function ($liftings, $houseName) {
                // Flatten the products for this house
                $products = $liftings->flatMap(function ($lifting) {
                    return $lifting->products; // 'products' is already cast as an array
                });

                return [
                    'name' => $houseName,
                    'categories' => $this->groupByCategory($products),
                ];
            })->values();
    }
    private function groupByCategory($products)
    {
        // Group by category
        return $products->groupBy('category')
            ->map(function ($categoryProducts, $category) {
                return [
                    'name'          => $category,
                    'price'         => collect($categoryProducts)->sum( fn($item) => $item['face_value'] ? $item['face_value'] * $item['quantity'] : $item['lifting_price'] * $item['quantity'] ),
                    'quantity'      => collect($categoryProducts)->sum('quantity'),
                    'count'         => collect($categoryProducts)->pluck('sub_category')->unique()->count(),
                    'subcategories' => $this->groupBySubcategory($categoryProducts),
                ];
            })->values();
    }

    private function groupBySubcategory($categoryProducts)
    {
        // Group by subcategory within each category
        return collect($categoryProducts)->groupBy('sub_category')
            ->map(function ($subcategoryProducts, $subcategory) {
                return [
                    'name'      => $subcategory,
                    'price'     => collect($subcategoryProducts)->sum(fn($item) => $item['face_value'] ? $item['face_value'] * $item['quantity'] : $item['lifting_price'] * $item['quantity']),
                    'quantity'  => collect($subcategoryProducts)->sum('quantity'),
                    'count'     => collect($subcategoryProducts)->pluck('code')->unique()->count(),
                    'codes'     => $this->groupByCode($subcategoryProducts),
                ];
            })->values();
    }

    private function groupByCode($subcategoryProducts)
    {
        // Group by code within each subcategory
        return collect($subcategoryProducts)->groupBy('code')
            ->map(function ($codeProducts, $code) {
                return [
                    'code'      => $code,
                    'price'     => collect($codeProducts)->sum(fn($item) => $item['face_value'] ? $item['face_value'] * $item['quantity'] : $item['lifting_price'] * $item['quantity']),
                    'quantity'  => collect($codeProducts)->sum('quantity'),
                    'count'     => collect($codeProducts)->count(),
                ];
            })->values();
    }
}




