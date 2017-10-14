<?php

class HomePage extends Page
{

}

class HomePage_Controller extends Page_Controller
{
    public function index($request)
    {
        return $this->renderWith(array('HomePage', 'Page'));
    }

    public function getPhotoSets()
    {
        $sets = PhotoSet::get();
        $pagination = new PaginatedList($sets, $this->request);
        $pagination->setPageLength(13);
        return $pagination;
    }
}
