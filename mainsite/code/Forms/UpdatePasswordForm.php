<?php use SaltedHerring\Debugger as Debugger;

class UpdatePasswordForm extends Form {
	public function __construct($controller) {
		$member = Member::currentUser();
		$fields = new FieldList();
		$fields->push($pass = ConfirmedPasswordField::create('Password', 'New password'));

		$actions = new FieldList(
			$btnSubmit = FormAction::create('doUpdate','Update password')
		);

		parent::__construct($controller, 'UpdatePasswordForm', $fields, $actions);
		$this->setFormMethod('POST', true)
			 ->setFormAction(Controller::join_links(BASE_URL, 'member', "UpdatePasswordForm"));
	}

	public function doUpdate($data, $form) {
		if (!empty($data['SecurityID']) && $data['SecurityID'] == Session::get('SecurityID')) {

			if ($member = Member::currentUser()) {
				$form->saveInto($member);
				$member->write();
			}

			return Controller::curr()->redirectBack();
		}

		return Controller::curr()->httpError(400);

	}
}
