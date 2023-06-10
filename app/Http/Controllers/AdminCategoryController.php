<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Book;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\FavoriteBook;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class AdminCategoryController extends Controller
{
    public function __construct(
        protected FavoriteBook $favorites,
        protected CartItem $cart
    ) {
    }

    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::latest()->paginate(16),
            'favorites' => $this->favorites->numberOfFavorites(),
            'numberOfCartItems' => $this->cart->numberOfCartItems()
        ]);
    }

    public function create()
    {
        return view('admin.categories.create', [
            'favorites' => $this->favorites->numberOfFavorites(),
            'numberOfCartItems' => $this->cart->numberOfCartItems()
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = str($validated['name'])->slug();

        Category::create($validated);

        return redirect(route('admin.categories'))->with('success', 'New category has been added.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category,
            'favorites' => $this->favorites->numberOfFavorites(),
            'numberOfCartItems' => $this->cart->numberOfCartItems()
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $category->update($validated);

        return redirect(route('admin.categories'))->with('success', 'Category Updated!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Category Deleted!');
    }

}
