<?php


class VHNMenu {
    public static function showSelectCat($categories,$id) {
        foreach ($categories as $category) {
           self::perSelectCat($category,$id);
        }
    }
    protected static function perSelectCat($category,$id,$char = '') {
        $selected = $category->id == $id ? 'selected' : '';
        echo '<option value="'.$category->id.'" '.$selected.'>';
            echo $char . $category->name;
        echo '</option>';
        if ($category->children) {
            foreach ($category->children as $subcategory) {
                self::perSelectCat($subcategory,$id,$char.'|---');
            }
        }
    }
}
