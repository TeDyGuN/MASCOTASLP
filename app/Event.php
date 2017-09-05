<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo_evento', 'start', 'backgroundColor', 'borderColor', 'allDay', 'id_eventoCallendar', 'user_id'];
}
