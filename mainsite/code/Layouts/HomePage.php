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
        'PhotosTitle'       =>  'Varchar(128)',
        'AboutUs'           =>  'HTMLText',
        'ContactTitle'      =>  'Varchar(128)',
        'ContactContent'    =>  'HTMLText'
    ];
    /**
     * Many_many relationship
     * @var array
     */
    private static $many_many = [
        'Photos'            =>  'GalleryItem'
    ];

    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'ContactImage'      =>  'Image'
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
                Grid::make('Photos', 'Photos', $this->Photos(), true, 'GridFieldConfig_RelationEditor')
            ]
        );

        $fields->addFieldsToTab(
            'Root.ContactForm',
            [
                TextField::create(
                    'ContactTitle',
                    'Title'
                ),
                HtmlEditorField::create(
                    'ContactContent',
                    'Content'
                ),
                SaltedUploader::create('ContactImage', 'Image')->setCropperRatio(33/41)
            ]
        );

        return $fields;
    }
}

class HomePage_Controller extends Page_Controller
{
    /**
     * Defines methods that can be called directly
     * @var array
     */
    private static $allowed_actions = [
        'ContactForm' => true
    ];

    public function getPhotoCategories()
    {
        $config = Config::inst()->get('GalleryItem', 'Categories');
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
