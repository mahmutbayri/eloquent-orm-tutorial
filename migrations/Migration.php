<?php

namespace Migration;

use Illuminate\Database\Schema\Builder;
use Illuminate\Database\Capsule\Manager;

class Migration
{
    /**
     * @var Builder
     */
    protected $schema;

    public function __construct(Manager $manager)
    {
        $this->schema = $manager->schema('default');
    }
}