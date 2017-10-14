<?php use SaltedHerring\Debugger as Debugger;

class MemberProfileForm extends Form {

    public function __construct($controller) {
        $member = Member::currentUser();
        $fields = new FieldList();
        $fields->push($email = EmailField::create('Email', 'Email')->setValue($member->Email)->setDescription('<a data-title="My profile | Change email address" href="/member/email-update" class="ajax-routed">Change email address</a>')->performReadonlyTransformation());
        $fields->push($first = TextField::create('FirstName', 'First name')->setValue($member->FirstName));
        $fields->push($last = TextField::create('Surname', 'Surname')->setValue($member->Surname));

        $actions = new FieldList(
            $btnSubmit = FormAction::create('doUpdate','Save changes')
        );

        parent::__construct($controller, 'MemberProfileForm', $fields, $actions);
        $this->setFormMethod('POST', true)
             ->setFormAction(Controller::join_links(BASE_URL, 'member', "MemberProfileForm"));
    }

    private function getCoordinate($attribute)
    {
        if ($member = Member::currentUser()) {
            if ($member->Portrait()->exists()) {
                return $member->Portrait()->$attribute;
            }
        }

        return 0;
    }

    public function doUpdate($data, $form) {
        if (!empty($data['SecurityID']) && $data['SecurityID'] == Session::get('SecurityID')) {

            if ($member = Member::currentUser()) {

                $portrait = $member->Portrait()->exists() ? $member->Portrait() : new Portrait();
                if (!empty($data['Image']['type']['Uploads'][0])) {
                    $form->saveInto($portrait);
                } else {
                    $portrait->ContainerX = (int) $data['ContainerX'];
                    $portrait->ContainerY = (int) $data['ContainerY'];
                    $portrait->ContainerWidth = (int) $data['ContainerWidth'];
                    $portrait->ContainerHeight = (int) $data['ContainerHeight'];
                    $portrait->CropperX = (int) $data['CropperX'];
                    $portrait->CropperY = (int) $data['CropperY'];
                    $portrait->CropperWidth = (int) $data['CropperWidth'];
                    $portrait->CropperHeight = (int) $data['CropperHeight'];
                }
                $portrait->write();

                $form->saveInto($member);
                $member->write();
            }

            return Controller::curr()->redirectBack();
        }

        return Controller::curr()->httpError(400);
    }

    public function getCroppedPortrait()
    {
        if (!Member::CurrentUser()->Portrait()->exists()) {
            return null;
        }

        return Member::CurrentUser()->Portrait()->Image()->exists() ? Member::CurrentUser()->Portrait()->Image()->Cropped() : null;
    }

    public function getPortrait()
    {
        if (!Member::CurrentUser()->Portrait()->exists()) {
            return null;
        }

        return Member::CurrentUser()->Portrait()->Image()->exists() ? Member::CurrentUser()->Portrait()->Image() : null;
    }
}
