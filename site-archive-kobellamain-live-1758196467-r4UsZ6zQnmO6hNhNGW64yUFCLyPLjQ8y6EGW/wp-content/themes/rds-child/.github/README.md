# polaris-child
Basic Child Theme for Polaris Theme Framework: https://github.com/ESBlueCorona/Polaris-rds-Child

## How it works
Polaris RDS Child Theme shares with the parent theme all PHP files and adds its own functions.php on top of the Polaris parent theme's functions.php.

**IT DOES NOT LOAD THE PARENT THEMES CSS FILE(S)!** Instead it uses the Polaris Parent Theme as a dependency via npm and compiles its own CSS file from it.

Polaris Child Theme uses the Enqueue method to load and sort the CSS file the right way instead of the old @import method.

## Installation
1. Install the parent theme Polaris first: `https://github.com/Polaris/Polaris` or `https://wordpress.org/themes/Polaris/`
   - IMPORTANT: If you download Polaris from GitHub make sure you rename the "Polaris-master.zip" file to "Polaris.zip" or you might have problems using this child theme!
1. Upload the Polaris-child folder to your wp-content/themes directory
1. Go into your WP admin backend 
1. Go to "Appearance -> Themes"
1. Activate the Polaris Child theme
