<?php

namespace Hellm\XenonBank\controller;

class TestController
{
    public function index(int $id): void
    {
        var_dump($id);
        echo "success" . $id;
    }

    public function test(): void
    {
        echo "success";
    }
}
