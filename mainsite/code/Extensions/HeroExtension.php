<?php

class HeroExtension extends DataExtension
{
    /**
     * Database fields
     * @var array
     */
    private static $db = array(
        'HorizontalPosition'    =>  'Varchar(8)',
        'VerticalPosition'      =>  'Varchar(8)'
    );
    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = array(
        'PageHero'              =>  'Image'
    );

    /**
     * Update Fields
     * @return FieldList
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldstoTab(
            'Root.PageHeroImage',
            array(
                SaltedUploader::create('PageHero', 'Page hero image')->setCropperRatio(16/9),
                DropdownField::create(
                    'HorizontalPosition',
                    'x position',
                    Config::inst()->get('BackgroundPosition', 'Horizontal'),
                    'center'
                ),
                DropdownField::create(
                    'VerticalPosition',
                    'y position',
                    Config::inst()->get('BackgroundPosition', 'Vertical'),
                    'center'
                )
            )
        );
        return $fields;
    }
}
