<?php
/**
 * Implements theme_links() targeting the main menu specifically
 * Outputs Foundation Nav bar
 *
 */

function zurpal_js_alter(&$javascript)
{
// Swap out jQuery to use an updated version of the library.
    $javascript['misc/jquery.js']['data'] = drupal_get_path('theme', 'zurpal') . '/javascripts/foundation/jquery.js';
    $javascript['misc/jquery.js']['version'] = '1.9.0';
    //drupal_static_reset('drupal_add_js');
}

function zurpal_css_alter(&$css)
{

    if (isset($css['modules/system/system.menus.css'])) {
        unset($css['modules/system/system.menus.css']);
    }
}

function zurpal_preprocess_page(&$variables)
{

    //$migrate_jquery_path = drupal_get_path('theme', 'zurpal') .'/javascripts/foundation/jquery-migrate-1.2.1.js';
    //drupal_add_js($migrate_jquery_path,array('scope'=>'header','weight'=>-20));

    $app_path = drupal_get_path('theme', 'zurpal') . '/javascripts/foundation/app.js';
    $topbar_path = drupal_get_path('theme', 'zurpal') . '/javascripts/foundation/jquery.foundation.topbar.js';
    $options = array(
        'type'  => 'file',
        'scope' => 'footer',
    );
    drupal_add_js($topbar_path, $options);
    drupal_add_js($app_path, $options);
    drupal_add_js('jQuery(document).ready(function () { jQuery.noConflict(); });', 'inline');
}

/*
function zurpal_links__system_main_menu($vars) {
    // Get all the main menu links
    $menu_links = menu_tree_output(menu_tree_all_data('main-menu'));

    // Initialize some variables to prevent errors
    $output = '';
    $sub_menu = '';

    foreach ($menu_links as $key => $link) {
        // Add special class needed for Foundation dropdown menu to work
        !empty($link['#below']) ? $link['#attributes']['class'][] = 'has-flyout' : '';

        // Render top level and make sure we have an actual link
        if (!empty($link['#href'])) {
            $output .= '<li' . drupal_attributes($link['#attributes']) . '>' . l($link['#title'], $link['#href']);
            // Get sub navigation links if they exist
            foreach ($link['#below'] as $key => $sub_link) {
                if (!empty($sub_link['#href'])) {
                    $sub_menu .= '<li>' . l($sub_link['#title'], $sub_link['#href']) . '</li>';
                }

            }
            $output .= !empty($link['#below']) ? '<a href="#" class="flyout-toggle"><span> </span></a><ul class="flyout">' . $sub_menu . '</ul>' : '';

            // Reset dropdown to prevent duplicates
            unset($sub_menu);
            $sub_menu = '';

            $output .=  '</li>';
        }
    }
    return '<ul class="nav-bar">' . $output . '</ul>';
}*/
function zurpal_links__system_main_menu($vars)
{
    // Get all the main menu links
    $menu_links = menu_tree_output(menu_tree_all_data('main-menu'));

    // Initialize some variables to prevent errors
    $output = '';
    $sub_menu = '';

    foreach ($menu_links as $key => $link) {
        // Add special class needed for Foundation dropdown menu to work
        !empty($link['#below']) ? $link['#attributes']['class'][] = 'has-dropdown' : '';

        // Render top level and make sure we have an actual link
        if (!empty($link['#href'])) {
            $output .= '<li' . drupal_attributes($link['#attributes']) . '>' . l($link['#title'], $link['#href']);
            // Get sub navigation links if they exist
            foreach ($link['#below'] as $key => $sub_link) {
                if (!empty($sub_link['#href'])) {
                    $sub_menu .= '<li>' . l($sub_link['#title'], $sub_link['#href']) . '</li>';
                }

            }
            $output .= !empty($link['#below']) ? '<ul class="dropdown">' . $sub_menu . '</ul>' : '';

            // Reset dropdown to prevent duplicates
            unset($sub_menu);
            $sub_menu = '';

            $output .= '</li>';
        }
    }
    return $output;
}

function links__system_secondary_menu($vars){
    // Get all the main menu links
    $menu_links = menu_tree_output(menu_tree_all_data('main-menu'));

    // Initialize some variables to prevent errors
    $output = '';
    $sub_menu = '';

    foreach ($menu_links as $key => $link) {
        // Add special class needed for Foundation dropdown menu to work
        !empty($link['#below']) ? $link['#attributes']['class'][] = 'has-dropdown' : '';

        // Render top level and make sure we have an actual link
        if (!empty($link['#href'])) {
            $output .= '<li' . drupal_attributes($link['#attributes']) . '>' . l($link['#title'], $link['#href']);
            // Get sub navigation links if they exist
            foreach ($link['#below'] as $key => $sub_link) {
                if (!empty($sub_link['#href'])) {
                    $sub_menu .= '<li>' . l($sub_link['#title'], $sub_link['#href']) . '</li>';
                }

            }
            $output .= !empty($link['#below']) ? '<ul class="dropdown">' . $sub_menu . '</ul>' : '';

            // Reset dropdown to prevent duplicates
            unset($sub_menu);
            $sub_menu = '';

            $output .= '</li>';
        }
    }
    return $output;
}


function zurpal_breadcrumb($variables)
{
    $output = null;
    $output .= "<div id=\"breadcrumb-container\">";
        $output .= "<ul class=\"breadcrumbs\">";
        if (count($variables['breadcrumb']) > 0) {
            foreach ($variables['breadcrumb'] as $breadcrumb) {
                $output .= '<li>' . $breadcrumb . '</li>';
            }
        } else {
            $output .= '<li>' . t("Home") . '</li>';
        }
        $output .= "</ul>";
    $output .= "</div>";
    return $output;
}

?>