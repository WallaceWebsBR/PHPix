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
 * ------------------------------------------------------------------------
 * Autenticação
 * ------------------------------------------------------------------------
 * O DICT utiliza autenticação mútua TLS.
 *
 * As definições de autenticação para essa API estão especificadas no manual de
 * segurança do Pix.
 *
 * Assinatura digital
 *
 * Requisições que incluam ou alterem informações no DICT devem ser assinadas
 * com XML Digital Signature pelo participante que envia a requisição.
 * Requisições de consulta não precisam ser assinadas. Respostas retornadas pelo
 * DICT serão assinadas digitalmente. As assinaturas devem ser validadas pelos
 * clientes da API.
 *
 * A assinatura será colocada no elemento Signature das requisições e respostas.
 * O Signature será envelopado pelo XML que está sendo assinado (assinatura é um
 * elemento filho).
 *
 * Para mais detalhes sobre a forma de construir a assinatura, consulte o manual
 * de segurança do Pix
 *
 **/
class PHPixAuthentication
{

  /**
  *
  */
  public function __construct()
  {

  }

}
