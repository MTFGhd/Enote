<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Enseignants;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * Display a listing of the users (admin only).
     */
    public function index(): View
    {
        $users = User::with("enseignant")->orderBy("name")->paginate(15);

        return view("users.index", compact("users"));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        $enseignants = Enseignants::orderBy("Libelle")->get();
        $roles = [
            "admin" => "Administrateur",
            "E" => "Enseignant",
            "D" => "Direction",
        ];

        return view("users.create", compact("enseignants", "roles"));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($data["role"] !== "E") {
            $data["CodeE"] = null;
        }

        // Store plain password before hashing for email
        $plainPassword = $data["password"];
        $data["password"] = Hash::make($data["password"]);

        $user = new User($data);
        
        // Set plain password for email sending (will be used in created event)
        $user->plainPassword = $plainPassword;
        $user->save();

        return redirect()
            ->route("users.index")
            ->with("success", "Utilisateur créé avec succès. Un email de bienvenue a été envoyé.");
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): View
    {
        $user->load("enseignant");

        return view("users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user): View
    {
        $enseignants = Enseignants::orderBy("Libelle")->get();
        $roles = [
            "admin" => "Administrateur",
            "E" => "Enseignant",
            "D" => "Direction",
        ];

        return view("users.edit", compact("user", "enseignants", "roles"));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        if ($data["role"] !== "E") {
            $data["CodeE"] = null;
        }

        if (empty($data["password"])) {
            unset($data["password"]);
        } else {
            $data["password"] = Hash::make($data["password"]);
        }

        $user->update($data);

        return redirect()
            ->route("users.index")
            ->with("success", "Utilisateur mis à jour avec succès.");
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return redirect()
                ->route("users.index")
                ->with(
                    "error",
                    "Vous ne pouvez pas supprimer votre propre compte.",
                );
        }

        $user->delete();

        return redirect()
            ->route("users.index")
            ->with("success", "Utilisateur supprimé avec succès.");
    }
}
