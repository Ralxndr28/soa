<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenTask extends Model
{
    use HasFactory;

    protected $primaryKey = 'kitchen_task_id';

    protected $table = 'kitchen_tasks';

    protected $fillable = [
        'order_id', 'menu', 'quantity', 'chef', 'status', 'notes'
    ];
}