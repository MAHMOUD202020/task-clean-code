<?php

namespace App\Traits;


trait Pagination
{

    private function page(){

        $page_number = \request('page', 0);

        if ($page_number == 0 || $page_number == 1)
            return 0;
        else
            return ($page_number * $this->limit) - $this->limit;
    }

    private function isLastPage($query){

        $number_items_show = $query->offset(0)->limit($this->limit)->count() - $this->page();

        return ($number_items_show > $this->limit) ? false : true;
    }

}
