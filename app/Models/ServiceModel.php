<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    use HasFactory;
    public $table = 'services';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
}
