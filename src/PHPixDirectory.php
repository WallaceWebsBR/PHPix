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
*  ---------------------------------------------------------------------------
 *  Diretório
 *  ---------------------------------------------------------------------------
 *  O diretório de identificadores de contas transacionais é um conjunto de
 *  vínculos. Um vínculo é uma associação entre uma chave de endereçamento,
 *  uma conta transacional e seu dono. O dono pode ser uma pessoa física ou
 *  uma pessoa jurídica. A chave de endereçamento é usada identificar um
 *  vínculo.
 *
 *  Os tipos de chave suportadas atualmente são as seguintes:
 *
 *  Tipo	  Exp. regular	            Exemplo
 *  CPF	    ^[0-9]{11}$	              12345678901
 *  CNPJ	  ^[0-9]{14}$	              12345678901234
 *  PHONE	  ^\+[1-9][0-9]\d{1,14}$	  +5510998765432
 *  EMAIL	  #1                        pix@bcb.gov.br
 *
 * EVP	    [0-9a-f]{8}-[0-9a-f]{4}-
 *          [0-9a-f]{4}-[0-9a-f]{4}-
 *          [0-9a-f]{12}	            123e4567-e89b-12d3-a456-426655440000
 *
 * Novos tipos de chave poderão vir a ser adicionados no futuro. Logo, é
 * importante que a implementação de clientes seja flexível, permitindo a
 * adição de novos tipos de chave.
 * ---------------------------------------------------------------------------
 * Fontes:
 *    Diretório
 *    https://www.bcb.gov.br/content/estabilidadefinanceira/pix/API_do_DICT-v1.0.html#tag/Directory
 *
 *    #1 - e-mails válidos W3C HTML5
 *    https://html.spec.whatwg.org/multipage/input.html#valid-e-mail-address
 *  ---------------------------------------------------------------------------
 */
 class PHPixException extends \Exception
 {

   /**
   *
   */
   public function __construct()
   {

   }

}
