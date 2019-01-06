<?php

namespace BloomGoo\Generator\Common;

use Exception;

abstract class BaseRepository extends \Prettus\Repository\Eloquent\BaseRepository
{
    public function findWithoutFail($id, $columns = ['*'])
    {
        try {
            return $this->find($id, $columns);
        } catch (Exception $e) {
            return;
        }
    }

    public function create(array $attributes)
    {
        // Have to skip presenter to get a model not some data
        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);
        $model = parent::create($attributes);
        $this->skipPresenter($temporarySkipPresenter);

        $model = $this->updateRelations($model, $attributes);
        $model->save();

        return $this->parserResult($model);
    }

    public function update(array $attributes, $id)
    {
        // Have to skip presenter to get a model not some data
        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);
        $model = parent::update($attributes, $id);
        $this->skipPresenter($temporarySkipPresenter);

        $model = $this->updateRelations($model, $attributes);
        $model->save();

        return $this->parserResult($model);
    }

    public function updateRelations($model, $attributes)
    {
        foreach ($attributes as $key => $val) {
            if (isset($model) &&
                method_exists($model, $key) &&
                is_a(@$model->$key(), 'Illuminate\Database\Eloquent\Relations\Relation')
            ) {
                $methodClass = get_class($model->$key($key));
                switch ($methodClass) {
                    case 'Illuminate\Database\Eloquent\Relations\BelongsToMany':
                        $new_values = array_get($attributes, $key, []);
                        if (array_search('', $new_values) !== false) {
                            unset($new_values[array_search('', $new_values)]);
                        }
                        $model->$key()->sync(array_values($new_values));
                        break;
                    case 'Illuminate\Database\Eloquent\Relations\BelongsTo':
                        $model_key = $model->$key()->getForeignKey();
                        $new_value = array_get($attributes, $key, null);
                        $new_value = $new_value == '' ? null : $new_value;
                        $model->$model_key = $new_value;
                        break;
                    case 'Illuminate\Database\Eloquent\Relations\HasOne':
                        break;
                    case 'Illuminate\Database\Eloquent\Relations\HasOneOrMany':
                        break;
                    case 'Illuminate\Database\Eloquent\Relations\HasMany':
                        $new_values = array_get($attributes, $key, []);
                        if (array_search('', $new_values) !== false) {
                            unset($new_values[array_search('', $new_values)]);
                        }

                        list($temp, $model_key) = explode('.', $model->$key($key)->getForeignKey());

                        foreach ($model->$key as $rel) {
                            if (!in_array($rel->id, $new_values)) {
                                $rel->$model_key = null;
                                $rel->save();
                            }
                            unset($new_values[array_search($rel->id, $new_values)]);
                        }

                        if (count($new_values) > 0) {
                            $related = get_class($model->$key()->getRelated());
                            foreach ($new_values as $val) {
                                $rel = $related::find($val);
                                $rel->$model_key = $model->id;
                                $rel->save();
                            }
                        }
                        break;
                }
            }
        }

        return $model;
    }

    /*TOANDK START MODIFYING*/
    public function  destroy_multiple(array $ids)
    {
        foreach ($ids as $field => $id){
            $this->delete($id);
        }
    }

    /*overrride*/
    public function findByField($field, $condition = '=', $value = null, $columns = ['*'], $is_paging = true, $limit = 15)
    {
        $this->applyCriteria();
        $this->applyScope();
        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
        if ($is_paging) $model = $this->model->where($field, $condition, $value)->paginate($limit, $columns);
        else $model = $this->model->where($field, $condition, $value)->get($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /*overrride*/
    public function findWhere(array $where, $columns = ['*'], $is_paging = true, $limit = 15)
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditions($where);

        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
        if ($is_paging) $model = $this->model->paginate($limit, $columns);
        else  $model = $this->model->get($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /*overrride*/
    public function findWhereIn($field, array $values, $columns = ['*'], $is_paging = true, $limit = 15)
    {
        $this->applyCriteria();
        $this->applyScope();
        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
        if ($is_paging) $model = $this->model->whereIn($field, $values)->paginate($limit, $columns);
        else  $model = $this->model->whereIn($field, $values)->get($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /*overrride*/
    public function findWhereNotIn($field, array $values, $columns = ['*'], $is_paging = true, $limit = 15)
    {
        $this->applyCriteria();
        $this->applyScope();

        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
        if ($is_paging) $model = $this->model->whereNotIn($field, $values)->paginate($limit, $columns);
        else $model = $this->model->whereNotIn($field, $values)->get($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    protected $categoriesTree = [];

    public function buildTree($name, $columns = ['*'], $separator = '— ', $id = null){
        $categoriesParent = $this->model->whereNull('parent_id')->get($columns);
        if ($id != null) {
            $categoriesParent = $this->model->whereNull('parent_id')->where('id', '<>', $id)->get($columns);
        }
        foreach ($categoriesParent as $category) {
            $this->categoriesTree[] = $category;
            $this->getChild($name, $category, '', $columns, $separator, $id);
        }
        return $this->categoriesTree;
    }

    public function getChild($name, $category, $level, $columns = ['*'], $separator = '— ',$id = null) {
        $childrens =  $this->model->where('parent_id',$category->id)->where("id","<>",$id)->get($columns);
        if(empty($childrens)) return;
        $level .= $separator;
        foreach ($childrens as $children) {
            $children->$name = $level.$children->$name;
            $this->categoriesTree[] = $children;
            $this->getChild($name, $children, $level, $columns, $separator);
        }
    }

    public function buildTreeForSelectBox($name = 'name', $columns = ['*'], $separator = '— ', $id = null) {
        $categoryList = $this->buildTree($name, $columns, $separator, $id);
        $categories = array();
        $categories[0] = __('--NULL--');
        foreach($categoryList as $category) {
            $categories[$category->id] = $category->$name;
        }

        return $categories;
    }

    public function getAllForSelectBox($columns = ['*'], $id = null, $blank = true) {
        $categoryList = $this->model->all($columns);
        $categories = array();
        if ($blank) $categories[0] = __('--NULL--');
        foreach($categoryList as $category) {
            if ($category->id != $id || $id == null) {
                $categories[$category->id] = $category->name;
            }
        }

        return $categories;
    }
    /*TOANDK END MODIFYING*/
}
