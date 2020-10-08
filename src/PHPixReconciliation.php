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
 |          Ricardo Gama <cazuza@oertecnolgia.com.br>                     |
 +------------------------------------------------------------------------+
*/
namespace PHPix;

/**
 * ---------------------------------------------------------------------------
 * Reconciliação
 * A reconciliação permite que o participante identifique inconsistências nos
 * vínculos da sua base de dados interna e o DICT. É possível fazer a verificação
 * de forma agregada, sobre todo o conjunto de vínculos, e a verificação de um
 * vínculo individual.
 *
 * Para permitir que a reconciliação seja feita de forma eficiente e segura,
 * toda operação realizada em cima de um vínculo gera um identificador de
 * conteúdo, ou CID (content identifier). O CID é um número de 256 bits que
 * identifica de forma única o vínculo e todos os seus atributos essenciais
 * (ver seção sobre cálculo do CID). Modifições dos dados essenciais do vínculo
 * implicam na modificação do CID associado a ele.
 *
 * A verificação agregada dos vínculos é feita com base no verificador de
 * sincronismo (VSync). O participante pode aferir a igualdade do conjunto de
 * vínculos em seu domínio gerando o VSync (ver seção sobre cálculo do VSync)
 * da sua base e criando uma verificação de sincronismo. A igualdade dos VSyncs
 * do DICT e do PSP implica, com altíssima probabilidade, que o conjunto de
 * CIDs é igual. Caso os VSyncs sejam diferentes, o conjunto de CIDs é
 * necessariamente diferente, o que significa que há divergências no
 * conjunto de dados de vínculos naquele momento.
 *
 * Ao identificar divergências, PSP poderá consultar pelo CID, alterar,
 * remover ou criar vínculos colocando no campo Reason das requisições o valor
 * RECONCILIATION.
 *
 * As operações feitas no conjunto de vínculos sob domínio do PSP podem ser
 * acompanhadas de forma contínua no log de eventos de CIDs.
 *
 * Para obter uma lista completa dos CIDs no DICT relativos a um tipo de chave,
 * um PSP poderá solicitar a criação de um arquivo de CIDs.
 * ---------------------------------------------------------------------------
 * Fontes:
 *    Reconciliação
 *    https://www.bcb.gov.br/content/estabilidadefinanceira/pix/API_do_DICT-v1.0.html#tag/Reconciliation
 *  ---------------------------------------------------------------------------
 */

 class Reconciliation
 {


    /**
    *
    */
    public function __construct()
    {

    }

   /**
    * ---------------------------------------------------------------------------
    * Função calculateCID
    * ---------------------------------------------------------------------------
    * Cálculo de CID
    * O CID é calculado da seguinte forma:
    * ---------------------------------------------------------------------------
    * Fonte:
    * https://www.bcb.gov.br/content/estabilidadefinanceira/pix/API_do_DICT-v1.0.html#section/Calculo-de-CID
    * ---------------------------------------------------------------------------
    * entryAttributes = keyType "&" key "&" ownerTaxIdNumber "&" ownerName "&" ownerTradeName "&" participant "&" branch "&" accountNumber "&" accountType
    * cidBytes = hmacSha256(requestIdBytes, entryAttributes)
    * cid = lowercase-hexadecimal(cidBytes)
    *
    * Observações:
    *
    * [entryAttributes] é uma string construída pela junção dos atributos essenciais
    * do vínculo, separados por &. Todos atributos são strings codificadas em UTF-8.
    * Atributos nulos são codificados com string em branco, "".
    *
    * [hmacSha256] é a função HMAC baseada na função de hash SHA-256.
    *
    * [requestIdBytes] são 16 bytes aleatórios, gerados para identificar a
    * requisição que cria o vínculo, usado como chave na função hmacSha256.
    *
    * [cid] é a representação hexadecimal, em lowercase, do resultado da
    * função hmacSha256.
    *
    * Exemplo
    * entryAttributes = 'PHONE&+5511987654321&11122233300&João Silva&&12345678&00001&0007654321&CACC'
    * requestIdBytes = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
    * cid = '28c06eb41c4dc9c3ae114831efcac7446c8747777fca8b145ecd31ff8480ae88'
    *
    * ---------------------------------------------------------------------------
    * @param entryAttributes
    * @param hmacSha256
    * @param requestIdBytes
    * @param cid
    * ---------------------------------------------------------------------------
    */
    private function calculateCID()
    {

    }

    /**
     * ---------------------------------------------------------------------------
     * Função calculateVSync
     * ---------------------------------------------------------------------------
     * Cálculo de VSync
     * O VSync é resultado da aplicação de bitwise-XOR ('OU' exclusivo bit-a-bit)
     * sobre todos os CIDs de um determinado tipo de chave.
     * ---------------------------------------------------------------------------
     * Fonte:
     * https://www.bcb.gov.br/content/estabilidadefinanceira/pix/API_do_DICT-v1.0.html#section/Calculo-do-VSync
     * ---------------------------------------------------------------------------
     *
     * Exemplo
     * cids = ['28c06eb41c4dc9c3ae114831efcac7446c8747777fca8b145ecd31ff8480ae88',
     *        '4d4abb9168114e349672b934d16ed201a919cb49e28b7f66a240e62c92ee007f',
     *        'fce514f84f37934bc8aa0f861e4f7392273d71b9d18e8209d21e4192a7842058']
     *
     * vsync = xor(xor(cids[0], cids[1]), cids[2])  = '996fc1dd3b6b14bcf0c9fe8320eb66d7e2a3fd874ccf767b2e939641b1ea8eaf'
     *
     * Observações:
     * VSync para um conjunto vazio de CIDs é definido como
     * '0000000000000000000000000000000000000000000000000000000000000000'.
     * Há três CIDs no exemplo acima, representados em hexadecimal. A operação
     * bitwise-XOR é feita com os CIDs em formato binário.
     * bitwise-XOR é comutativo, não importa a ordem da sua aplicação.
     * Para calcular o novo VSync resultante da adição de um CID ao conjunto,
     * basta calcular o XOR desse CID com o VSync atual. O novo VSync resultante
     * da remoção de um CID é calculado da mesma forma.
     * ---------------------------------------------------------------------------
     * @param vsync
     * @param cids
     * ---------------------------------------------------------------------------
     */
     private function calculateVSync()
     {

     }

}
