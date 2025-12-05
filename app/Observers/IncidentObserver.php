<?php

namespace App\Observers;

use App\Events\IncidentUpdated;
use App\Models\Incident;

class IncidentObserver
{
    public function created(Incident $incident)
    {
        event(new IncidentUpdated($incident->toFeature()));
    }

    public function updated(Incident $incident)
    {
        event(new IncidentUpdated($incident->toFeature()));
    }

    // optional: deleted, restored handlers can be added later
}
