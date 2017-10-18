<?php
class CustomSiteConfig extends DataExtension {

    public static $db = [
        'GoogleSiteVerificationCode'    =>  'Varchar(128)',
        'GoogleAnalyticsCode'           =>  'Varchar(20)',
        'SiteVersion'                   =>  'Varchar(10)',
        'GoogleCustomCode'              =>  'HTMLText'
    ];

    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'Logo'                          =>  'Image'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab("Root.Google", new TextField('GoogleSiteVerificationCode', 'Google Site Verification Code'));
        $fields->addFieldToTab("Root.Google", new TextField('GoogleAnalyticsCode', 'Google Analytics Code'));
        $fields->addFieldToTab("Root.Google", new TextareaField('GoogleCustomCode', 'Custom Google Code'));

        $fields->addFieldToTab('Root.Main', new TextField('SiteVersion', 'Site Version'));
        $fields->addFieldToTab(
            'Root.Main',
            UploadField::create(
                'Logo',
                'Logo'
            ),
            'Title'
        );
    }

}
