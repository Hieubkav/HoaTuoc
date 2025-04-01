<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\MenuItem;
use App\Models\Section;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('components.shop.*', function ($view) {
            $settings = Setting::first();

            // Lấy menu items đã sắp xếp theo parent_id và order
            $menuItems = MenuItem::whereNull('parent_id')
                ->orderBy('order')
                ->with(['children' => function ($query) {
                    $query->orderBy('order');
                }])
                ->get();

            $view->with([
                'settings' => $settings,
                'menuItems' => $menuItems
            ]);
        });

        // Share sections data for featured-category component
        View::composer('components.storeFront.featured-category', function ($view) {
            $sections = Section::where('status', 'visible')
                ->select(['id', 'name', 'description', 'thumbnail'])
                ->orderBy('created_at', 'desc')
                ->get();

            $view->with([
                'featuredSections' => $sections
            ]);
        });

        // Share section data with categories and products for product-category-tabs
        View::composer('components.storeFront.product-category-tabs', function ($view) {
            $sections = Section::whereHas('categories', function ($categoryQuery) {
                $categoryQuery->where('status', 'visible')
                    ->whereHas('products');
            })
                ->with([
                    'categories' => function ($query) {
                        $query->where('status', 'visible')
                            ->whereHas('products')
                            ->with([
                                'products' => function ($query) {
                                    $query->with(['versions', 'images'])
                                        ->orderBy('created_at', 'desc');
                                }
                            ]);
                    }
                ])
                ->where('status', 'visible')
                ->select(['id', 'name', 'description', 'thumbnail'])
                ->orderBy('created_at', 'desc')
                ->get();

            $view->with('sections', $sections);
        });
        // Share flash sale products data
        View::composer('components.storeFront.flash-sale-carousel', function ($view) {
            $flashSaleCategory = Category::flashSale()->first();

            $flashSaleProducts = $flashSaleCategory ? $flashSaleCategory->products->map(function ($product) {
                return [
                    'image' => $product->thumbnail,
                    'name' => $product->name,
                    'originalPrice' => $product->versions->first()->price,
                    'salePrice' => ($product->versions->first()->price) - ($product->versions->first()->price * $product->versions->first()->discount_percentage / 100),
                    'discount' => $product->versions->first()->discount_percentage,
                    'remaining' => rand(5, 30) // Giả lập số lượng còn lại, có thể thay bằng field thực tế sau
                ];
            })->toArray() : [];

            $view->with('flashSaleProducts', $flashSaleProducts);
        });

        // Thêm vào method boot(), sau các View::composer khác

        // Share blog posts for blog-section component
        View::composer('components.storeFront.blog-section', function ($view) {
            $blogPosts = \App\Models\Post::where('status', 'visible')
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();

            $view->with('blogPosts', $blogPosts);
        });
    }
}
