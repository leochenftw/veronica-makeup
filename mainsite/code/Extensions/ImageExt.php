<?php

class ImageExt extends DataExtension
{
    private static $default_sort = 'Sort ASC';

    private static $db = [
        'Sort'      =>  'Int',
        'Category'  =>  'Varchar(1024)'
    ];

    /**
     * Update Fields
     * @return FieldList
     */
    public function updateCMSFields(FieldList $fields)
    {
        $owner = $this->owner;
        $fields->addFieldToTab(
            'Root.Main',
            CheckboxSetField::create(
                'Category',
                'Category',
                $owner->config()->Categories
            )
        );
        return $fields;
    }

    /**
     * Belongs_many_many relationship
     * @var array
     */
    private static $belongs_many_many = [
        'Pages'     =>  'Page'
    ];

    public function getRatio()
    {
        $width = $this->owner->Width;
        $height = $this->owner->Height;

        // SaltedHerring\Debugger::inspect($width . ' : ' . $height);

        return (($height / $width) * 100) . '%';
    }
}
