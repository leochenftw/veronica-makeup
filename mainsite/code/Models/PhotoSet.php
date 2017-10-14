<?php
use SaltedHerring\Debugger;
use Cocur\Slugify\Slugify;

class PhotoSet extends DataObject
{
    /**
     * Database fields
     * @var array
     */
    private static $db = array(
        'Title'             =>  'Varchar(256)',
        'SKU'               =>  'Varchar(32)',
        'Content'           =>  'HTMLText',
        'FolderName'        =>  'Varchar(32)',
        'BaseCost'          =>  'Decimal',
        'DownloadPass'      =>  'Varchar(64)',
        'ExtractPass'       =>  'Varchar(64)'
    );

    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = array(
        'SetCover'          =>  'Image',
        'SetFolder'         =>  'Folder',
        'DownloadLink'      =>  'Link'
    );

    /**
     * Has_many relationship
     * @var array
     */
    private static $has_many = array(
        'Photos'            =>  'Photo'
    );

    /**
     * Many_many relationship
     * @var array
     */
    private static $many_many = array(
        'Tags'              =>  'Tag'
    );

    /**
     * Defines summary fields commonly used in table columns
     * as a quick overview of the data for this dataobject
     * @var array
     */
    private static $summary_fields = array(
        'Title'             =>  'Set name',
        'SKU'               =>  'SKU',
        'getCost'           =>  'Cost'
    );

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('SetFolder');
        $fields->removeByName('DownloadLinkID');
        $fields->removeByName('Tags');
        $uploadfield = $fields->fieldByName('Root.Main.SetCover');
        $uploadfield->setCanUpload(false);
        if ($this->SetFolder()->exists()) {
            $fields->fieldByName('Root.Main.FolderName')->setDescription($this->SetFolder()->getRelativePath());
            $uploadfield->setFolderName($this->SetFolder()->getRelativePath());
        }

        $fields->addFieldsToTab(
            'Root.Downloads',
            array(
                TextField::create(
                    'BaseCost',
                    'Cost'
                ),
                LinkField::create('DownloadLinkID', 'Link to page or file'),
                TextField::create(
                    'DownloadPass',
                    'Any passcode when entering the download page?'
                ),
                TextField::create(
                    'ExtractPass',
                    'Any passcode when extracting the file archive?'
                )
            )
        );

        $fields->addFieldToTab(
            'Root.Main',
            TagField::create(
                'Tags',
                'Tags',
                Tag::get(),
                $this->Tags()
            )->setShouldLazyLoad(true)->setCanCreate(true)
        );


        return $fields;
    }
    /**
     * Event handler called before writing to the database.
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        if (!empty($this->FolderName) && !$this->SetFolder()->exists()) {
            $slugify = new Slugify();
            $foldername = $slugify->slugify($this->FolderName);
            $shelter = sha1(mt_rand() . mt_rand() . time());
            $folder = Folder::find_or_make($shelter . '/' . $foldername);
            $this->SetFolderID = $folder->ID;
        }
    }

    /**
     * Event handler called after writing to the database.
     */
    public function onAfterWrite()
    {
        parent::onAfterWrite();
        if ($this->SetFolder()->exists()) {

            // if ($this->Photos()->count() > 0) {
            //     $photos = $this->Photos();
            //     foreach ($photos as $photo)
            //     {
            //         $photo->delete();
            //     }
            // }

            if (!$this->Photos()->exists()) {

                $this->SetFolder()->syncChildren();
                $children = $this->SetFolder()->myChildren()->filter(array('ClassName' => 'Image'));
                if ($children->count() > 0) {
                    foreach ($children as $child)
                    {
                        $photoItem = new Photo();
                        $photoItem->ImageID = $child->ID;
                        $photoItem->write();
                        $this->Photos()->add($photoItem->ID);
                    }
                }
            }
        }
    }

    public function SmartCover($aspect = null)
    {
        if (!$this->Photos()->exists()) {
            return null;
        }

        if ($aspect == 'landscape') {
            return $this->firstLandscape();
        } elseif ($aspect == 'portrait') {
            return $this->firstPortrait();
        }

        return null;
    }

    private function firstLandscape()
    {
        $photos = $this->Photos();
        foreach ($photos as $photo)
        {
            if ($photo->Image()->Width >= $photo->Image()->Height) {
                return $photo->Image()->setWidth(820);
            }
        }

        return null;
    }

    private function firstPortrait()
    {
        $photos = $this->Photos();
        foreach ($photos as $photo)
        {
            if ($photo->Image()->Width < $photo->Image()->Height) {
                return $photo->Image()->setWidth(420);
            }
        }

        return null;
    }

    public function getCover()
    {
        $cover = null;
        if ($this->SetCover()->exists()) {
            $cover = $this->SetCover();
        } else {
            $cover = $this->Photos()->first();
        }

        if (!empty($cover)) {
            $width = $cover->Width;
            $height = $cover->Height;
            if ($width >= $height) { //if it's landscape or square
                return $cover->Image()->setWidth(810);
            }

            return $cover->Image()->setWidth(410);
        }

        return $cover;
    }

    public function getCost()
    {
        $cost = $this->BaseCost;
        return number_format($cost, 0, '.', ',');
    }

    public function PageHero()
    {
        return $this->SmartCover('landscape');
    }

    public function Link()
    {
        return '/photosets/' . $this->SKU;
    }

    public function getBodyClass()
    {
        return $this->ClassName;
    }

    public function Purchased()
    {
        if ($member = Member::currentUser()) {
            return $member->Purchased()->byID($this->ID);
        }
        return false;
    }

    public function isCarted()
    {
        if ($cart = Order::getOpencart()) {
            $finder = $cart->OrderItems()->filter(array('PaidToClassID' => $this->ID));
            return $finder->count() > 0;
        }

        return false;
    }
}
