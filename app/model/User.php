<?php

namespace Hellm\XenonBank\model;

use Hellm\XenonBank\base\BaseModel;

class User extends BaseModel
{
    public function __construct()
    {
        parent::__construct("users", ["id", "name", "email", "password", "image", "created_at"]);
    }
}
