<?php

namespace App\Filament\Pages;
use Filament\Auth\Pages\EditProfile;
use Filament\Notifications\Notification as FilamentNotification;
class MyProfile extends EditProfile
{
    protected function getSavedNotification(): ?FilamentNotification
    {
        return FilamentNotification::make()
            ->success()
            ->title('Post updated')
            ->body('Post updated successfully');
    }
}
