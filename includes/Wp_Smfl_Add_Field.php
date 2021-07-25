<?php

namespace Social\Link;

/**
 * Class Wp_Smfl_Add_Field
 * @package Social\Link
 */
class Wp_Smfl_Add_Field {
    /**
     * Wp_Smfl_Add_Field constructor.
     */
    public function __construct() {
        add_action( 'admin_init', [ $this, 'smfl_register_extra_settings' ] );
    }

    public function smfl_register_extra_settings() {
        //add_settings_section('smfl_section', __( 'Social media settings','social-media-footer-link' ), [ $this, 'smfl_add_section' ], 'general' );
        add_settings_field('fb_url', __( 'Facebook URL','social-media-footer-link' ), [ $this, 'smfl_display_fb_url' ], 'general' );
        add_settings_field('in_url', __( 'Linkedin URL','social-media-footer-link' ), [ $this, 'smfl_display_linkedin_url' ], 'general' );
    }

    public function smfl_add_section(){
        echo "<p>".__( 'Social media URL', 'social-media-footer-link' )."</p>";
    }

    /**
     * Get the url of facebook
     */
    public function smfl_display_fb_url() {
        $fb_link= '';
        printf( "<input type='text' id='%s' name='%s' value='%s'/>", 'smfl_fb_url', 'smfl_fb_url', $fb_link );
    }

    /**
     * Get the url of linkedin
     */
    public function smfl_display_linkedin_url() {
        $in_link= '';
        printf( "<input type='text' id='%s' name='%s' value='%s'/>", 'smfl_in_url', 'smfl_in_url', $in_link );
    }
}