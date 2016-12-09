<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = ['key', 'display_name', 'value', 'options', 'type', 'order', 'details'];

    public $timestamps = false;

    public static function getAllSettings()
    {
        $result = [];
        $settings = static::get();
        if ($settings) {
            foreach ($settings as $key => $row) {
                $result[$row->key] = $row->value;
            }
        }
        return $result;
    }
}
