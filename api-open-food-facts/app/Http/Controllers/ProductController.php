<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Types\BaseResponse;
use App\WebService\OpenFoodFactsService;

class ProductController extends Controller
{

    /**
     * Insert this code on method index() on
     * \App\Http\Controllers\ProductController.php
     */

    /**
     * Listing all products
     *
     * @OA\Get(
     *   path="/products",
     *   tags={"crud"},
     *   @OA\Response(
     *     response=200,
     *     description="Response success",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="success",
     *           type="bool",
     *           example="true"
     *         ),
     *         @OA\Property(
     *           property="data",
     *           type="array",
     *           @OA\Items(ref="App\Types\BaseResponse")
     *         ),
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="sucesso"
     *         ),
     *         @OA\Property(
     *           property="status",
     *           type="string",
     *           example="active"
     *         ),
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     *
     * @return array
     */
    public function index()
    {
        return response()->json(new BaseResponse(Product::paginate(100)));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    /**
     * get one products
     *
     * @OA\Get(
     *   path="/products/{code}",
     *   tags={"crud"},
     *   @OA\Parameter(
     *     name="code",
     *     in="path",
     *     required=true,
     *     description="Identification of code",
     *     example=0000000,
     *     @OA\Schema(
     *       type="integer"
     *     )
     * ),
     *   @OA\Response(
     *     response=200,
     *     description="Response success",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="success",
     *           type="bool",
     *           example="true"
     *         ),
     *         @OA\Property(
     *           property="data",
     *           type="array",
     *           @OA\Items(ref="App\Types\BaseResponse")
     *         ),
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="sucesso"
     *         ),
     *         @OA\Property(
     *           property="status",
     *           type="string",
     *           example="active"
     *         ),
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     *
     * @return array
     */
    public function show($code)
    {
        $product = Product::where('code', '=', $code)->get();
        if ($product) {
            return response()->json(new BaseResponse($product));
        }
        return response()->json(new BaseResponse(null, false, 'Produto não encontrado'));
    }

    public function showList()
    {
        $product = new OpenFoodFactsService;
        if ($product->getList()) {
            return response()->json($product->getList());
        }
        return response()->json(new BaseResponse(null, false, 'Produto não encontrado'));
    }

    public function edit(Product $product)
    {
        //
    }

    /**
     * put one products
     *
     * @OA\Put(
     *   path="/products/{code}",
     *   tags={"crud"},
     *   @OA\Parameter(
     *     name="code",
     *     in="path",
     *     required=true,
     *     description="Identification of code",
     *     example=0000000,
     *     @OA\Schema(
     *       type="integer"
     *     )
     * ),
     *   @OA\Response(
     *     response=200,
     *     description="Response success",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="success",
     *           type="bool",
     *           example="true"
     *         ),
     *         @OA\Property(
     *           property="data",
     *           type="array",
     *           @OA\Items(ref="App\Types\BaseResponse")
     *         ),
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="sucesso"
     *         ),
     *         @OA\Property(
     *           property="status",
     *           type="string",
     *           example="active"
     *         ),
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   ),
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="url",
     *                  type="string",
     *                  description="url.",
     *                  example="http://world-en.openfood…t/8718215090328/katharos"
     *              ),
     *          @OA\Property(
     *                  property="creator",
     *                  type="string",
     *                  description="creator kiliweb",
     *                  example="kiliweb"
     *              ),
     *          @OA\Property(
     *                  property="product_name",
     *                  type="string",
     *                  description="name product",
     *                  example="Katharos"
     *              ),
     *          @OA\Property(
     *                  property="labels",
     *                  type="string",
     *                  description="name labels",
     *                  example="en:gluten-free"
     *              ),
     *          @OA\Property(
     *                  property="labels_en",
     *                  type="string",
     *                  description="date creator",
     *                  example="Gluten-free"
     *              )
     *          )
     *      )
     *  )
     *   
     * )
     *
     * @return array
     */
    public function update(Product $product, $code)
    {
        $product = Product::where('code', '=', $code)->update([$product]);
        if ($product) {
            return response()->json(new BaseResponse(Product::where('code', '=', $code)->get()));
        }
    }
    /**
     * Delete one products
     *
     * @OA\Delete(
     *   path="/products/{code}",
     *   tags={"crud"},
     *   @OA\Parameter(
     *     name="code",
     *     in="path",
     *     required=true,
     *     description="Identification of code",
     *     example=0000000,
     *     @OA\Schema(
     *       type="integer"
     *     )
     * ),
     *   @OA\Response(
     *     response=200,
     *     description="Response success",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="success",
     *           type="bool",
     *           example="true"
     *         ),
     *         @OA\Property(
     *           property="data",
     *           type="array",
     *           @OA\Items(ref="App\Types\BaseResponse")
     *         ),
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="sucesso"
     *         ),
     *         @OA\Property(
     *           property="status",
     *           type="string",
     *           example="active"
     *         ),
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     *
     * @return array
     */
    public function destroy($code)
    {
        $product = Product::where('code', '=', $code)->update(['status'=>'trash']);
        if ($product) {
            return response()->json(new BaseResponse(Product::where('code', '=', $code)->get()));
        }
    }
}
