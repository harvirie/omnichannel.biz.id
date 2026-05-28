<?php
/**
 * Plugin Name: Omni Animations
 * Description: Kontrol efek parallax dan transisi halaman (Page Transitions) canggih menggunakan GSAP dan Swup.
 * Version: 2.1.0
 * Author: Omni Theme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Omni_Animations {
    
    public function __construct() {
        add_action('add_meta_boxes', [$this, 'add_animation_meta_boxes']);
        add_action('save_post', [$this, 'save_animation_meta']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }
    
    public function add_animation_meta_boxes() {
        $screens = ['post', 'page'];
        foreach ($screens as $screen) {
            add_meta_box(
                'omni_animations_box',
                'Omni Animations Settings',
                [$this, 'render_meta_box_html'],
                $screen,
                'side',
                'high'
            );
        }
    }
    
    public function render_meta_box_html($post) {
        wp_nonce_field('omni_animations_save', 'omni_animations_nonce');
        
        $enable_transitions = get_post_meta($post->ID, '_omni_enable_transitions', true);
        $transition_type = get_post_meta($post->ID, '_omni_transition_type', true);
        $enable_parallax = get_post_meta($post->ID, '_omni_enable_parallax', true);
        
        if (empty($transition_type)) $transition_type = 'none';
        
        ?>
        <div style="padding: 10px 0;">
            <p>
                <label>
                    <input type="checkbox" name="omni_enable_transitions" value="yes" <?php checked($enable_transitions, 'yes'); ?> />
                    <strong>Enable Page Transitions</strong>
                </label>
            </p>
            <p style="margin-top: 15px;">
                <label for="omni_transition_type"><strong>Transition Type (Out)</strong></label><br>
                <select name="omni_transition_type" id="omni_transition_type" style="width: 100%; margin-top: 5px;">
                    <option value="none" <?php selected($transition_type, 'none'); ?>>None</option>
                    <option value="fade" <?php selected($transition_type, 'fade'); ?>>Fade</option>
                    <option value="slide_up" <?php selected($transition_type, 'slide_up'); ?>>Slide Up</option>
                    <option value="slide_down" <?php selected($transition_type, 'slide_down'); ?>>Slide Down</option>
                    <option value="scale" <?php selected($transition_type, 'scale'); ?>>Scale Out</option>
                </select>
                <small style="display:block; margin-top:4px; color:#666;">Animasi saat pengguna akan MENINGGALKAN halaman ini menuju halaman lain.</small>
            </p>
            <hr style="margin: 15px 0;">
            <p>
                <label>
                    <input type="checkbox" name="omni_enable_parallax" value="yes" <?php checked($enable_parallax, 'yes'); ?> />
                    <strong>Enable Parallax on Images</strong>
                </label>
                <br>
                <small style="display:block; margin-top:4px; color:#666;">Menerapkan efek gerak vertikal lambat (parallax) pada elemen gambar (khususnya hero) saat di-scroll.</small>
            </p>
        </div>
        <?php
    }
    
    public function save_animation_meta($post_id) {
        if (!isset($_POST['omni_animations_nonce']) || !wp_verify_nonce($_POST['omni_animations_nonce'], 'omni_animations_save')) {
            return;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        $enable_transitions = isset($_POST['omni_enable_transitions']) ? 'yes' : 'no';
        $transition_type = isset($_POST['omni_transition_type']) ? sanitize_text_field($_POST['omni_transition_type']) : 'none';
        $enable_parallax = isset($_POST['omni_enable_parallax']) ? 'yes' : 'no';
        
        update_post_meta($post_id, '_omni_enable_transitions', $enable_transitions);
        update_post_meta($post_id, '_omni_transition_type', $transition_type);
        update_post_meta($post_id, '_omni_enable_parallax', $enable_parallax);
    }
    
    public function enqueue_assets() {
        // GSAP + ScrollTrigger dari jsdelivr (sesuai CSP whitelist)
        wp_enqueue_script('omni-gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', array(), null, true);
        wp_enqueue_script('omni-scrolltrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', array('omni-gsap'), null, true);
        
        // Swup v4 dari jsdelivr — TANPA SwupScriptsPlugin (penyebab blinking & loading screen re-trigger)
        wp_enqueue_script('omni-swup', 'https://cdn.jsdelivr.net/npm/swup@4/dist/Swup.umd.js', array(), null, true);
        
        // SwupBodyClassPlugin — update body classes saat navigasi antar halaman
        wp_enqueue_script('omni-swup-body-class', 'https://cdn.jsdelivr.net/npm/@swup/body-class-plugin@3/dist/index.umd.js', array('omni-swup'), null, true);
        
        // Custom Assets
        wp_enqueue_style('omni-animations-css', plugin_dir_url(__FILE__) . 'assets/omni-animations.css', [], '2.2.0');
        wp_enqueue_script('omni-animations-js', plugin_dir_url(__FILE__) . 'assets/omni-animations.js', array('omni-scrolltrigger', 'omni-swup-body-class'), '2.2.0', true);
    }
}

new Omni_Animations();
