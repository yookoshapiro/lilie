<?php namespace Lilie\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'page';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        //

    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

        //

    ];

}