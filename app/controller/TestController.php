<?php

namespace Hellm\XenonBank\controller;

use Hellm\XenonBank\model\User;
use Hellm\XenonBank\base\BaseModel;
use Hellm\XenonBank\model\Transaction;

class TestController
{

    public function index(int $id): void
    {
        var_dump($id);
        echo "success" . $id;
    }

    public function test(): void
    {
        // echo "success";

        // // Example usage
        // $name = 'John Doe';

        // $avatarUrl = getAvatarUrl($name);
        // echo '<img src="' . $avatarUrl . '" alt="Profile Image" />';

        $user = new User();
        $transaction = new Transaction();
        $transaction->find(1);
        // $tr = $transaction->where("user_id", 1)->get();
        var_dump($transaction->deposit);
    }
}
