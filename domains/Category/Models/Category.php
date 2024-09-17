<?php

namespace Domains\Category\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Category
 * @package App\Models
 * @version October 10, 2023, 1:08 pm UTC
 *
 * @property string $title
 * @property string $desc
 * @property string $image
 * @property boolean $active
 */
class Category extends Model
{
    use SoftDeletes;

    use HasFactory;
    use HasTranslations;

    protected $translatable = ['title','desc'];

    protected $table = 'categories';
    protected $dates = ['deleted_at'];



    protected  $fillable = [
        'title',
        'desc',
        'image',
        'parent_id',
        'active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'desc' => 'string',
        'image' => 'string',
        'active' => 'boolean'
    ];

    public function scopeSearch(){
        if (request('search')){
            return $this->where('name','like',request('search'));
        }
    }

    public function ParentCategory() belongsto{

    }

public function sub_categories() hasmany{

}

    {

    }

}
