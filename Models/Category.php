<?php

class Category
{
    private int $category_id;
    private string $category_name;

    public function setCategory_id(int $category_id): void
    {
        $this->category_id = $category_id;
    }
    public function setCategory_name(string $category_name): void
    {
        $this->category_name = $category_name;
    }
    public function getCategory_id(): int
    {
        return $this->category_id;
    }
    public function getCategory_name(): string
    {
        return $this->category_name;
    }
}
