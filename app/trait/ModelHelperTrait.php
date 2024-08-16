<?php

namespace Hellm\XenonBank\trait;

trait ModelHelperTrait
{
    protected int $length = 0;

    protected function loadDataFromFile(): void
    {
        try {
            $json = file_get_contents($this->path_to_file);
            $this->data = json_decode($json, true) ?? [];
            $this->length = count($this->data);
        } catch (\Throwable $th) {
            throw new \RuntimeException("Failed to load data from file.", 0, $th);
        }
    }

    protected function prepareDataBeforeSave(): void
    {
        $newData = $this->prepareNewData();
        array_push($this->data, $newData);
    }

    protected function prepareNewData(): array
    {
        $latestElement = end($this->data);
        $newData = ['id' => $this->getLastId() + 1];

        foreach ($this->keys as $key) {
            if ($key !== 'id') {
                $newData[$key] = $latestElement[$key] ?? null;
            }
        }

        return $newData;
    }

    protected function getLastId(): int
    {
        return $this->data[$this->length - 1]["id"] ?? 0;
    }

    protected function write(): void
    {
        try {
            $jsonContent = json_encode($this->data, JSON_PRETTY_PRINT);
            file_put_contents($this->pathToFile, $jsonContent);
        } catch (\Throwable $th) {
            throw new \RuntimeException("Failed to write data to file.", 0, $th);
        }
    }

    public function get(): array
    {
        if (isset($this->associated_field_name) && $this->associated_field_value !== null) {
            return array_filter($this->data, fn($item) => isset($item[$this->associated_field_name]) && $item[$this->associated_field_name] === $this->associated_field_value);
        }
        return $this->data;
    }

    public function where(string $associated_field_name, mixed $associated_field_value): static
    {
        $this->associated_field_name = $associated_field_name;
        $this->associated_field_value = $associated_field_value;

        return $this;
    }

    public function find(int $id): array
    {
        $this->key = key($this->where("id", $id)->get());
        return $this->where("id", $id)->get();
    }
}
