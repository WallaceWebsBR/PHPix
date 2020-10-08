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
 * ---------------------------------------------------------------------------
 * Reivindicação
 * ---------------------------------------------------------------------------
 * Conforme as chaves mudem de dono ou os usuários finais criem contas
 * transacionais em outros PSPs, os seguintes cenários precisarão ser tratados:
 *
 * Houve troca de posse de uma chave (telefone ou email) e o novo dono deseja
 * criar um vínculo para uma conta sua mas o dono anterior já possui vínculo
 * registrado no DICT com essa chave. Um usuário deseja mudar a vinculação de
 * uma chave sua para outra conta, que está domiciliada em um participante
 * diferente do atual. Para o cenário 1, deve ser criada uma reivindicação de
 * posse. Já para o cenário 2, uma portabilidade. Em ambos cenários existirá a
 * figura do PSP que irá ceder a chave (PSP Doador), e o PSP que irá receber a
 * chave (PSP Reivindicador). No cenário de reivindicação de posse, o PSP doador
 * e o reivindicador podem ser o mesmo.
 *
 * Nessa especificação, reivindicação sem qualificador é usado como termo mais
 * genérico para se referir tanto à reivindicação de posse quanto à
 * (reivindicação de) portabilidade.
 *
 * Os processos de reivindicação são sempre iniciados pelo PSP reivindicador.
 * Uma reivindicação tem as seguintes situações:
 *
 * OPEN - Aberta pelo reivindicador, mas ainda não recebida pelo doador.
 * WAITING_RESOLUTION - Já foi recebida pelo doador e está aguardando a
 *                       resolução. Os critérios confirmação ou cancelamento
 *                       da reivindicação seguem normas específicas a depender
 *                       do tipo (posse ou portabilidade).
 * CONFIRMED - O doador confirmou a reivindicação. Isso implica a remoção da
 *              chave do DICT e da base interna do PSP doador. Está aguardando
 *              o reivindicador encerrar o processo.
 * CANCELLED - O doador ou reivindicador cancelou a reivindicação, mantendo o
 *              vínculo inalterado (conforme estava antes da reivindicação)
 *              tanto no DICT quanto na base interna do PSP.
 * COMPLETED - Tanto o DICT quanto o reivindicador atualizaram suas bases com
 *              o novo vínculo.
 *
 * Diagrama de estados
 *
 * ( OPEN )------->( WAITING_RESOLUTION )------->( CONFIRMED )------->( COMPLETED )
 *                         |                        /
 *                         |                       /
 *                         |                      /
 *                         |                     /--Apenas para
 *                         v                    /   reivindicação
 *                   ( CANCELLED )<------------v    de posse
 *
 * Importante! Os participantes deverão monitorar as reivindicações fazendo
 * polling períodico no endpoint de listar reivindicações. A periodicidade
 * adequada dependerá das definições de nível de serviço. Consulte o Manual
 * de Tempos do Pix.
 *
 * ---------------------------------------------------------------------------
 * Fontes:
 *    Reivindicação
 *    https://www.bcb.gov.br/content/estabilidadefinanceira/pix/API_do_DICT-v1.0.html#tag/Claim
 *  ---------------------------------------------------------------------------
 */
 class PHPixClaim
 {

   /**
   *
   */
   public function __construct()
   {

   }

}
