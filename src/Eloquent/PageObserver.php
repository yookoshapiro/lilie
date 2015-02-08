<?php namespace Lilie\Eloquent;

class PageObserver {

    /**
     * Event on saving a eloquent page object.
     *
     * @param   Page    $page
     */
    public function saving(Page $page)
    {
        $page->extra = collect($page->extra);
    }


    /**
     * Event on creating a eloquent page object.
     *
     * @param   Page    $page
     */
    public function creating(Page $page)
    {
        $page->extra = collect($page->extra);
    }

}