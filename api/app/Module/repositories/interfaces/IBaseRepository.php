<?php

namespace App\Module\Repositories\Interfaces;

interface IBaseRepository
{
    public function all(array $columns = ['*']): array;

//    public function count();
//
//    public function create(array $data);
//
//    public function createMultiple(array $data);
//
//    public function updateById($id, array $data, array $options = []);
//
//    public function delete();
//
//    public function deleteById($id);
//
//    public function deleteMultipleById(array $ids);
//
//    public function first(array $columns = ['*']);
//
//    public function get(array $columns = ['*']);
//
//    public function getById($id, array $columns = ['*']);
//
//    public function getByColumn($item, $column, array $columns = ['*']);
//
//    public function paginate($limit = 25, array $columns = ['*'], $pageName = 'page', $page = null);
//
//    public function limit($limit);
//
//    public function orderBy(string $column, string $value);
//
//    public function where(string $column, string $value, string $operator = '=');
//
//    public function whereIn(string $column, string $value);
//
//    public function with($relations);
}
