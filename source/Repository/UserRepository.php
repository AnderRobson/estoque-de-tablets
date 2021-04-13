<?php

namespace Source\Repository;

use Source\Model\UserModel;

class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct('user', UserModel::class);
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}
