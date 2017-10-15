<?php
use Ntb\RestAPI\BaseRestController;
use SaltedHerring\Debugger;
/**
 * @file SiteAppController.php
 *
 * Controller to present the data from forms.
 * */
class PhotoAPI extends BaseRestController
{

    private static $allowed_actions = [
        'get'           => "->isAuthenticated"
    ];

    public function isAuthenticated()
    {
        if ($this->request->isAjax()) {
            return true;
        }

        return array('list' => array(), 'count' => 0, 'pagination' => array('message' => 'for some reason, your request didn\'t get through'));
    }

    public function get($request)
    {
        if ($home = HomePage::get()->first()) {
            $photos     =   $home->Photos();
            return $this->Paginate($photos);
        }

        return array('list' => array(), 'count' => 0, 'pagination' => array('message' => 'for some reason, your request didn\'t get through'));
    }

    private function Paginate($articles)
    {
        $artcile_count                  =   $articles->count();

        if (empty($artcile_count)) {
            return array('list' => array(), 'count' => 0, 'pagination' => array('message' => 'no photo'));
        }

        $articles                       =   $articles->sort('SortOrder ASC');

        $start                          =   $this->request->getVar('start');

        if ($artcile_count > $this->pageSize) {
            $paged                      =   new PaginatedList($articles, $this->request);

            $paged->setPageLength($this->pageSize);

            $articles                   =   $paged;
            $list                       =   $articles->getIterator();
            $data                       =   [];

            foreach ($list as $item) {
                $data[]                 =   [
                                                'thumb' =>  $item->setWidth(320)->URL,
                                                'full'  =>  $item->URL
                                            ]
            }

            if ($paged->MoreThanOnePage()) {
                if ($paged->NotLastPage()) {

                    $pagination         =   $this->sanitisePagination($paged->NextLink());
                    return  array(
                        'list'          =>  $data,
                        'count'         =>  $artcile_count,
                        'pagination'    =>  array('href' => $pagination)
                    );
                }

                return  array(
                    'list'              =>  $data,
                    'count'             =>  $artcile_count,
                    'pagination'        =>  array('message' => null)
                );
            }
        }

        // Debugger::inspect($articles->count());

        $data                           =   $articles->json();

        return array(
            'list'                      =>  $data,
            'count'                     =>  count($data),
            'pagination'                =>  array('message' => null)
        );
    }

    private function sanitisePagination($pagination)
    {
        $pagination                     =   str_replace('&amp;', '&', $pagination);
        $parts                          =   parse_url($pagination);

        parse_str($parts['query'], $query);

        return $pagination;
    }
}
