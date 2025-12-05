<?php

namespace App\Enums;

enum IncidentStatus: string {
    case ACTIVE = 'active';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';
    case PENDING = 'pending';
}
