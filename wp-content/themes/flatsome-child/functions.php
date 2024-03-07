<?php
// Add custom Theme Functions here
// 
// 
// hiển thị thông tin sidebar ở trang sp
//Khởi tạo function cho shortcode


function tabParameter(){
    echo get_field('parameter_product');
}

add_shortcode('content_tab_parameter_product', 'tabParameter');

// add_action( 'woocommerce_product_options_general_product_data', 'add_custom_editor_to_existing_field' );

// function add_custom_editor_to_existing_field() {
//     global $post;
//     echo '<pre>';
//         print_r(get_post_meta($post->ID, '_custom_tab'), true);
//     echo '</pre>';
//     // Thêm trình soạn thảo vào trường văn bản có sẵn
//     wp_editor( get_post_meta( $post->ID, '_custom_tab', true ), '_custom_tab');
// }

function add_form_contact_product_page(){
    echo do_shortcode('[contact-form-7 id="7af2d91" title="contact form"]');
}


add_action('woocommerce_single_product_summary', 'add_form_contact_product_page', 40);

function add_short_desciption_in_loop() {
    
	global $product;
    
    $short_description = $product->get_short_description();
    
    if ( ! empty( $short_description ) ) {
        echo '<p class="p-loop-short-desc">' . $short_description . '</p>';
    }

    echo do_shortcode('[button class="product-readmore" text="'.translate('Xem thêm', 'flatsome').'" size="small" link="'.$product->get_permalink().'"]');
}
add_action( 'woocommerce_shop_loop_item_title', 'add_short_desciption_in_loop', 20 );


function themeprefix_enqueue_custom_script() {
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'themeprefix_enqueue_custom_script' );

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});