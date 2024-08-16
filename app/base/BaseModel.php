<?php

namespace Hellm\XenonBank\base;

use Hellm\XenonBank\trait\ModelHelperTrait;

class BaseModel
{
    use ModelHelperTrait;

    private string $path_to_file;
    private array $data;
    public array $keys = [];
    private string $associated_field_name;
    private mixed $associated_field_value;
    private int $key;


    public function __construct(string $file_name, array $keys)
    {
        $this->path_to_file = dirname(__DIR__) . "/database/" . $file_name . ".json";
        $this->keys = $keys;
        $this->loadDataFromFile();
    }

    public function __get(string $name)
    {
        return $this->data[$this->key][$name];
    }

    public function __set(string $name, mixed $value)
    {
        $lastElementIndex = count($this->data) - 1;

        if (isset($this->data[$lastElementIndex]) && !isset($this->data[$lastElementIndex]['id'])) {
            $this->data[$lastElementIndex][$name] = $value;
        } else {
            $this->data[] = [$name => $value];
        }
    }

    public function save(): void
    {
        $this->prepareDataBeforeSave();
        $this->write();
    }

    public function update(int $id, array $data): void
    {
        foreach ($this->data as $key => &$value) {
            if ($value["id"] == $id) {
                foreach ($this->keys as $key) {
                    if (isset($data[$key])) $value[$key] = $data[$key];
                }
            }
        }
        $this->write();
    }

    public function delete(int $id): void
    {
        try {
            $this->data = array_filter($this->data, function ($item) use ($id) {
                return $item['id'] !== $id;
            });
            $this->data = array_values($this->data);
            $this->write();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
