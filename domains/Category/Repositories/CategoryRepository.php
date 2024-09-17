<?php

namespace Domains\Category\Repositories;

use Domains\Base\Repositories\BaseRepository;
use Domains\Category\Models\Category;

/**
 * Class CategoryRepository
*/

class CategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected array $fieldSearchable = [
        'title',
        'desc',
        'active'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function create(array $input): \Illuminate\Database\Eloquent\Model
    {
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Category::class;
    }
}
