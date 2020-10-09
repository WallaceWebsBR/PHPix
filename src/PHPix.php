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
 * Uses
 */
use PHPix\PHPixException;
use PHPix\PHPixAuthentication;
use PHPix\PHPixEnvironment;

/**
 * DICT API (1.0.0)
 * OpenAPI specification
 *
 * Suporte TI BCB: suporte.ti@bcb.gov.br
 * URL: https://www.bcb.gov.br/estabilidadefinanceira/pagamentosinstantaneos
 * License: Apache 2.0
 *
 * O Diretório de Identificadores de Contas Transacionais - DICT - é o serviço
 * do arranjo Pix que permite buscar detalhes de contas transacionais com chaves
 * de endereçamento mais convenientes para quem faz um pagamento. Entre os tipos
 * de chave atualmente disponíveis estão CPF, CNPJ, telefone, e-mail e EVP. As
 * informações retornadas pelo DICT permitem ao pagador confirmar a identidade
 * do recebedor, proporcionando uma experiência mais fácil e segura. Permitem
 * também ao PSP do pagador criar a  *  * mensagem de instrução de pagamento a
 * ser enviada para o sistema de liquidação com os detalhes de conta do
 * recebedor.
 */
class PHPix
{

  /**
   * PIX version
   *
   * @string
   */
  private $VERSION = "v1";

  /**
   *
   * @var string
   */
  private $baseUrl = '';

  /**
   * PHPix constructor.
   *
   * @param Credential $credential
   * @throws Exception
   */
  function __construct(PHPixAuthentication $credential, $version)
  {
      // versão do PIX
      $this->VERSION = DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR;

      // Definição de ambiente
      if ($credential->getEnviroment() == "PRODUCTION") {
          $this->baseUrl = PHPixEnvironment::getProductionUrl().$this->VERSION;
      } elseif ($credential->getEnviroment() == "SANDBOX") {
          $this->baseUrl = PHPixEnvironment::getSandboxUrl().$this->VERSION;
      } else {
          throw new PHPixException('Environment not set');
      }
  }

  /**
  *
  */
  public function getVersion()
  {
    return $this->VERSION;
  }

   /**
    * @return string
    */
   public function getBaseUrl()
   {
       return $this->baseUrl;
   }

   /**
    * @param $url_path
    * @return mixed
    * @throws Exception
    */
   function get($url_path)
   {
       return $this->send($url_path, 'GET');
   }

   /**
    * @param $url_path
    * @param $params
    * @return mixed
    * @throws Exception
    */
   function post($url_path, $params)
   {
       return $this->send($url_path, 'POST', $params);
   }

   /**
    * @param $url_path
    * @param $params
    * @return mixed
    * @throws Exception
    */
   function put($url_path, $params)
   {
       return $this->send($url_path, 'PUT', $params);
   }

   /**
    * @param $url_path
    * @return string
    */
   private function getFullUrl($url_path)
   {
       if (stripos($url_path, $this->baseUrl, 0) === 0) {
           return $url_path;
       }

       return $this->baseUrl . $url_path;
   }

   /**
    * @param $url_path
    * @param $method
    * @param null $json
    * @return mixed
    * @throws Exception
    */
   private function send($url_path, $method, $json = NULL)
   {

       $response = "";
       $curl = curl_init($this->getFullUrl($url_path));

       $defaultCurlOptions = array(
           CURLOPT_CONNECTTIMEOUT => 60,
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_TIMEOUT        => 60,
           CURLOPT_HTTPHEADER     => array('Content-Type: application/json; charset=utf-8'),
           CURLOPT_SSL_VERIFYHOST => 2,
           CURLOPT_SSL_VERIFYPEER => 0
       );

       if ($method == 'POST') {
           curl_setopt($curl, CURLOPT_POST, 1);
           curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
       } elseif ($method == 'PUT') {
           curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
           curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
       } elseif ($method == 'GET') {
           curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
       }
       curl_setopt($curl, CURLOPT_ENCODING, "");
       curl_setopt_array($curl, $defaultCurlOptions);


       try {
           $response = curl_exec($curl);
       } catch (Exception $e) {
           print "ERROR1";
       }
       if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 500) {
           throw new PHPixException("Internal Server Error", CURLINFO_HTTP_CODE);
       }
       if (curl_getinfo($curl, CURLINFO_HTTP_CODE) >= 400) {
           throw new PHPixException(htmlentities(json_decode($response)->result->error->details), CURLINFO_HTTP_CODE);
       }
       if (!$response) {
           print "URL ERROR";
           EXIT;
       }
       curl_close($curl);

       return json_decode($response, true);
   }

}
