<?php

namespace App\Policies;

use App\Models\Prodi;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProdiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Prodi $prodi)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
       return in_array($user->email,[
        'callistavirginia@gmail.com',
        'user2@gmail.com'
       ]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Prodi $prodi)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Prodi $prodi)
    {
        //
        return in_array($user->email,[
            'callistavirginia@gmail.com',
        ]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Prodi $prodi)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Prodi $prodi)
    {
        //
    }
}
