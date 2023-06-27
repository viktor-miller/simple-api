<?php

namespace App\Services;

use App\Models\UserPost;
use App\DAO\PostStatsCriteriaDAO;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class UserPostService implements CreateOrUpdateHandler
{
    use CreateOrUpdateTrait;

    /**
     * Die durchschnittliche Anzahl der Wörter in den Beiträgen aller
     * Benutzer unter Berücksichtigung der übergegebenen $criteria abfragen.
     */
    public function getWordsAverage(PostStatsCriteriaDAO $criteria): float
    {
        $qb = UserPost::query()
            ->select(DB::raw("AVG(LENGTH(body) - LENGTH(REPLACE(body, ' ', '')) + 1) as average"));

        // filter query by gender.
        if ($gender = $criteria->getGender()) {
            $qb->whereHas('user', function (Builder $q) use ($gender) {
                $q->where('gender', '=', $gender);
            });
        }

        // filter query by status.
        if ($status = $criteria->getStatus()) {
            $qb->whereHas('user', function (Builder $q) use ($status) {
                $q->where('status', '=', $status);
            })->get();
        }

        return (float) $qb->pluck('average')->first();
    }

    /**
     * Count rows.
     */
    public function count(): int
    {
        return DB::table((new UserPost())->getTable())->count();
    }

    /**
     * Find row by given $id.
     */
    public function find(int $id): ?UserPost
    {
        return UserPost::find($id);
    }

    /**
     * Daten validieren und falls diese valide sind in die DB schreiben.
     *
     * Bei Validierung müssen folgende Punkte beachtet werden:
     * - id soll unique sein
     * - user_id soll in der DB bereits existieren
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
     * - Auf max Zeilenlänge prüfen.
     */
    public function update(UserPost $userPost, array $data): void
    {
        //
    }
}
