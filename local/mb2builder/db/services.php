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
 * @package    local_mb2builder
 * @copyright  2018 - 2025 Mariusz Boloz (lmsstyle.com)
 * @license    PHP and HTML: http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later. Other parts: http://themeforest.net/licenses
 */

defined('MOODLE_INTERNAL') || die();

$functions = [
    'local_mb2builder_get_theme_icons' => [
            'classname' => 'local_mb2builder_external',
            'methodname' => 'get_theme_icons',
            'classpath' => 'local/mb2builder/externallib.php',
            'description' => 'Get list of theme font icons.',
            'type' => 'read',
            'ajax' => true,
            'loginrequired' => true,
            'capabilities' => '',
            'services' => [MOODLE_OFFICIAL_MOBILE_SERVICE],
    ],
    'local_mb2builder_get_images_preview' => [
            'classname' => 'local_mb2builder_external',
            'methodname' => 'get_images_preview',
            'classpath' => 'local/mb2builder/externallib.php',
            'description' => 'Get list of images.',
            'type' => 'read',
            'ajax' => true,
            'loginrequired' => true,
            'capabilities' => '',
            'services' => [MOODLE_OFFICIAL_MOBILE_SERVICE],
    ],
];
