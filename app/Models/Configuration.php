<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'value', 'model', 'seeds', 'field_type'];

    public function data(): Attribute
    {
        return Attribute::make(get: function ($value, $attributes) {
            if (!is_null($attributes['model']))
            {
                return $attributes['model']::all()->toArray();
            }elseif (!is_null($attributes['seeds']))
            {
                $data = explode(',', $attributes['seeds']);
                $res = [];
                foreach ($data as $key => $val)
                {
                    $res[] = ['id' => $val, 'name' => $val];
                }
                return $res;
            }
            else 
            {
                return [];
            }
        });
    }
}
