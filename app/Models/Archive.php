<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'archives';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getBookWithLink()
    {
        $bookTitle = Book::findOrFail($this->book_id)->title;
        return '<a href="' . url('admin/book/' . $this->book_id . '/show') . '" target="_blank">' . $bookTitle . '</a>';
    }
    public function getClientWithLink()
    {
        $clientFullName = Client::findOrFail($this->client_id)->first_name . ' ' . Client::findOrFail($this->client_id)->last_name;
        return '<a href="' . url('admin/client/' . $this->client_id . '/show') . '" target="_blank">' . $clientFullName . '</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setDatetimeAttribute($value)
    {
        $this->attributes['datetime'] = \Date::parse($value);
    }
}
