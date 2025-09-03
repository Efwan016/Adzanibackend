<?php

namespace App\Repositories;

class CategoryRepository {
    public function getAll(array $fields) 
    {
        return Category::select($fields)->latest()-paginate(50);
        // name, tagline, column
        // data, column
    }

    public function getById(int $id, array $fields)
    {
        return Category::select($fields)->findOrFail($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(int $id, array $data)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete(int $id)
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }
}

