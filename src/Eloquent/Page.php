<?php namespace Lilie\Eloquent;

use App;
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


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'extra' => 'array',
        'active' => 'boolean',
        'display' => 'boolean',
    ];


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::observe( App::build(\Lilie\Eloquent\PageObserver::class) );
    }


}