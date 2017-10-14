<?php use SaltedHerring\Debugger as Debugger;

class PaymentForm extends Form {
	public function __construct($controller) {
        $fields = new FieldList();
		$actions = new FieldList(
			$btnSubmit = FormAction::create('doPayment','Pay')
		);

		parent::__construct($controller, 'PaymentForm', $fields, $actions);
		$this->setFormMethod('POST', true)
			 ->setFormAction(Controller::join_links(BASE_URL, $controller->Link(), "PaymentForm"));
	}

	public function doPayment($data, $form) {

		if (!empty($data['SecurityID']) && $data['SecurityID'] == Session::get('SecurityID')) {
            $order = Order::getCurrentCart();
            $member = Member::currentUser();
            if ($order->Pay('Credit')) {
                $member->Credit -= $order->Amount->Amount;
                $member->write();
                $orderItems = $order->OrderItems();
                foreach ($orderItems as $orderItem)
                {
                    $member->Purchased()->add($orderItem->PaidToClassID);
                }
            } else {
                $this->sessionMessage('You do not have enough credit.', 'bad');
            }

            return $this->controller->redirect('/member/action/history');
		}

		return Controller::curr()->httpError(400);

	}
}
