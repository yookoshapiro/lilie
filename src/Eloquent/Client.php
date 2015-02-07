<?php namespace Lilie\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'client';


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
     * Return the pages assigns to this client.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

}