<?php
namespace App\Repositories;

use Rinvex\Repository\Repositories\EloquentRepository;

class CompanyRepository extends EloquentRepository
{
    protected $repositoryId = 'rinvex.repository.user';
    protected $model = 'App\Company';
}