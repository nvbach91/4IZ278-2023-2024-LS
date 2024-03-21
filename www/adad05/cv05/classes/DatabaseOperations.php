<?php

interface DatabaseOperations
{
    public function create($data);
    public function find($query);
    public function update($query, $data);
    public function delete($query);
}
