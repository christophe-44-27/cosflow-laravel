<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreatedElement extends Model
{
    protected $table = 'cos_project_created_elements';
    protected $guarded = [];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function created_elementable()
    {
        return $this->morphTo();
    }
}
