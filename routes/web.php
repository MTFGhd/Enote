<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartementsController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\MatieresController;
use App\Http\Controllers\EnseignantsController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\AvancementController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("welcome");
});

Route::middleware("auth")->group(function () {
    Route::get("/dashboard", function () {
        return view("dashboard");
    })->name("dashboard");

    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit",
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update",
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy",
    );

    // Routes admin uniquement - Gestion des données de base
    Route::middleware("check.role:admin")->group(function () {
        Route::resource("users", UsersController::class);
        Route::resource("departements", DepartementsController::class);
        Route::resource("classes", ClassesController::class);
        Route::resource("matieres", MatieresController::class);
        Route::resource("enseignants", EnseignantsController::class);
    });

    // Routes accessibles à tous les utilisateurs authentifiés
    Route::resource("cours", CoursController::class);
    
    // Route pour valider une séance (Direction uniquement)
    Route::post("/cours/{id}/valider", [CoursController::class, "valider"])
        ->name("cours.valider")
        ->middleware("check.role:D");
    
    // Routes PDF pour Direction
    Route::middleware("check.role:D")->group(function () {
        Route::get("/cours-pdf/seances/form", [CoursController::class, "pdfSeancesForm"])
            ->name("cours.pdf.seances.form");
        Route::post("/cours-pdf/seances", [CoursController::class, "pdfSeances"])
            ->name("cours.pdf.seances");
        Route::get("/cours-pdf/avancement/form", [CoursController::class, "pdfAvancementForm"])
            ->name("cours.pdf.avancement.form");
        Route::post("/cours-pdf/avancement", [CoursController::class, "pdfAvancement"])
            ->name("cours.pdf.avancement");
    });

    // Routes spéciales pour Avancement (clé composite)
    Route::get("/avancement", [AvancementController::class, "index"])->name(
        "avancement.index",
    );
    Route::get("/avancement/create", [
        AvancementController::class,
        "create",
    ])->name("avancement.create");
    Route::post("/avancement", [AvancementController::class, "store"])->name(
        "avancement.store",
    );
    Route::get("/avancement/{codeE}/{codeC}/{codeM}", [
        AvancementController::class,
        "show",
    ])->name("avancement.show");
    Route::get("/avancement/{codeE}/{codeC}/{codeM}/edit", [
        AvancementController::class,
        "edit",
    ])->name("avancement.edit");
    Route::put("/avancement/{codeE}/{codeC}/{codeM}", [
        AvancementController::class,
        "update",
    ])->name("avancement.update");
    Route::delete("/avancement/{codeE}/{codeC}/{codeM}", [
        AvancementController::class,
        "destroy",
    ])->name("avancement.destroy");

    // Routes d'importation CSV (admin uniquement)
    Route::middleware("check.role:admin")->group(function () {
        Route::get("/avancement/import", [
            AvancementController::class,
            "showImportForm",
        ])->name("avancement.import");
        Route::post("/avancement/import", [
            AvancementController::class,
            "import",
        ])->name("avancement.import.process");
    });
});

require __DIR__ . "/auth.php";
