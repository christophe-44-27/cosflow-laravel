<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CosProject extends Model
{
    protected $table = 'cos_projects';
    public $guarded = [];
    protected $dates = ['starting_date', 'due_date'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cosElements()
    {
        return $this->belongsToMany(CosProjectElement::class, 'cos_project_cos_project_elements');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
