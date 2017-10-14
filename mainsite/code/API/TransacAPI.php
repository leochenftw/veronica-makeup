<?php
use Ntb\RestAPI\BaseRestController as BaseRestController;
use SaltedHerring\Debugger as Debugger;
/**
 * @file SiteAppController.php
 *
 * Controller to present the data from forms.
 * */
class TransacAPI extends BaseRestController {

    private static $allowed_actions = array (
        'post'			=>	"->isAuthenticated"
    );

    public function isAuthenticated() {
        $request = $this->request;
        if ($transacID = $request->param('ID')) {
            return true;
        }

        return false;
    }

    public function post($request) {
        if ($transacID = $request->param('ID')) {
            if ($transacID = $request->param('ID')) {
                if ($payment = CreditPayment::get()->filter(array('transacID' => $transacID))->first()) {
                    if ($order = Order::get()->filter(array('isOpen' => false, 'MerchantReference' => $payment->MerchantReference))->first()) {
                        $items = $order->OrderItems();
                        $data = array();
                        foreach ($items as $item)
                        {
                            $product = $item->getProduct();
                            $data[] = $product->SKU;
                        }

                        return $data;
                    }
                }

                //return array();
            }
        }

        $response = $this->getResponse();
        $response->setStatusCode(404);
        return $response;
    }
}
