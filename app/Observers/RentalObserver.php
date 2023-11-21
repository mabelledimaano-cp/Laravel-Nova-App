<?php

namespace App\Observers;

use App\Models\Rental;
use App\Models\User;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\URL;

class RentalObserver
{
    /**
     * Handle the Rental "created" event.
     */
    public function created(Rental $rental): void
    {
        $this->getNovaNotification($rental, 'New rental request created: No. ', 'success', $rental->id);
    }

    /**
     * Handle the Rental "updated" event.
     */
    public function updated(Rental $rental): void
    {
        $this->getNovaNotification($rental, 'Updated rental: No. ', 'info', $rental->id);
    }

    /**
     * Handle the Rental "deleted" event.
     */
    public function deleted(Rental $rental): void
    {
        $this->getNovaNotification($rental, 'Deleted rental: No. ', 'error', '');
    }

    /**
     * Handle the Rental "restored" event.
     */
    public function restored(Rental $rental): void
    {
        $this->getNovaNotification($rental, 'Restored rental: No. ', 'success', '');
    }

    /**
     * Handle the Rental "force deleted" event.
     */
    public function forceDeleted(Rental $rental): void
    {
        $this->getNovaNotification($rental, 'Force Deleted rental: No. ', 'error', '');
    }

    private function getNovaNotification($rental, $message, $type, $url): void
    {
        foreach (User::all() as $user) {
            $user->notify(NovaNotification::make()
                ->message($message . ' '. $rental->id)
                ->icon('banknotes')
                ->type($type)
                ->action('View', URL::make('/resources/customers/' . $url)));
        }
    }
}
