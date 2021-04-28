<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version April 26, 2021, 12:28 pm -03
*/
class UserRepository extends BaseRepository
{
    /**
     * The fields that can be searched.
     *
     * @var array
     */
    protected $fieldSearchable = [
        "name",
        "email",
        "password",
        "is_active",
        "photo",
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return User::class;
    }
}
