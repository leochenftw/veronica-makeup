<?php
use SaltedHerring\Debugger;
use SaltedHerring\Grid;
class HomePage extends Page
{
    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'PhotosTitle'   =>  'Varchar(128)',
        'AboutUs'       =>  'HTMLText'
    ];
    /**
     * Many_many relationship
     * @var array
     */
    private static $many_many = [
        'Photos'        =>  'Image'
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab(
            'Root.Photos',
            [
                TextField::create(
                    'PhotosTitle',
                    'Title for photo section'
                ),
                SortableUploadField::create(
                    'Photos',
                    'Photos'
                )
            ]
        );
        return $fields;
    }
}

class HomePage_Controller extends Page_Controller
{
    /**
     * Defines the allowed child page types
     * @var array
     */
    private static $allowed_children = [
        'ContactForm'
    ];

    public function getPhotoCategories()
    {
        $config = Config::inst()->get('Image', 'Categories');
        $datalist       =   [];
        foreach ($config as $key => $value) {
            $data       =   ['Key' => $key, 'Value' => $value];
            $datalist[] =   new ArrayData($data);
        }

        return new ArrayList($datalist);
    }

    public function ContactForm()
    {
        return new ContactForm($this);
    }
}
