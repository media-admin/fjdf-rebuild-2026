<?php
/**
 * Custom Post Types
 * 
 * Register all custom post types for the agency core functionality.
 * These CPTs persist across theme changes.
 * 
 * @package Agency_Core
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Team CPT
 */
function fjdf_register_team_cpt() {
    $labels = array(
        'name' => __('Team', 'fjdf'),
        'singular_name' => __('Team Mitglied', 'fjdf'),
        'menu_name' => __('Team', 'fjdf'),
        'add_new' => __('Neu hinzufügen', 'fjdf'),
        'add_new_item' => __('Neues Team Mitglied', 'fjdf'),
        'edit_item' => __('Team Mitglied bearbeiten', 'fjdf'),
        'new_item' => __('New Team Member', 'fjdf'),
        'view_item' => __('View Team Member', 'fjdf'),
        'search_items' => __('Search Team', 'fjdf'),
        'not_found' => __('No team members found', 'fjdf'),
        'not_found_in_trash' => __('No team members found in trash', 'fjdf'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon' => 'dashicons-groups',
        'menu_position' => 20,
        'rewrite' => array('slug' => 'team'),
        'capability_type' => 'post',
    );
    
    register_post_type('team', $args);
}
add_action('init', 'fjdf_register_team_cpt');


/**
 * Register Projects CPT
 */
function fjdf_register_projects_cpt() {
    $labels = array(
        'name' => __('Projekte', 'fjdf'),
        'singular_name' => __('Projekt', 'fjdf'),
        'menu_name' => __('Projekte', 'fjdf'),
        'add_new' => __('Neu hinzufügen', 'fjdf'),
        'add_new_item' => __('Neues Projekt', 'fjdf'),
        'edit_item' => __('Projekt bearbeiten', 'fjdf'),
        'new_item' => __('New Project', 'fjdf'),
        'view_item' => __('Projekt ansehen', 'fjdf'),
        'search_items' => __('Projekte suchen', 'fjdf'),
        'not_found' => __('Keine Projekte gefunden', 'fjdf'),
        'not_found_in_trash' => __('Keine Projekte im Papierkorb gefunden', 'fjdf'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon' => 'dashicons-portfolio',
        'menu_position' => 21,
        'rewrite' => array('slug' => 'projekte'),
        'capability_type' => 'post',
        'taxonomies' => array('project_category'),
    );
    
    register_post_type('project', $args);
}
add_action('init', 'fjdf_register_projects_cpt');


/**
 * Register Project Categories
 */
function fjdf_register_project_categories() {
    $labels = array(
        'name' => __('Projekt Kategorien', 'fjdf'),
        'singular_name' => __('Projekt Kategorie', 'fjdf'),
        'search_items' => __('Kategorien durchsuchen', 'fjdf'),
        'all_items' => __('Alle Kategorien', 'fjdf'),
        'parent_item' => __('Übergeordnete Kategorie', 'fjdf'),
        'parent_item_colon' => __('Übergeordnete Kategorie:', 'fjdf'),
        'edit_item' => __('Kategorie bearbeiten', 'fjdf'),
        'update_item' => __('Kategorie aktualisieren', 'fjdf'),
        'add_new_item' => __('Neue Kategorie hinzufügen', 'fjdf'),
        'new_item_name' => __('Neuer Kategorie-Name', 'fjdf'),
        'menu_name' => __('Projekt Kategorien', 'fjdf'),
    );
    
    register_taxonomy('project_category', array('project'), array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'projekt-kategorie'),
    ));
}
add_action('init', 'fjdf_register_project_categories');


/**
 * Register Testimonials CPT
 */
function fjdf_register_testimonials_cpt() {
    $labels = array(
        'name' => __('Testimonials', 'fjdf'),
        'singular_name' => __('Testimonial', 'fjdf'),
        'menu_name' => __('Testimonials', 'fjdf'),
        'add_new' => __('Neu hinzufügen', 'fjdf'),
        'add_new_item' => __('Neues Testimonial', 'fjdf'),
        'edit_item' => __('Testimonial bearbeiten', 'fjdf'),
        'new_item' => __('Neues Testimonial', 'fjdf'),
        'view_item' => __('Testimonial', 'fjdf'),
        'search_items' => __('Testimonials durchsuchen', 'fjdf'),
        'not_found' => __('Keine Testimonials gefunden', 'fjdf'),
        'not_found_in_trash' => __('Keine Testimonials im Papierkorb gefunden', 'fjdf'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'menu_icon' => 'dashicons-testimonial',
        'menu_position' => 22,
        'rewrite' => array('slug' => 'testimonials'),
        'capability_type' => 'post',
    );
    
    register_post_type('testimonial', $args);
}
add_action('init', 'fjdf_register_testimonials_cpt');


/**
 * Register Services CPT
 */
function fjdf_register_services_cpt() {
    $labels = array(
        'name' => __('Leistungen', 'fjdf'),
        'singular_name' => __('Leistung', 'fjdf'),
        'menu_name' => __('Leistungen', 'fjdf'),
        'add_new' => __('Neu hinzufügen', 'fjdf'),
        'add_new_item' => __('Neue Leistung', 'fjdf'),
        'edit_item' => __('Leistung bearbeiten', 'fjdf'),
        'new_item' => __('Neue Leistung', 'fjdf'),
        'view_item' => __('Leistung anzeigen', 'fjdf'),
        'search_items' => __('Leistungen durchsuchen', 'fjdf'),
        'not_found' => __('Keine Leistungen gefunden', 'fjdf'),
        'not_found_in_trash' => __('Keine Leistungen im Papierkorb gefunden', 'fjdf'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon' => 'dashicons-admin-tools',
        'menu_position' => 23,
        'rewrite' => array('slug' => 'leistungen'),
        'capability_type' => 'post',
    );
    
    register_post_type('service', $args);
}
add_action('init', 'fjdf_register_services_cpt');


/**
 * Register Services Categories
 */
function fjdf_register_service_categories() {
    $labels = array(
        'name' => __('Leistungs-Kategorien', 'fjdf'),
        'singular_name' => __('Leistungs-Kategorie', 'fjdf'),
        'search_items' => __('Kategorien durchsuchen', 'fjdf'),
        'all_items' => __('Alle Kategorien', 'fjdf'),
        'parent_item' => __('Übergeordnete Kategorie', 'fjdf'),
        'parent_item_colon' => __('Übergeordnete Kategorie:', 'fjdf'),
        'edit_item' => __('Kategorie bearbeiten', 'fjdf'),
        'update_item' => __('Kategorie aktualisieren', 'fjdf'),
        'add_new_item' => __('Neue Kategorie hinzufügen', 'fjdf'),
        'new_item_name' => __('Neuer Kategorie-Name', 'fjdf'),
        'menu_name' => __('Service Kategorien', 'fjdf'),
    );
    
    register_taxonomy('service_category', array('service'), array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'leistungs-kategorie'),
    ));
}
add_action('init', 'fjdf_register_service_categories');


/**
 * Register FAQ CPT
 */
function fjdf_register_faq_cpt() {
    $labels = array(
        'name' => __('FAQ', 'fjdf'),
        'singular_name' => __('Frage', 'fjdf'),
        'menu_name' => __('Fragen', 'fjdf'),
        'add_new' => __('Neu hinzufügen', 'fjdf'),
        'add_new_item' => __('Neue Frage', 'fjdf'),
        'edit_item' => __('Frage bearbeiten', 'fjdf'),
        'new_item' => __('Neue Frage', 'fjdf'),
        'view_item' => __('Frage anzeigen', 'fjdf'),
        'search_items' => __('Fragen durchsuchen', 'fjdf'),
        'not_found' => __('Keine Fragen gefunden', 'fjdf'),
        'not_found_in_trash' => __('Keine Fragen im Papierkorb gefunden', 'fjdf'),
    );
    
    $args = array(
        'labels' => $labels,
        'description' => __('Frequently Asked Questions', 'fjdf'),
        'hierarchical' => false,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 24,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'page-attributes'),
        'menu_icon' => 'dashicons-editor-help',
        'rewrite' => array('slug' => 'faq'),
    );
    
    register_post_type('faq', $args);
}
add_action('init', 'fjdf_register_faq_cpt');


/**
 * Register FAQ Category Taxonomy
 */
function fjdf_register_faq_category_taxonomy() {
    $labels = array(
        'name' => _x('FAQ Kategorien', 'taxonomy general name', 'fjdf'),
        'singular_name' => _x('FAQ Kategorie', 'taxonomy singular name', 'fjdf'),
        'search_items' => __('FAQ Kategorien durchsuchen', 'fjdf'),
        'all_items' => __('Alle FAQ Kategorien', 'fjdf'),
        'parent_item' => __('Übergeordnete FAQ Kategorie', 'fjdf'),
        'parent_item_colon' => __('Übergeordnete FAQ Kategorie:', 'fjdf'),
        'edit_item' => __('FAQ Kategorie bearbeiten', 'fjdf'),
        'update_item' => __('FAQ Kategorie updaten', 'fjdf'),
        'add_new_item' => __('FAQ Kategorie hinzufügen', 'fjdf'),
        'new_item_name' => __('Neuer FAQ Kategorie Name', 'fjdf'),
        'menu_name' => __('FAQ Kategorien', 'fjdf'),
    );
    
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => false,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => false,
        'show_tagcloud' => false,
        'show_in_rest' => true,
    );
    
    register_taxonomy('faq_category', array('faq'), $args);
}
add_action('init', 'fjdf_register_faq_category_taxonomy');


/**
 * Register Google Maps Post Type
 */
function fjdf_register_maps_cpt() {
    $labels = array(
        'name' => _x('Maps', 'Post Type General Name', 'fjdf'),
        'singular_name' => _x('Map', 'Post Type Singular Name', 'fjdf'),
        'menu_name' => __('Google Maps', 'fjdf'),
        'name_admin_bar' => __('Map', 'fjdf'),
        'all_items' => __('Alle Maps', 'fjdf'),
        'add_new_item' => __('Neue Map hinzufügen', 'fjdf'),
        'add_new' => __('Neue hinzufügen', 'fjdf'),
        'new_item' => __('Neue Map', 'fjdf'),
        'edit_item' => __('Map bearbeiten', 'fjdf'),
        'update_item' => __('Map updaten', 'fjdf'),
        'view_item' => __('Map anzeigen', 'fjdf'),
        'search_items' => __('Map suchen', 'fjdf'),
        'not_found' => __('Nichts gefunden', 'fjdf'),
        'not_found_in_trash' => __('Nichts im Papierkorb gefunden', 'fjdf'),
    );
    
    $args = array(
        'label' => __('Google Map', 'fjdf'),
        'description' => __('Google Maps Locations', 'fjdf'),
        'labels' => $labels,
        'supports' => array('title'),
        'hierarchical' => false,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-location-alt',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'capability_type' => 'post',
        'show_in_rest' => true,
    );
    
    register_post_type('gmap', $args);
}
add_action('init', 'fjdf_register_maps_cpt');


/**
 * Register Hero Slide Post Type
 */
function fjdf_register_hero_slide_cpt() {
    $labels = array(
        'name' => _x('Hero Slides', 'Post Type General Name', 'fjdf'),
        'singular_name' => _x('Hero Slide', 'Post Type Singular Name', 'fjdf'),
        'menu_name' => __('Hero Slides', 'fjdf'),
        'name_admin_bar' => __('Hero Slide', 'fjdf'),
        'archives' => __('Hero Slide Archive', 'fjdf'),
        'attributes' => __('Hero Slide Attribute', 'fjdf'),
        'parent_item_colon' => __('Übergeordnete Hero Slide:', 'fjdf'),
        'all_items' => __('Alle Hero Slides', 'fjdf'),
        'add_new_item' => __('Neue Hero Slide hinzufügen', 'fjdf'),
        'add_new' => __('Neue Hero Slide', 'fjdf'),
        'new_item' => __('Neue Hero Slide', 'fjdf'),
        'edit_item' => __('Hero Slide bearbeiten', 'fjdf'),
        'update_item' => __('Hero Slide updaten', 'fjdf'),
        'view_item' => __('View Hero Slide anzeigen', 'fjdf'),
        'view_items' => __('Hero Slides anzeigen', 'fjdf'),
        'search_items' => __('Hero Slide durchsuchen', 'fjdf'),
        'not_found' => __('Nichts gefunden', 'fjdf'),
        'not_found_in_trash' => __('Nichts im Papierkorb gefunden', 'fjdf'),
        'featured_image' => __('Featured Image', 'fjdf'),
        'set_featured_image' => __('Featured Image festlegen', 'fjdf'),
        'remove_featured_image' => __('Featured Image entfernen', 'fjdf'),
        'use_featured_image' => __('Als Featured Image verwenden', 'fjdf'),
        'insert_into_item' => __('Zur Hero Slide einfügen', 'fjdf'),
        'uploaded_to_this_item' => __('Zu dieser Hero Slide hochladen', 'fjdf'),
        'items_list' => __('Hero Slides Liste', 'fjdf'),
        'items_list_navigation' => __('Hero Slides Listen-Navigation', 'fjdf'),
        'filter_items_list' => __('Hero Slides Liste filtern', 'fjdf'),
    );
    
    $args = array(
        'label' => __('Hero Slide', 'fjdf'),
        'description' => __('Hero Slider Slides', 'fjdf'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail'),
        'hierarchical' => false,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 26,
        'menu_icon' => 'dashicons-slides',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'capability_type' => 'post',
        'show_in_rest' => true,
    );
    
    register_post_type('hero_slide', $args);
}
add_action('init', 'fjdf_register_hero_slide_cpt');


/**
 * Register Carousel Post Type
 */
function fjdf_register_carousel_cpt() {
    $labels = array(
        'name' => _x('Karussell Elemente', 'Post Type General Name', 'fjdf'),
        'singular_name' => _x('Karussell Element', 'Post Type Singular Name', 'fjdf'),
        'menu_name' => __('Karussells', 'fjdf'),
        'name_admin_bar' => __('Karussell Element', 'fjdf'),
        'archives' => __('Karussell Archiv', 'fjdf'),
        'attributes' => __('Karussell Attribute', 'fjdf'),
        'all_items' => __('Alle Elemente', 'fjdf'),
        'add_new_item' => __('Neues Element hinzufügen', 'fjdf'),
        'add_new' => __('Neues hinzufügen', 'fjdf'),
        'new_item' => __('Neues Element', 'fjdf'),
        'edit_item' => __('Element bearbeiten', 'fjdf'),
        'update_item' => __('Element updaten', 'fjdf'),
        'view_item' => __('Element anzeigen', 'fjdf'),
        'view_items' => __('Elemente anzeigen', 'fjdf'),
        'search_items' => __('Element suchen', 'fjdf'),
        'not_found' => __('Nichts gefunden', 'fjdf'),
        'not_found_in_trash' => __('Nichts im Papierkorb gefunden', 'fjdf'),
    );
    
    $args = array(
        'label' => __('Karussell Element', 'fjdf'),
        'description' => __('Karussell Elemente', 'fjdf'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'hierarchical' => false,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 27,
        'menu_icon' => 'dashicons-images-alt2',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'capability_type' => 'post',
        'show_in_rest' => true,
    );
    
    register_post_type('carousel', $args);
}
add_action('init', 'fjdf_register_carousel_cpt');


/**
 * Register Carousel Category Taxonomy
 */
function fjdf_register_carousel_category_taxonomy() {
    $labels = array(
        'name' => _x('Karussell Kategorien', 'taxonomy general name', 'fjdf'),
        'singular_name' => _x('Karussell Kategorie', 'taxonomy singular name', 'fjdf'),
        'search_items' => __('Kategorien durchsuchen', 'fjdf'),
        'all_items' => __('Alle Kategorien', 'fjdf'),
        'edit_item' => __('Kategorie bearbeiten', 'fjdf'),
        'update_item' => __('Kategorie updaten', 'fjdf'),
        'add_new_item' => __('Neue Kategorie hinzufügen', 'fjdf'),
        'new_item_name' => __('Neuer Kategorie-Name', 'fjdf'),
        'menu_name' => __('Kategorien', 'fjdf'),
    );
    
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => false,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => false,
        'show_tagcloud' => false,
        'show_in_rest' => true,
    );
    
    register_taxonomy('carousel_category', array('carousel'), $args);
}
add_action('init', 'fjdf_register_carousel_category_taxonomy');


/**
 * Register Jobs Post Type
 */
function fjdf_register_jobs_cpt() {
    $labels = array(
        'name' => __('Jobs', 'fjdf'),
        'singular_name' => __('Job', 'fjdf'),
        'menu_name' => __('Jobs', 'fjdf'),
        'add_new' => __('Add New', 'fjdf'),
        'add_new_item' => __('Add New Job', 'fjdf'),
        'edit_item' => __('Edit Job', 'fjdf'),
        'new_item' => __('New Job', 'fjdf'),
        'view_item' => __('View Job', 'fjdf'),
        'search_items' => __('Search Jobs', 'fjdf'),
        'not_found' => __('No jobs found', 'fjdf'),
        'not_found_in_trash' => __('No jobs found in trash', 'fjdf'),
        'all_items' => __('All Jobs', 'fjdf'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-businessperson',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
        'rewrite' => array('slug' => 'jobs'),
        'show_in_menu' => true,
        'menu_position' => 28,
        'taxonomies' => array('job_category', 'job_type', 'job_location'),
    );
    
    register_post_type('job', $args);
}
add_action('init', 'fjdf_register_jobs_cpt');


/**
 * Register Job Category Taxonomy
 */
function fjdf_register_job_category_taxonomy() {
    $labels = array(
        'name' => __('Job Categories', 'fjdf'),
        'singular_name' => __('Job Category', 'fjdf'),
        'search_items' => __('Search Job Categories', 'fjdf'),
        'all_items' => __('All Job Categories', 'fjdf'),
        'parent_item' => __('Parent Job Category', 'fjdf'),
        'parent_item_colon' => __('Parent Job Category:', 'fjdf'),
        'edit_item' => __('Edit Job Category', 'fjdf'),
        'update_item' => __('Update Job Category', 'fjdf'),
        'add_new_item' => __('Add New Job Category', 'fjdf'),
        'new_item_name' => __('New Job Category Name', 'fjdf'),
        'menu_name' => __('Categories', 'fjdf'),
    );
    
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'job-category'),
    );
    
    register_taxonomy('job_category', 'job', $args);
}
add_action('init', 'fjdf_register_job_category_taxonomy');


/**
 * Register Job Type Taxonomy
 */
function fjdf_register_job_type_taxonomy() {
    $labels = array(
        'name' => __('Job Types', 'fjdf'),
        'singular_name' => __('Job Type', 'fjdf'),
        'search_items' => __('Search Job Types', 'fjdf'),
        'all_items' => __('All Job Types', 'fjdf'),
        'edit_item' => __('Edit Job Type', 'fjdf'),
        'update_item' => __('Update Job Type', 'fjdf'),
        'add_new_item' => __('Add New Job Type', 'fjdf'),
        'new_item_name' => __('New Job Type Name', 'fjdf'),
        'menu_name' => __('Job Types', 'fjdf'),
    );
    
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'job-type'),
    );
    
    register_taxonomy('job_type', 'job', $args);
}
add_action('init', 'fjdf_register_job_type_taxonomy');


/**
 * Register Job Location Taxonomy
 */
function fjdf_register_job_location_taxonomy() {
    $labels = array(
        'name' => __('Job Locations', 'fjdf'),
        'singular_name' => __('Job Location', 'fjdf'),
        'search_items' => __('Search Job Locations', 'fjdf'),
        'all_items' => __('All Job Locations', 'fjdf'),
        'edit_item' => __('Edit Job Location', 'fjdf'),
        'update_item' => __('Update Job Location', 'fjdf'),
        'add_new_item' => __('Add New Job Location', 'fjdf'),
        'new_item_name' => __('New Job Location Name', 'fjdf'),
        'menu_name' => __('Locations', 'fjdf'),
    );
    
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'job-location'),
    );
    
    register_taxonomy('job_location', 'job', $args);
}
add_action('init', 'fjdf_register_job_location_taxonomy');