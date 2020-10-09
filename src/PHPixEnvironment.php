<?php
/*
 +------------------------------------------------------------------------+
 | PHPix                                                                  |
 +------------------------------------------------------------------------+
 | Copyright (c) 2020-2021 - OER Tecnologia                               |
 +------------------------------------------------------------------------+
 | This source file is subject to the New BSD License that is bundled     |
 | with this package in the file LICENSE.txt.                             |
 |                                                                        |
 | If you did not receive a copy of the license and are unable to         |
 | obtain it through the world-wide-web, please send an email             |
 | to license@oertecnologia.com.br so we can send you a copy immediately. |
 |                                                                        |
 | @package   PHPix                                                       |
 | @copyright Copyright (c) 2020 OER Tecnologia oertecnologia.com.br      |
 | @license   http://opensource.org/licenses/mit-license The MIT License  |
 +------------------------------------------------------------------------+
 | Authors: Luiz Olivetti <luiz@oertecnologia.com.br>                     |
 |          Ricardo Gama <ricard.gama@gmail.com>                          |
 +------------------------------------------------------------------------+
*/
namespace PHPix;

/**
* Class Environment
*
* @package PHPix
*/
abstract class PHPixEnvironment
{
        /**
         *
         */
        public const SANDBOX    = "SANDBOX";
        /**
         *
         */
        public const PRODUCTION = "PRODUCTION";

        /**
         *
         */
        private const SANDBOX_URL = "https://dict-h.pi.rsfn.net.br:16522/api";
        /**
         *
         */
        private const PRODUCTION_URL = "https://dict.pi.rsfn.net.br:16422/api";

        /**
         * @return string
         */
        public static function getSandboxUrl()
        {
            return self::SANDBOX_URL;
        }

        /**
         * @return string
         */
        public static function getProductionUrl()
        {
            return self::PRODUCTION_URL;
        }

}
