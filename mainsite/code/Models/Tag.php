<?php

class Tag extends DataObject
{
    /**
     * Database fields
     * @var array
     */
    private static $db = array(
        'Title'         =>  'Varchar(64)'
    );

    private static $belongs_many_many = array(
        'PhotoSets'      =>  'PhotoSet'
    );
}
