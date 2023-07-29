<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CategoryDropdown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category-dropdown', [
            'categories' => Category::all(),
            'currCat' => Category::where('slug', strip_tags(request('category')))->first()
        ]);
    }
}
