<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Strings for component 'factor_email', language 'es', version '4.4'.
 *
 * @package     factor_email
 * @category    string
 * @copyright   1999 Martin Dougiamas and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['email:accident'] = 'Si usted no solicitó este correo electrónico, clique en "continuar" para invalidar el intento de acceso. Si usted clicó este enlace accidentalmente, clique en "cancelar", y no se realizará ninguna acción.';
$string['email:browseragent'] = 'Los detalles del navegador para esta solicitud son: "{$a}"';
$string['email:geoinfo'] = 'Esta solicitud parece haber sido originada desde aproximadamente:';
$string['email:greeting'] = 'Hola, {$a} 👋';
$string['email:ipinfo'] = 'Detalles de solicitud de acceso:';
$string['email:link'] = 'enlace de verificación';
$string['email:loginlink'] = 'O, si está en el mismo dispositivo, use {$a}.';
$string['email:message'] = 'Aquí está su código de verificación para {$a->sitename} ({$a->siteurl}).';
$string['email:originatingip'] = 'Este intento de acceso se hizo desde "{$a}".';
$string['email:revokelink'] = 'Si no era usted, usted puede {$a}.';
$string['email:revokesuccess'] = 'Este código ha sido revocado satisfactoriamente. Se han finalizado todas las sesiones de {$a}. No podrá usarse el correo electrónico como factor hasta que se haya verificado la seguridad de la cuenta.';
$string['email:stoploginlink'] = 'parar este intento de acceso';
$string['email:subject'] = 'Aquí está su código de verificación';
$string['email:uadescription'] = 'Identidad del navegador para esta solicitud:';
$string['email:validity'] = 'El código sólo puede usarse una vez y es válido para {$a}.';
$string['error:badcode'] = 'No se ha encontrado el código. Puede ser que sea un enlace antiguo, que se haya enviado un nuevo código por correo electrónico, o que ya haya habido un acceso satisfactorio con este código.';
$string['error:parameters'] = 'Parámetros de página incorrectos.';
$string['error:wrongverification'] = 'Código incorrecto. Inténtelo de nuevo.';
$string['event:unauthemail'] = 'Correo electrónico no autorizado recibido';
$string['info'] = 'Usted está usando el correo {$a} para autenticarse. Esto ha sido configurado por el administrador de su sitio.';
$string['logindesc'] = 'Acabamos de enviarle un código de 6 dígitos a su correo: {$a}';
$string['loginoption'] = 'Le hemos enviado un código por correo electrónico';
$string['loginskip'] = 'No recibí ningún código';
$string['loginsubmit'] = 'Continuar';
$string['logintitle'] = 'Verifique que es usted mediante correo electrónico';
$string['managefactor'] = 'Gestionar correo electrónico';
$string['manageinfo'] = 'Se está usando "{$a}" para la autenticación. Esto ha sido configurado por su administrador.';
$string['pluginname'] = 'Correo electrónico';
$string['privacy:metadata'] = 'El plugin de factor de correo electrónico E-Mail Factor no almacena ningún dato personal';
$string['settings:duration'] = 'Periodo de validez';
$string['settings:duration_help'] = 'El tiempo durante el cual el código es válido.';
$string['settings:suspend'] = 'Suspender cuentas no autorizadas';
$string['settings:suspend_help'] = 'Active esto para suspender cuentas de usuarios si se recibe un correo electrónico de verificación no autorizado.';
$string['setupfactor'] = 'Configuración de correo electrónico';
$string['summarycondition'] = 'tiene una configuración de correo electrónico válida';
$string['unauthemail'] = 'Correo electrónico no autorizado';
$string['unauthloginattempt'] = 'El usuario con id {$a->userid} hizo un intento de acceso no autorizado usando correo de verificación de
IP {$a->ip} con agente de navegador {$a->useragent}.';
$string['verificationcode'] = 'Introduzca código de verificación para confirmación';
$string['verificationcode_help'] = 'Se le ha enviado un código de verificación a su correo electrónico.';
