<?php use SaltedHerring\Debugger as Debugger;

class PurchaseForm extends Form {
    public function __construct($controller) {
        $fields = new FieldList();
        $actions = new FieldList(
            $btnSubmit = FormAction::create('addToCart','Add to Cart')
        );

        $btnSubmit->addExtraClass('button is-outlined is-transparent');

        parent::__construct($controller, 'PurchaseForm', $fields, $actions);
        $this->setFormMethod('POST', true)
             ->setFormAction(Controller::join_links(BASE_URL, $controller->Link(), "PurchaseForm"));
    }

    public function addToCart($data, $form) {
        if (!empty($data['SecurityID']) && $data['SecurityID'] == Session::get('SecurityID') && $this->controller->request->param('sku')) {
            $sku = $this->controller->request->param('sku');

            if ($photoset = PhotoSet::get()->filter(array('SKU' => $sku))->first()) {

                if ($member = Member::currentUser()) {
                    $order = Order::getCurrentCart();
                    $checkDuplicate = $order->OrderItems()->filter(array('PaidToClassID' => $photoset->ID))->first();

                    if (empty($checkDuplicate)) {
                        $item = new OrderItem();
                        $item->PaidToClass = $photoset->ClassName;
                        $item->PaidToClassID = $photoset->ID;
                        $item->OrderID = $order->ID;
                        $item->write();
                    }

                    $order->write();

                    return Controller::curr()->redirectBack();
                }

                return $this->httpError(403, 'Please sign in first');

            }

            return $this->httpError(404);

        }

        return Controller::curr()->httpError(400);

    }
}
