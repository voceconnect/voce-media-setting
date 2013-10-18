Voce Media Setting
===================
Contributors: kevinlangleyjr, csloisel  
Tags: settings, media  
Requires at least: 3.5  
Tested up to: 3.6  
Stable tag: 1.0  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  

## Description
Voce Settings API Extension for creating media settings.

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

**1.0**
*Initial version.*