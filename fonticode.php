<?php
/*
Plugin Name: Fonticodes
Plugin URI: http://halfelf.org/
Description: Shortcodes to allow you to insert a font icon that's already loaded.
Version: 1.1
Author: Mika Epstein
Author URI: http://ipstenu.org/
Author Email: ipstenu@halfelf.org

License: MIT

  Copyright (C) 2014  Mika Epstein.

    This file is part of Genericon'd Short, a plugin for WordPress.

    The Genericon'd Short Plugin is free software: you can redistribute it and/or
    modify it under the terms of the MIT License as published
    by the Free Software Foundation.

Credits:
     Forked plugin code from Rachel Baker's Font Awesome for WordPress plugin
     https://github.com/rachelbaker/Font-Awesome-WordPress-Plugin
     
     Forked again from my own Genericon'd plugin


*/

class Fonticodes {

	static $gen_ver = '1.0'; // Plugin version so I can be lazy
    
    public function __construct() {
        add_action( 'init', array( &$this, 'init' ) );
    }

    public function init() {
        add_shortcode( 'ficon', array( $this, 'shortcode' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
        add_action( 'admin_menu', array( $this, 'add_settings_page'));
        add_filter('plugin_row_meta', array( $this, 'donate_link'), 10, 2);
    }

	public function register_plugin_styles() {
        global $wp_styles;
        // If Genericons is enqueued, let's call my extras for cool features
        if ( wp_style_is('genericons', 'registered') == TRUE) {
            wp_enqueue_style( 'fonticodes-genericons', plugins_url( 'css/genericon.css', __FILE__ , '', self::$gen_ver ) );
        }       
    }

    // The Shortcode
    public function shortcode( $params ) {
        $icon_atts = shortcode_atts( array(
                    'icon'   => '',
                    'family' => '',
                    'size'   => '',
                    'color'  => '',
                    'rotate' => '',
                    'repeat' => '1'
                ), $params );

		// Family
		// To do: icomoon
		// Make it all lowercase and one word
		$icon_family = str_replace(' ', '', strtolower($icon_atts['family']) );
		
		if ( $icon_family == 'fa' || $icon_family == 'fontawesome') {
			$icon_family = 'fa';
		} elseif ( $icon_family == 'dashicons' || $icon_family == 'dashicon' ) {
			$icon_family = 'dashicons';
		}  elseif ( $icon_family == 'genericons' || $icon_family == 'genericon' ) {
			$icon_family = 'genericon';
		} elseif ( $icon_family == 'glyphicons' || $icon_family == 'glyphicon' ) {
			$icon_family = 'glyphicon';
		} elseif ( $icon_family == 'fontello' ) {
			$icon_family = 'icon';
		} elseif ( $icon_family == 'octicon' || $icon_family == 'octicons' ) {
			$icon_family = 'octicon';
		} else {
			return;
		}

        // Resizing
        $icon_size = $icon_family.'-';
        if ( !empty($icon_atts['size']) && isset($icon_atts['size']) && in_array($icon_atts['size'], array('2x', '3x', '4x', '5x', '6x')) ) {
            $icon_size .= $icon_atts['size'];
        }
        else {
            $icon_size .= '1x';
        }

        // Color
        $icon_color = "color:";
        if ( isset($icon_atts['color']) && !empty($icon_atts['color']) ) {
            $icon_color .= $icon_atts['color'];
        }
        else {
            $icon_color .= 'inherit';
        }
        $icon_color .= ";";

        // Rotate
        if ( !empty($icon_atts['rotate']) && isset($icon_atts['rotate']) && in_array($icon_atts['rotate'], array('90', '180', '270', 'flip-horizontal', 'flip-vertical')) ) {
            $icon_rotate = $icon_family.'-rotate-'.$icon_atts['rotate'];
        } else {
            $icon_rotate = $icon_family.'-rotate-normal';
        }

        // Build the Icon!
        $icon_styles = $icon_color; // In case I add more later? Hope I never have to, but...
        $icon_code = '<i style="'.$icon_styles.'" class="'.$icon_family.' '.$icon_family.'-'.$icon_atts['icon'].' '.$icon_size.' '.$icon_rotate.'" name="'.$icon_atts['icon'].'"></i>';
        $icon = $icon_code;

        // Repeat the genericon if needed
        for ($i = 2 ; $i <= $icon_atts['repeat']; ++$i) {
	        $icon .= $icon_code;
	    }

        return $icon;
    }


    // Sets up the settings page
       public function add_settings_page() {
        $page = add_theme_page(__('Fonticodes'), __('Fonticodes'), 'edit_posts', 'fonticodes', array($this, 'settings_page'));
       }

    // Content of the settings page
       function settings_page() {
               ?>
               <div class="wrap">

        <h2>Fonticodes <?php echo self::$gen_ver; ?> Usage</h2>

        <p>This plugin <em>does not</em> install any font icon families for you, it simply allows you to use shortcodes with any you may have installed.</p>

        <h3>Using the Plugin</h3>

        <p>To use Font Awesome to insert a blue Twitter icon with double size:</p>

               <p><code>[ficon family=FontAwesome icon=twitter color=blue size=2x]</code></p>

               <p>The 'Family' should be the name of the font family, so for example Font Awesome uses `font-family: 'FontAwesome';` and thus you should use FontAwesome for the family value.</p>

               <h3>Supported Font Families</h3>

               <ul>
                       <li><a href="http://fontawesome.io/">Font Awesome</a></li>
                       <li><a href="http://genericons.com/">Genericons</a></li>
                       <li><a href="https://melchoyce.github.io/dashicons/">Dashicons</a></li>
                       <li><a href="http://glyphicons.com/">Glyphicons</a></li>
                       <li><a href="http://octicons.github.com/">Octicons</a></li>
               </ul>

               </div>
               <?php
       }
    
    // donate link on manage plugin page
    public function donate_link($links, $file) {
        if ($file == plugin_basename(__FILE__)) {
                $donate_link = '<a href="https://store.halfelf.org/donate/">Donate</a>';
                $settings_link = '<a href="' . admin_url( 'themes.php?page=fonticodes' ) . '">' . __( 'Settings' ) . '</a>';
                $links[] = $settings_link.' | '.$donate_link;
        }
        return $links;
    }

}

new Fonticodes();