<?php

namespace App\Observers;

use App\Models\Customer;
use App\Models\User;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\URL;

class CustomerObserver
{
    /**
     * Handle the Customer "created" event.
     */
    public function created(Customer $customer): void
    {
        $this->getNovaNotification($customer, 'New customer joined: ', 'success', $customer->id);
    }

    /**
     * Handle the Customer "updated" event.
     */
    public function updated(Customer $customer): void
    {
        $this->getNovaNotification($customer, 'Updated customer: ', 'info', $customer->id);
    }

    /**
     * Handle the Customer "deleted" event.
     */
    public function deleted(Customer $customer): void
    {
        $this->getNovaNotification($customer, 'Deleted customer: ', 'error', '/');
    }

    /**
     * Handle the Customer "restored" event.
     */
    public function restored(Customer $customer): void
    {
        $this->getNovaNotification($customer, 'Restored customer: ', 'success', $customer->id);
    }

    /**
     * Handle the Customer "force deleted" event.
     */
    public function forceDeleted(Customer $customer): void
    {
        $this->getNovaNotification($customer, 'Force Deleted customer: ', 'error', '');
    }

    private function getNovaNotification($customer, $message, $type, $url): void
    {
        foreach (User::all() as $user) {
            $user->notify(NovaNotification::make()
                ->message($message . ' '. $customer->name)
                ->icon('user')
                ->type($type)
                ->action('View', URL::make('/resources/customers/' . $url)));
        }
    }
}
