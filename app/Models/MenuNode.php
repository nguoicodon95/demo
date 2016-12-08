<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuNode extends Model
{
    protected $table = 'menu_nodes';

    public $fillable = [
        'menu_id',
        'parent_id',
        'related_id',
        'type',
        'title',
        'url',
        'target',
        'icon_font',
        'css_class',
        'order'
    ];

    public function page()
    {
        return $this->belongsTo('App\Models\Page', 'related_id');
    }
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'related_id');
    }
}
