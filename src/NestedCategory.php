<?php
namespace Ashrafi\NestedCategories;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: ashrafimanesh
 * Date: 11/20/16
 * Time: 9:32 PM
 */
class NestedCategory extends Model
{
    protected $table='categories';
    protected $fillable=['title','parent_addresses','status'];
}