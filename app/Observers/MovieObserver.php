<?php

namespace App\Observers;

use App\Models\Movie;
use App\Models\User;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\URL;

class MovieObserver
{
    /**
     * Handle the Movie "created" event.
     */
    public function created(Movie $movie): void
    {
        $this->getNovaNotification($movie, 'New movie added: ', 'success', '/');
    }

    /**
     * Handle the Movie "updated" event.
     */
    public function updated(Movie $movie): void
    {
        $this->getNovaNotification($movie, 'Updated movie: ', 'info', $movie->id);
    }

    /**
     * Handle the Movie "deleted" event.
     */
    public function deleted(Movie $movie): void
    {
        $this->getNovaNotification($movie, 'Deleted movie: ', 'error', '/');
    }

    /**
     * Handle the Movie "restored" event.
     */
    public function restored(Movie $movie): void
    {
        $this->getNovaNotification($movie, 'Restored movie: ', 'success', $movie->id);
    }

    /**
     * Handle the Movie "force deleted" event.
     */
    public function forceDeleted(Movie $movie): void
    {
        $this->getNovaNotification($movie, 'Force Deleted movie: ', 'error', $movie->id);
    }

    private function getNovaNotification($movie, $message, $type, $url): void
    {
        foreach (User::all() as $user) {
            $user->notify(NovaNotification::make()
                    ->message($message . ' '. $movie->title)
                    ->icon('film')
                    ->type($type)
                    ->action('View', URL::make('/resources/movies/' . $url)));
        }
    }
}
