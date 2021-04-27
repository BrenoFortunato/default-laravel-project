<?php

namespace App\Observers;

use App\Models\User;
use File;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "saved" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function saved(User $user)
    {
        // Handle image upload
        if (request()->photo) {
            User::withoutEvents(function () use ($user) {
                // Delete previous image
                $media = $user->getFirstMedia('users');
                if ($media) {
                    File::deleteDirectory(preg_split('~/(?=[^/]*$)~', $media->getPath())[0]);
                    $media->delete();
                }

                // Delete image
                if (request()->photo=='delete') {
                    $user->photo = null;

                // Add image from file (web)
                } elseif (file_exists(request()->photo)) {
                    $media = $user->addMedia(request()->photo)->toMediaCollection('users');
                    $user->photo = $media->getFullUrl();
                
                // Add image from base64 (api)
                } else {
                    $media = $user->addMediaFromBase64(request()->photo)->toMediaCollection('users');
                    $user->photo = $media->getFullUrl();
                }

                // Save changes
                $user->save();
            });
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
