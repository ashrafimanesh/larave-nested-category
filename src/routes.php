<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh
 * Date: 11/12/16
 * Time: 10:11 AM
 */


Route::group(['prefix'=>'nestedCategories','middleware' => ['web']],function(){
    Route::resource('/','Ashrafi\NestedCategories\NestedCategoriesController');
});
