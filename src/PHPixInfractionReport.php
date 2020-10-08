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
 * Relatos de Infração
 * Relatos de infração servem para reportar transações sob suspeita de fraude
 * (FRAUD) ou PLD/FT (AML_CFT). Podem ser feitas tanto pelo participante
 * debitado quanto pelo creditado na transação.
 *
 * Depois de criado, o relato deve ser reconhecido pela outra parte da transação
 * (acknowledge) e, após análise, fechado (close) concordando (AGREED) ou
 * discordando (DISAGREED) da infração.
 *
 * O criador do relato pode cancelá-lo a qualquer momento, mesmo depois de
 * fechado.
 *
 * Relatos de infração são criados a partir do identificador da transação
 * realizada no SPI (EndToEndId). O prazo máximo para relatar infração em
 * uma transação está no regulamento do DICT.
 *
 * Cada participante deve realizar polling periódico na lista de relatos para
 * verificar se existem novos relatos em que é parte. O recebimento do relato
 * não implica em concordância. Os níveis de serviço exigidos para as operações
 * com relatos de infração estão definidos no Manual de Tempos do Pix.
 *
 * As relatos por motivo de fraude e PLD/FT são contabilizadas e retornadas ao
 * consultar vínculo. Se for cancelado, o relato deixa de ser contabilizado
 * entre os REPORTED_FRAUDS e REPORTED_AML_CFT durante a consulta de vínculos.
 *  ---------------------------------------------------------------------------
 */
class InfractionReport
{

}
