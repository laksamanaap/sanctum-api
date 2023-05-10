<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Project",
 *     description="Project model",
 *     @OA\Xml(
 *         name="Project"
 *     )
 * )
 */
class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
}
