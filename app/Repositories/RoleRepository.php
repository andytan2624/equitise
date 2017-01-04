<?php
namespace App\Repositories;

use Rinvex\Repository\Repositories\EloquentRepository;

class RoleRepository extends EloquentRepository
{
    protected $repositoryId = 'rinvex.repository.user';
    protected $model = 'App\Role';
}