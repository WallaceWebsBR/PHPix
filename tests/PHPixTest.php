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
use PHPUnit\Framework\TestCase;

/**
 *
 */
class PHPixTest extends TestCase
{
    public function testReturnVersion()
    {
        // classes
        $PHPixAuthentication = new PHPix\PHPixAuthentication("0123654789654123","sandbox");
        $PHPix = new PHPix\PHPix($PHPixAuthentication, "v1");

        // testes
        $this->expectOutputString($PHPix->getVersion());
        print $PHPix->getVersion();
    }

}
