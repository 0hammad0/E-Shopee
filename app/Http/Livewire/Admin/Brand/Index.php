<?php

namespace App\Http\Livewire\Admin\Brand;

use Exception;
use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $brandName, $brandSlug, $brandStatus='1', $brandId;

    public function rules()
    {
        return [
            'brandName' =>'required|string|max:255',
            'brandSlug' =>'required|string|max:255',
            'brandStatus' =>'required',
        ];
    }

    public function resetInput()
    {
        $this->brandName = NULL;
        $this->brandSlug = NULL;
        $this->brandStatus = '1';
    }

    public function storeBrand()
    {
        $validatedData = $this->validate();

        Brand::create([
            'name' => $validatedData['brandName'],
            'slug' => Str::slug($validatedData['brandSlug']),
            'status' => $validatedData['brandStatus'],
        ]);

        session()->flash('message', $this->brandName.' Brand added');
        $this->dispatchBrowserEvent('closeBrandModal');
        $this->resetInput();
    }

    public function editBrand(Brand $brand)
    {
        $this->dispatchBrowserEvent('openEditModal');
        $this->brandName = $brand->name;
        $this->brandSlug = $brand->slug;
        $this->brandStatus = $brand->status;
        $this->brandId = $brand->id;
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brand::find($this->brandId)->update([
            'name' => $validatedData['brandName'],
            'slug' => Str::slug($validatedData['brandSlug']),
            'status' => $validatedData['brandStatus'],
        ]);
        $this->dispatchBrowserEvent('closeEditModal');
        $this->resetInput();
        session()->flash('message', $this->brandName . ' brand Updated successfully');
    }

    public function deleteBrand(int $brandId)
    {
        $this->dispatchBrowserEvent('openDeleteBrandModal');
        $this->brandId = $brandId;
    }

    public function destoryBrand()
    {
        $brand = Brand::findOrFail($this->brandId);
        $brand->delete();
        $this->dispatchBrowserEvent('closeDeleteBrandModal');
        $this->resetInput();
        session()->flash('message', $this->brandName . ' brand deleted successfully');
    }

    public function render()
    {
        return view('livewire.admin.brand.index', [
            'brands' => Brand::orderBy('id', 'DESC')->paginate(10),
        ])
        ->extends('layouts.admin')
        ->section('content');
    }
}
