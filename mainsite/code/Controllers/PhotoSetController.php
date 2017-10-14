<?php

class PhotoSetController extends Page_Controller
{
    /**
     * Defines methods that can be called directly
     * @var array
     */
    private static $allowed_actions = array(
        'PurchaseForm' => true
    );

    public function index($request)
    {
        if ($sku = $request->param('sku')) {
            $photoset = PhotoSet::get()->filter(array('SKU' => $sku))->first();

            return $this->customise($photoset)->renderWith(array('PhotoSet','Page'));
        }

        return $this->redirect('/');
    }

    public function PurchaseForm()
    {
        return new PurchaseForm($this);
    }


    public function Link($action = NULL)
    {
        $request = $this->request;
        if ($sku = $request->param('sku')) {
            return '/photosets/' . $sku;
        }

        return '/photosets';
    }
}
