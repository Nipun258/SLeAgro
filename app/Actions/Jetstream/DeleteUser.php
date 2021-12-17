<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;
use Illuminate\Support\Facades\Log;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {   
        Log::info('CreateNewUserController -> UserDelete started');
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
        Log::alert('CreateNewUserController -> Delete Normal User Id With - ' . $user->id);
        Log::info('CreateNewUserController -> UserDelete ended');
    }
}
