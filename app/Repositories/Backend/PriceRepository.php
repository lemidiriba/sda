<?php

namespace App\Repositories\Backend\Message;

use App\Models\Price;
use App\Repositories\BaseRepository;

/**
 * MessageRepository class
 *
 */
class PriceRepository extends BaseRepository
{
    /**
     * MessageRepositoryConstruct functio
     */
    public function __construct(Price $model)
    {
        $this->model = $model;
    }
}