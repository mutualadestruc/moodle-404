<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * @package   theme_mb2nl
 * @copyright 2017 - 2025 Mariusz Boloz (lmsstyle.com)
 * @license   PHP and HTML: http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later. Other parts: http://themeforest.net/licenses
 *
 */


/**
 *
 * Method to check Goole webfonts are in use
 *
 */
function theme_mb2nl_is_google_fonts() {
    global $PAGE;

    $gfontsettings = theme_mb2nl_theme_setting($PAGE, 'ffgeneral') . theme_mb2nl_theme_setting($PAGE, 'ffheadings') .
    theme_mb2nl_theme_setting($PAGE, 'ffmenu') . theme_mb2nl_theme_setting($PAGE, 'ffddmenu');

    $cache = cache::make('theme_mb2nl', 'features');
    $cacheid = 'gfont_' . $gfontsettings;

    if ($cache->get($cacheid)) {
        return $cache->get($cacheid);
    }

    if (preg_match('@gfont@', $gfontsettings)) {
        $cache->set($cacheid, 1);
        return 1;
    }

    $cache->set($cacheid, 0);
    return 0;

}


/**
 *
 * Method to get Google webfonts array
 *
 */
function theme_mb2nl_google_fonts_arr() {

    global $PAGE;

    $gfonts = [];
    $gfontsettings = theme_mb2nl_theme_setting($PAGE, 'ffgeneral') . theme_mb2nl_theme_setting($PAGE, 'ffheadings') .
    theme_mb2nl_theme_setting($PAGE, 'ffmenu') . theme_mb2nl_theme_setting($PAGE, 'ffddmenu');

    $cache = cache::make('theme_mb2nl', 'features');
    $cacheid = 'gfont_arr_' . theme_mb2nl_string_url_safe($gfontsettings . theme_mb2nl_theme_setting($PAGE, 'gfont1') .
    theme_mb2nl_theme_setting($PAGE, 'gfont2') . theme_mb2nl_theme_setting($PAGE, 'gfont3'));

    if ($cache->get($cacheid)) {
        return $cache->get($cacheid);
    }

    for ($i = 1; $i <= 3; $i++) {
        $gfontname = theme_mb2nl_theme_setting($PAGE, 'gfont' . $i);
        $gfontstyle = theme_mb2nl_theme_setting($PAGE, 'gfontstyle' . $i);
        $gfontstyle = str_replace(' ', '', $gfontstyle);

        if (!$gfontname) {
            continue;
        }

        $gfonts[] = [
            'set' => preg_match('@gfont' . $i . '@', $gfontsettings),
            'name' => str_replace(' ', '+', $gfontname),
            'style' => $style = 'wght@' . str_replace(',', ';', $gfontstyle),
        ];
    }

    $cache->set($cacheid, $gfonts);
    return $gfonts;

}


/**
 *
 * Method to get Google webfonts
 *
 */
function theme_mb2nl_google_fonts() {
    global $PAGE;

    $output = '';
    $i = 0;
    $fonts = theme_mb2nl_google_fonts_arr();

    if (!theme_mb2nl_is_google_fonts() || !count($fonts)) {
        return;
    }

    $output .= '<link rel="preconnect" href="//fonts.googleapis.com">';
    $output .= '<link rel="preconnect" href="//fonts.gstatic.com" crossorigin>';
    $output .= '<link href="//fonts.googleapis.com/css2';

    foreach ($fonts as $k => $f) {

        if (!$f['name'] || !$f['set']) {
            continue;
        }

        $i++;

        $pref = $i == 1 ? '?' : '&';
        $output .= $pref . 'family=' . $f['name'];
        $output .= ':' . $f['style'];

    }

    $output .= '&display=swap" rel="stylesheet">';

    return $output;

}






/**
 *
 * Method to get custom fonts
 *
 */
function theme_mb2nl_custom_fonts() {

    global $PAGE;
    $output = '';

    for ($i = 1; $i <= 3; $i++) {
        $fonts = theme_mb2nl_filearea('cfontfiles' . $i, false);
        $fontname = theme_mb2nl_theme_setting($PAGE, 'cfont' . $i);
        $x = 0;

        if (count($fonts) && $fontname) {
            $output .= '@font-face {';
            $output .= 'font-family:\'' .$fontname . '\';';
            $output .= 'src: ';

            foreach ($fonts as $f) {
                $x++;
                $finfo = pathinfo($f);
                $sep = $x == count($fonts) ? ';' : ', ';
                $format = $finfo['extension'];

                if ($finfo['extension'] === 'ttf') {
                    $format = 'truetype';
                }

                $output .= 'url(\'' . $finfo['dirname'] . '/' . $finfo['basename'] . '\') format(\'' . $format . '\')' . $sep;
            }

            $output .= '}';
        }
    }

    return $output;

}




/**
 *
 * Method to get font icons
 *
 */
function theme_mb2nl_fonticons() {
    global $PAGE;
    $output = '';

    $output .= theme_mb2nl_fontface('Lineicons');
    $output .= theme_mb2nl_fontface('remixicon', true);
    $output .= theme_mb2nl_fontface('bootstrap-icons', true);

    if (theme_mb2nl_theme_setting($PAGE, 'acsboptions') && theme_mb2nl_theme_setting($PAGE, 'dyslexic')) {
        $output .= theme_mb2nl_fontface('opendyslexic', true);
    }

    return $output;

}





/**
 *
 * Method to get font icons
 *
 */
function theme_mb2nl_fontface($fontname, $woff2 = false) {
    global $CFG;

    $output = '';
    $assetsur = $CFG->wwwroot . theme_mb2nl_themedir() . '/mb2nl/assets/' . $fontname . '/fonts/';
    $fonfamily = $fontname;
    $svgfontname = $fontname;
    $enbl = true;
    $comma = ', ';
    $comma2 = ', ';

    if ($fontname === 'opendyslexic') {
        $enbl = false;
        $fonfamily = 'OpenDyslexic';
        $comma = ';';
    }

    $woff = $enbl;

    if ($fontname === 'bootstrap-icons' || $fontname === 'Lineicons') {
        $enbl = false;
        $woff = true;
        $comma2 = ';';
    }

    $output .= '@font-face {';
    $output .= 'font-family:\'' . $fonfamily . '\';';
    $output .= 'src: ';
    $output .= $woff2 ? 'url(\'' . $assetsur . $fontname . '.woff2\') format(\'woff2\')' . $comma : '';// Super Modern Browsers.
    $output .= $woff ? 'url(\'' . $assetsur . $fontname . '.woff\') format(\'woff\')' . $comma2 : ''; // Pretty Modern Browsers.
    $output .= $enbl ? 'url(\'' . $assetsur . $fontname . '.ttf\') format(\'truetype\'),' : ''; // Safari, Android, iOS.
    $output .= $enbl ? 'url(\'' . $assetsur . $fontname . '.svg#' . $svgfontname . '\') format(\'svg\');' : ''; // Legacy iOS.
    $output .= 'font-weight: normal;';
    $output .= 'font-style: normal;';
    $output .= '}';

    return $output;

}




/**
 *
 * Method to get font family setting
 *
 */
function theme_mb2nl_get_fonf_family($page, $font) {

    return '\'' . theme_mb2nl_theme_setting($page, $font) . '\'';

}






/**
 *
 * Method to get font icons for plugins (page builder and megamenu)
 *
 */
function theme_mb2nl_get_icons4plugins() {

    return [
        'font-awesome' => [
            'name' => 'Font Awesome',
            'folder' => 'font-awesome',
            'css' => 'font-awesome',
            'prefhtml' => 'fa ',
            'tabid' => 'tab-font-icons-fa',
        ],
        'remixicon' => [
            'name' => 'Remix icons',
            'folder' => 'remixicon',
            'css' => 'remixicon',
            'prefhtml' => '',
            'tabid' => 'tab-font-icons-remix',
        ],
        'bootstrap-icons' => [
            'name' => 'Bootstrap icons',
            'folder' => 'bootstrap-icons',
            'css' => 'bootstrap-icons',
            'prefhtml' => 'bi ',
            'tabid' => 'tab-font-bootstrap-icons',
        ],
        'Lineicons' => [
            'name' => 'Line icons',
            'folder' => 'Lineicons',
            'css' => 'Lineicons',
            'prefhtml' => '',
            'tabid' => 'tab-font-icons-lineicons',
        ],
    ];

}
