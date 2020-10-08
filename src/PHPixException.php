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
 |          Ricardo Gama <ricard.gama@gmail.com>                     |
 +------------------------------------------------------------------------+
*/
namespace PHPix;

/**
 * Tratamento de erros
 * Fonte
 * https://www.bcb.gov.br/content/estabilidadefinanceira/pix/API_do_DICT-v1.0.html#section/Tratamento-de-erros
 *
 * O DICT retorna códigos de status HTTP para indicar sucesso ou falhas das
 * requisições. Códigos 2xx indicam sucesso. Códigos 4xx indicam falhas causadas
 * pelas informações enviadas pelo cliente ou pelo estado atual das entidades.
 * Códigos 5xx indicam problemas no serviço no lado do DICT.
 *
 * As respostas de erro incluem no corpo detalhes do erro seguindo o schema da
 * RFC Problem Details for HTTP APIs. O campo type identifica o tipo de erro e
 * no DICT segue o padrão: https://dict.pi.rsfn.net.br/api/v1/error/<TipoErro>
 */
class PHPixException extends \Exception
{

  /**
  *
  */
  public function __construct()
  {

  }

  /**
   * Prettify error message output.
   *
   * @return string
   */
  public function errorMessage()
  {
      return htmlspecialchars($this->getMessage());
  }

}
