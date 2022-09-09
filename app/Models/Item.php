<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_item',
        'id_user',
        'name',
        'start_price',
        'start_date',
        'end_date',
    ];

    public static function getTableName()
    {
        return (new self())->getTable();
    }
}
