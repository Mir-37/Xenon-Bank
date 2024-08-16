<?php

namespace Hellm\XenonBank\model;

use Hellm\XenonBank\base\BaseModel;

class Transaction extends BaseModel
{
    public function __construct()
    {
        parent::__construct("transactions", ["id", "user_id", "role_id", "account_number", "withdrawn", "deposit", "transferred", "transfarred_to_account", "date"]);

        $this->withdrawn = 0.0;
        $this->deposit = 0.0;
        $this->transferred = 0.0;
    }
}
