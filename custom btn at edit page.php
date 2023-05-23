<?php

add_action('edit_form_top', 'add_custom_button');

function add_custom_button($id){ //$post->post_type
    echo('asd: <button>Custom button</button>');
}

?>