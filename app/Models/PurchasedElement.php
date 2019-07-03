<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasedElement extends Model
{
    protected $table = 'cos_project_purchased_elements';
    protected $guarded = [];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function purchased_elementable()
    {
        return $this->morphTo();
    }
}
