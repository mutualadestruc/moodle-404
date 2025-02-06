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

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . '/externallib.php');
require_once(__DIR__ . '/lib.php');
require_once(__DIR__ . '/classes/api.php');

/**
 * External theme API
 */
class local_mb2builder_external extends external_api {


    /**
     *
     * Method to get a tabs of all icons.
     *
     */
    public static function get_theme_icons() {

        $params = self::validate_parameters(self::get_theme_icons_parameters(), []);

        $results = [
            'icons' => mb2builderApi::font_icons(),
        ];

        return $results;

    }





    /**
     *
     * Method to get images preview.
     *
     */
    public static function get_images_preview($filearea, $itemid, $pageid, $footerid, $partid) {

        $params = self::validate_parameters(self::get_images_preview_parameters(), [
            'filearea' => $filearea,
            'itemid' => $itemid,
            'pageid' => $pageid,
            'footerid' => $footerid,
            'partid' => $partid,
        ]);

        $results = [
            'images' => mb2builderApi::get_images_preview($params['filearea'], $params),
        ];

        return $results;

    }




    /**
     * Describes the parameters for submit_grading_form webservice.
     * @return external_function_parameters
     * @since  Moodle 3.1
     */
    public static function get_theme_icons_parameters() {
        return new external_function_parameters(
            []
        );
    }


    /**
     * Describes the parameters for submit_grading_form webservice.
     * @return external_function_parameters
     * @since  Moodle 3.1
     */
    public static function get_images_preview_parameters() {
        return new external_function_parameters(
            [
                'filearea' => new external_value(PARAM_RAW, 'File area name.'),
                'itemid' => new external_value(PARAM_INT, 'Item ID.'),
                'pageid' => new external_value(PARAM_RAW, 'Page unique ID.'),
                'footerid' => new external_value(PARAM_RAW, 'Footer unique ID.'),
                'partid' => new external_value(PARAM_RAW, 'Part unique ID.'),
            ]
        );
    }

    /**
     * Describes the return for submit_grading_form
     * @return external_function_parameters
     * @since  Moodle 3.1
     */
    public static function get_theme_icons_returns() {
        return new external_single_structure(
            [
                'icons' => new external_value(PARAM_RAW, 'Theme font icons list'),
                'warnings' => new external_warnings(),
            ]
        );
    }


    /**
     * Describes the return for submit_grading_form
     * @return external_function_parameters
     * @since  Moodle 3.1
     */
    public static function get_images_preview_returns() {
        return new external_single_structure(
            [
                'images' => new external_value(PARAM_RAW, 'List of the images.'),
                'warnings' => new external_warnings(),
            ]
        );
    }

}
