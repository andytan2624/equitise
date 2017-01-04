<?php
namespace App\Repositories;

use Rinvex\Repository\Repositories\EloquentRepository;

class RoleUserRepository extends EloquentRepository
{
    protected $repositoryId = 'rinvex.repository.user';
    protected $model = 'App\RoleUser';
}