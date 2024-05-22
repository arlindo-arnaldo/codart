<?php

namespace App\Http\Livewire\Posts;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

use Livewire\Component;

class Categories extends Component
{
    public $name, $description, $slug, $parent_id;

    public $update_mode, $category_id, $subcategory_update_mode = false;

    protected $listeners = [
        'refreshPage' => '$refresh'
    ];

    public function resetForm()
    {
        $this->name = $this->description = $this->slug = $this->parent_id = null;
        $this->resetErrorBag();
    }
    public function ResetAll()
    {
        $this->resetForm();
        $this->update_mode = false;
        $this->subcategory_update_mode = false;
    }


    public function saveCategory()
    {
        $this->validate([
            'name' => 'required|unique:categories,name'
        ]);

        if (!$this->parent_id) {
            $category = new Category();
            $category->name = $this->name;
            $category->description = $this->description;
            $category->slug = Str::slug($this->name);


            if ($category->save()) {
                $this->emit('refreshPage');
                $this->resetForm();
            }
        } else {
            $subcategory = new SubCategory();
            $subcategory->name = $this->name;
            $subcategory->description = $this->description;
            $subcategory->slug = Str::slug($this->name);
            $subcategory->parent_id = $this->parent_id;
            if ($subcategory->save()) {
                $this->emit('refreshPage');
                $this->resetAll();
            }
        }
    }

    public function editCategory($category)
    {
        $this->resetForm();
        $this->update_mode = true;
        $this->category_id = $category['id'];

        $this->name = $category['name'];
        $this->description = $category['description'];
    }

    public function updateCategory()
    {
        if ($this->parent_id == '---Nehum--') {
            $this->parent_id = null;
        }
        if ($this->parent_id == null && !$this->subcategory_update_mode) {
            $this->validate([
                'name' => 'required|unique:categories,name,' . $this->category_id
            ]);

            $category = Category::findOrFail($this->category_id)->update([
                'name' => $this->name,
                'description' => $this->description,
                'slug' => Str::slug($this->name)
            ]);

            if ($category) {
                $this->emit('refreshPage');
                $this->resetAll();
                
            }
        } else {
            if ($this->subcategory_update_mode == false) {

                $child = SubCategory::find($this->parent_id);
               
                if (!$child) {
                    $subcategory = SubCategory::create([
                        'name' => $this->name,
                        'description' => $this->description,
                        'slug' => Str::slug($this->name),
                        'parent_id' => $this->parent_id
                    ]);
                    if ($subcategory) {
                        $category = Category::find($this->category_id);
                        $category->delete();
                        $this->emit('refreshPage');
                        $this->resetAll();
                        
                    }
                } else {
                    dd('Não pode concluir porque a categoria tem posts');
                }
            } else {
                if($this->parent_id != null){
                   
                    $subcategory = SubCategory::findOrFail($this->category_id);
                    $subcategory->update([
                        'name' => $this->name,
                        'description' => $this->description,
                        'slug' => Str::slug($this->name),
                        'parent_id' => $this->parent_id
                    ]);
                    $this->emit('refreshPage');
                    $this->ResetAll();

                }else{

                    $category = Category::create([
                        'name' => $this->name,
                        'desciption' => $this->description,
                        'slug' => Str::slug($this->name),
                    ]);

                    if ($category) {
                        SubCategory::find($this->category_id)->delete();
                        $this->emit('refreshPage');
                        $this->ResetAll();
                    }
                }
            }
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if ($category->delete()) {
            SubCategory::where('parent_id', $id)->delete();
            $this->emit('refreshPage');
        }
    }

    public function editSubCategory($category)
    {
        $this->resetForm();
        $this->update_mode = true;
        $this->subcategory_update_mode = true;
        $this->category_id = $category['id'];
        $this->name = $category['name'];
        $this->description = $category['description'];
        $this->parent_id = $category['parent_id'];
    }

    public function updateSubCategory()
    {
        if ($this->parent_id == '---Nehum--') {
            $this->parent_id = null;
        }
    }

    public function deleteSubCategory($id)
    {
        $subcategory = SubCategory::find($id);
        if ($subcategory->delete()) {
            $this->emit('refreshPage');
        }
    }

    public function render()
    {
        $data = Category::with('child')->get();
        //dd($data);

        return view('livewire.posts.categories', ['categories' => $data]);
    }
}
