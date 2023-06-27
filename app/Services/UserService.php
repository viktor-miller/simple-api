<?php

namespace App\Services;

use App\Models\User;

class UserService implements CreateOrUpdateHandler
{
    use CreateOrUpdateTrait;

    public function find(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Daten validieren und falls diese valide sind in die DB schreiben.
     *
     * Bei Validierung müssen folgende Punkte beachtet werden:
     * - id soll unique sein
     * - email soll unique sein
     * - Auf max Zeilenlänge prüfen.
     */
    public function create(array $data): void
    {
        //
    }

    /**
     * Daten validieren und falls diese valide sind in der DB aktualisieren.
     *
     * Bei Validierung müssen folgende Punkte beachtet werden:
     * - email soll unique sein
     * - Auf max Zeilenlänge prüfen.
     */
    public function update(User $user, array $data): void
    {
        //
    }
}
