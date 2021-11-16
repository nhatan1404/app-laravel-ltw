<?php

use App\Models\Category;

class Helpers
{

  public static function getHeaderCategory()
  {
    $categories = Category::getParentCategories();
?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Danh Mục</a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <?php
        foreach ($categories as $parent) {
          if (count($parent->children) == 0) {
        ?>
            <li><a class="dropdown-item" href=""><?php echo $parent->title ?></a></li>
          <?php
          } else {
          ?>
            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-toggle" href="<?php echo route('product-by-category', $parent->slug) ?>"><?php echo $parent->title ?></a>
              <ul class="dropdown-menu">
                <?php
                foreach ($parent->children as $child) {
                ?>
                  <li><a class="dropdown-item" href="<?php echo route('product-by-category', $child->slug) ?>"><?php echo $child->title ?></a></li>

                <?php
                }
                ?>
              </ul>
            </li>
        <?php
          }
        }
        ?>
      </ul>
    </li>
<?php
  }
}
