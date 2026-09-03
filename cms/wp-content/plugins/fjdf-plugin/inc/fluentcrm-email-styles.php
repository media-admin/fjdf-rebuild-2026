<?php
// Datei: inc/fluentcrm-email-styles.php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Runde Bilder in FluentCRM-Newslettern:
 * - im Block-Editor (Live-Vorschau)
 * - in der tatsächlich versendeten E-Mail
 */
function fjdf_fluentcrm_circle_image_css() {
    ?>
    <style>
        .fjdf-circle-img {
            border-radius: 50% !important;
            width: 220px !important;
            height: 220px !important;
            object-fit: cover !important;
            display: block !important;
        }
    </style>
    <?php
}
add_action( 'fluent_crm/email_header', 'fjdf_fluentcrm_circle_image_css' );
add_action( 'fluent_crm/block_editor_head', 'fjdf_fluentcrm_circle_image_css' );