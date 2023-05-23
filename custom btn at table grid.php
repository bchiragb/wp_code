<?php
//add_filter('views_edit-post','my_filter_box');
add_filter('views_edit-listing','my_filter_box');

function my_filter_box($views){
    $views['importx'] = '<a href="#" class="primary">Importxx</a>';
    return $views;
}

?>