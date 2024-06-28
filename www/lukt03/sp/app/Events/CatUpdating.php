<?php

namespace App\Events;

use App\Models\Cat;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CatUpdating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

   /**
     * Create a new event instance.
     */
    public function __construct(public Cat $cat)
    {
        //
    }
}
