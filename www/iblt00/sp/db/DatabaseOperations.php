<?php

interface DatabaseOperations
{
    //new record
    function create($data);
    //return all db records
    function fetchAll();
    //return db records searched by column name and searched value
    function fetchBy($field, $value);
    //update db field with new value
    function updateBy($conditions, $args);

    //TODO: delete / set inactive => admin
}
