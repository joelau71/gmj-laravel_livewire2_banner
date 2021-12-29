<?php

use GMJ\LaravelLivewire2Banner\Http\Controllers\BlockController;
use GMJ\LaravelLivewire2Banner\Http\Livewire\Backend;
use Illuminate\Support\Facades\Route;

Route::group([
    "middleware" => ["web", "auth"],
    "prefix" => "admin/element/{element_id}/gmj/laravel_livewire2_banner",
    "as" => "LaravelLivewire2Banner."
], function () {
    Route::get("index", [BlockController::class, "index"])->name("index");
    /*     Route::get("create", [BlockController::class, "create"])->name("create");
    Route::post("store", [BlockController::class, "store"])->name("store");
    Route::get("edit/{id}", [BlockController::class, "edit"])->name("edit");
    Route::patch("update/{id}", [BlockController::class, "update"])->name("update"); */

    Route::get("create", Backend::class)->name("create");
    Route::get("edit/{id}", Backend::class)->name("edit");

    Route::get("order", [BlockController::class, "order"])->name("order");
    Route::post("order2", [BlockController::class, "order2"])->name("order2");
    Route::delete("delete/{id}", [BlockController::class, "destroy"])->name("delete");
});
