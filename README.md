Voce Media Setting
===================
Contributors: kevinlangleyjr, csloisel  
Tags: settings, media  
Requires at least: 3.5  
Tested up to: 4.1.1  
Stable tag: 1.2  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  

## Description
Voce Settings API Extension for creating media settings. Requires [Voce Settings API](https://github.com/voceconnect/voce-settings-api).

## Installation

### As standard plugin:
> See [Installing Plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).

### As theme or plugin dependency:
> After dropping the plugin into the containing theme or plugin, add the following:
```php
if( ! class_exists( 'Voce_Media_Setting' ) ) {
    require_once( $path_to_voce_media_setting . '/voce-media-setting.php' );
}
```

## Usage
See [Voce Settings API](https://github.com/voceconnect/voce-settings-api). 

Use `vs_display_media_select` for the display callback arg and `vs_sanitize_media_select` in the sanitize callbacks arg.

#### Example

```php
<?php
    $page->$group->add_setting( "Field Title", "field_id", array(
        'display_callback'   => 'vs_display_media_select',
        'sanitize_callbacks' => array( 'vs_sanitize_media_select' )
    ) );
?>
```

## Changelog

**1.3.1**
* Preventing fatal error for setups that load dependency more than once and already declared functions within functions.php

**1.3.0**
* Preventing fatal error for setups that load dependencies before WordPress

**1.2**  
*Fixing issue with referencing self when not within a scope for self

**1.1**  
*Adding custom plugins_url function to assist in including the plugin in WP VIP projects.*
*Switching from `wp_get_attachment_image` to `wp_get_attachment_image_src` due to issues with getimagesize() and .ico files.*

**1.0**  
*Initial version.*