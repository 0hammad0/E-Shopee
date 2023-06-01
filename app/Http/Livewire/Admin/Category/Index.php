<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id;

    function deleteCatagory(Category $category)
    {
        // $category->delete();\
        $this->category_id = $category->id;
    }

    function destoryCategory()
    {
        $category = Category::findOrFail($this->category_id);
        $path = 'uploads/category/'.$category->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
        $category->delete();
        session()->flash('message', 'Category deleted');
        $this->dispatchBrowserEvent('close-delete-modal');
    }

    public function render()
    {
        return view('livewire.admin.category.index',[
            'categories' => Category::orderBy('id', 'DESC')->paginate(10)
        ]);
    }
}
