<?php 

namespace App\Http\Controllers\Api\Docs;


class ChatMessageControllerDoc
{

/****************************************************

 public function chat($id){}

*****************************************************/

 /**
 * @OA\Get(
 * path="/api/chat-message/{id}",
 * summary="get all message",
 * description="Get Chat Message",
 * operationId="getChatMessage",
 * tags={"Chat Message"},
 *   @OA\Parameter(
 *      name="id",
 *      in="path",
 *      required=true,
 *      @OA\Schema(
 *           type="integer"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *    ),
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */

}
