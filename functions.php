<?php
// Enqueue les styles du thème parent et du thème enfant
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    $theme_css_path = get_stylesheet_directory() . '/css/theme.css';
    $theme_css_uri = get_stylesheet_directory_uri() . '/css/theme.css';

    if (file_exists($theme_css_path)) {
        wp_enqueue_style('theme-style', $theme_css_uri, array(), filemtime($theme_css_path));
    } else {
        wp_enqueue_style('theme-style', $theme_css_uri);
    }
}

// Ajoute un lien "Admin" dans le menu pour les utilisateurs connectés
function add_admin_link($items, $args)
{
    if (is_user_logged_in()) {
        $items .= '<li class="menu-item admin"><a href="' . esc_url(get_admin_url()) . '">Admin</a></li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_admin_link', 10, 2);
