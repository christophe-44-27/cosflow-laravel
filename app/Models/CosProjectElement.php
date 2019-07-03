<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CosProjectElement extends Model
{
    protected $table = 'cos_project_elements';
    public $guarded = [];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cosProject()
    {
        return $this->belongsTo(CosProject::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function elementable()
    {
        return $this->morphTo();
    }
}
