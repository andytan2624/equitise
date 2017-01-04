<?php
namespace App\Repositories;

use Rinvex\Repository\Repositories\EloquentRepository;

class SyndicateRepository extends EloquentRepository
{
    protected $repositoryId = 'rinvex.repository.user';
    protected $model = 'App\Syndicate';
}