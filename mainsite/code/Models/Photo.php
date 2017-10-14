<?php
use SaltedHerring\Debugger;

class Photo extends DataObject
{
    /**
     * Database fields
     * @var array
     */
    private static $db = array(
        'Title'     =>  'Varchar(256)'
    );
    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = array(
        'Image'     =>  'Image',
        'PhotoSet'  =>  'PhotoSet'
    );

    /**
     * Defines summary fields commonly used in table columns
     * as a quick overview of the data for this dataobject
     * @var array
     */
    private static $summary_fields = array(
        'getThumbnail' => 'Thumbnail'
    );

    public function getThumbnail()
    {
        return $this->Image()->exists() ? $this->Image()->fillMax(150, 150) : null;
    }

    /**
     * Event handler called before writing to the database.
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        if ($this->Image()->exists()) {
            $this->Title = $this->Image()->Title;
        }
    }

    public function getPicture()
    {
        if ($this->Image()->exists()) {
            $width = $this->Image()->Width;
            $height = $this->Image()->Height;
            if ($width >= $height) //if it's landscape or square
            {
                return $this->Image()->setWidth(810);
            }

            return $this->Image()->setWidth(410);
        }

        return null;
    }
}
