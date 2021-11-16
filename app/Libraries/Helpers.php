<?php

use App\Models\Category;

class Helpers
{
  public static function getListMenuCategory()
  {
    return Category::getParentCategories();
  }
}
