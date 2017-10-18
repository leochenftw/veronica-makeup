<?php
use SaltedHerring\SaltedCache;
class GalleryItem extends DataObject
{
    private static $default_sort = 'SortOrder ASC';

    private static $db = [
        'SortOrder'     =>  'Int',
        'Category'      =>  'Varchar(1024)'
    ];

    /**
     * Defines summary fields commonly used in table columns
     * as a quick overview of the data for this dataobject
     * @var array
     */
    private static $summary_fields = [
        'SortOrder'     =>  'Sort',
        'Category'      =>  'Category',
        'getMiniThumb'  =>  'Thumbnail'
    ];

    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'Image'         =>  'Image',
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName([
            'SortOrder'
        ]);
        $fields->addFieldToTab(
            'Root.Main',
            CheckboxSetField::create(
                'Category',
                'Category',
                $this->config()->Categories
            )
        );

        return $fields;
    }

    /**
     * Belongs_many_many relationship
     * @var array
     */
    private static $belongs_many_many = [
        'Home'     =>  'HomePage'
    ];

    public function getMiniThumb()
    {
        return $this->Image()->exists() ? $this->Image()->FillMax(100,100) : null;
    }

    /**
     * Event handler called before deleting from the database.
     */
    public function onBeforeDelete()
    {
        parent::onBeforeDelete();
        if (!empty($this->ImageID)) {
            if (file_exists($this->Image()->getFullPath())) {
                $this->Image()->delete();
            }
        }
    }

    public function getCached()
    {
        if (empty($this->ImageID)) {
            return [];
        }

        $factory                    =   $this->ClassName;
        $key                        =   $this->ID . '_' . strtotime($this->LastEdited);

        $data                       =   SaltedCache::read($factory, $key);

        if (empty($data)) {
            $resized                    =   $this->Image()->setWidth(460);
            $data                       =   [
                                                'title'     =>  $this->Image()->Title,
                                                'thumb'     =>  $resized->URL,
                                                'width'     =>  $resized->Width,
                                                'height'    =>  $resized->Height,
                                                'full'      =>  $this->Image()->URL,
                                                'category'  =>  str_replace(',', ' ', $this->Category)
                                            ];
            SaltedCache::save($factory, $key, $data);
        }

        return $data;
    }

}
