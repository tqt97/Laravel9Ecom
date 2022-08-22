<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    private $routeResourceName = 'home';

    public function index(Request $request)
    {
        $products = Product::query()
            ->select([
                'id',
                'name',
                'cost_price',
                'price',
                'created_at',
                'show_on_slider',
                'featured',
                'active',
                'creator_id',
            ])
            ->with(['creator:id,name'])
            ->when($request->name, fn (Builder $builder, $name) => $builder->where('name', 'like', "%{$name}%"))
            ->when(
                $request->categoryId,
                fn (Builder $builder, $categoryId) => $builder->whereHas(
                    'categories',
                    fn (Builder $builder) => $builder->where('categories.id', $categoryId)
                )
            )
            ->when(
                $request->subCategoryId,
                fn (Builder $builder, $subCategoryId) => $builder->whereHas(
                    'categories',
                    fn (Builder $builder) => $builder->where('categories.id', $subCategoryId)
                )
            )
            ->when(
                $request->active !== null,
                fn (Builder $builder) => $builder->when(
                    $request->active,
                    fn (Builder $builder) => $builder->active(),
                    fn (Builder $builder) => $builder->inActive()
                )
            )
            ->when(
                $request->featured !== null,
                fn (Builder $builder) => $builder->where('featured', $request->featured)
            )
            ->when(
                $request->showOnSlider !== null,
                fn (Builder $builder) => $builder->where('show_on_slider', $request->showOnSlider)
            )
            ->latest('id')
            ->paginate(6);
        $all = Product::with(['categories','creator'])->paginate(6);
        if ($request->wantsJson()) {
            return $all;
        }
        return Inertia::render('Home/Index', [
            'title' => 'Products',
            'items' => ProductResource::collection($products),
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name',
                ],
                [
                    'label' => 'Cost Price',
                    'name' => 'cost_price',
                ],
                [
                    'label' => 'Selling Price',
                    'name' => 'price',
                ],
                [
                    'label' => 'On Slider',
                    'name' => 'show_on_slider',
                ],
                [
                    'label' => 'Featured',
                    'name' => 'featured',
                ],
                [
                    'label' => 'Active',
                    'name' => 'active',
                ],
                [
                    'label' => 'Created Date',
                    'name' => 'created_at',
                ],
                [
                    'label' => 'Created By',
                    'name' => 'creator_id',
                ],
                [
                    'label' => 'Actions',
                    'name' => 'actions',
                ],
            ],
            'filters' => (object) $request->all(),
            'routeResourceName' => $this->routeResourceName,
            'categories' => CategoryResource::collection(
                Category::root()->with(['children:id,name,parent_id'])->get(['id', 'name'])
            ),
            'can' => [
                'create' => $request->user()->can('create product'),
            ],
        ]);
    }
}
