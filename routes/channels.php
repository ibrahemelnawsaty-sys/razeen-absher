<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Register the event broadcasting channels that your application supports.
| For development we allow public 'incidents' channel; tighten auth in prod.
|
*/

Broadcast::channel('incidents', function () {
    return true; // dev: allow public subscription. Replace with auth logic in production.
});

Broadcast::channel('layers', function () {
    return true; // Allow public access for now
});
