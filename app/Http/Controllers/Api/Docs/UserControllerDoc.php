<?php 

namespace App\Http\Controllers\Api\Docs;


class UserControllerDoc
{

/****************************************************

 public function authenticate(Request $request){}

*****************************************************/

/**
 * @OA\Post(
 * path="/api/v1/user/login",
 * summary="Login",
 * description="Login by email, password",
 * operationId="authLogin",
 * tags={"User Auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(
 *			property="email", 
 *			type="string", 
 *			format="email", 
 *			example="five_seller@fiveexceptions.com"
 *		),
 *       @OA\Property(
 *			property="password", 
 *			type="string", 
 *			format="password", 
 *			example="Indore@123"
 *		),       
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *		@OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(
 *			property="email", 
 *			type="string", 
 *			format="email", 
 *			example="five_seller@fiveexceptions.com"
 *		),
 *       @OA\Property(
 *			property="password", 
 *			type="string", 
 *			format="password", 
 *			example="Indore@123"
 *		),       
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


/**********************************************************

	public function register(Request $request){}

**********************************************************/


/**
 * @OA\Post(
 * path="/api/v1/user",
 * summary="Register",
 * description="Login by email, password",
 * operationId="authRegister",
 * tags={"User Auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *		required={"first_name","last_name","email","password"},
 *      @OA\Property(
 *			property="first_name", 
 *			type="string", 
 *			format="email", 
 *			example="five"
 *		),
 *      @OA\Property(
 *			property="last_name", 
 *			type="string", 
 *			format="text", 
 *			example="seller"
 *		),
 *       @OA\Property(
 *			property="email", 
 *			type="string", 
 *			format="text", 
 *			example="five_seller@fiveexceptions.com"
 *		),
  *       @OA\Property(
 *			property="role", 
 *			type="string", 
 *			format="text", 
 *			example="4"
 *		),
 *       @OA\Property(
 *			property="password", 
 *			type="string", 
 *			format="password", 
 *			example="Indore@123"
 *		),   
  *       @OA\Property(
 *			property="password_confirmation", 
 *			type="string", 
 *			format="password", 
 *			example="Indore@123"
 *		),     
 *    ),
 * ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
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
