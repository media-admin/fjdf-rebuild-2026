<?php
/**
 * ACF Field Revisions
 *
 * Nimmt flache ACF-Felder in die WordPress-Revisionierung auf.
 * Hinweis: Repeater-/Flexible-Content-Unterfelder werden dadurch
 * NICHT erfasst (siehe Chat-Verlauf).
 */

if (!defined('ABSPATH')) {
    exit;
}

add_filter('wp_post_revision_meta_keys', function($keys, $post) {
    if (!function_exists('acf_get_field_groups')) {
        return $keys;
    }

    $field_groups = acf_get_field_groups(['post_id' => $post->ID]);
    foreach ($field_groups as $group) {
        $fields = acf_get_fields($group);
        if (!$fields) {
            continue;
        }
        foreach ($fields as $field) {
            $keys[] = $field['name'];
        }
    }

    return $keys;
}, 10, 2);