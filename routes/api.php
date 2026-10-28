<?php

use App\Http\Controllers\Api\WatchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Toko Jam Mewah (Luxury Watch API)
|--------------------------------------------------------------------------
|
| 1. GET       /api/jam-tangan       -> index
| 2. POST      /api/jam-tangan       -> store
| 3. GET       /api/jam-tangan/{id}  -> show
| 4. PUT/PATCH /api/jam-tangan/{id}  -> update
| 5. DELETE    /api/jam-tangan/{id}  -> destroy
|
*/

Route::apiResource('jam-tangan', WatchController::class)->parameters([
    'jam-tangan' => 'id',
]);
