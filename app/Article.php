<?php
/**
 * Created by PhpStorm.
 * User: muslim
 * Date: 18.04.19
 * Time: 1:53
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'body'
    ];
}
