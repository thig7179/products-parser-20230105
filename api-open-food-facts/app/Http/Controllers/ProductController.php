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
     * Listing all resources
     *
     * @OA\Get(
     *   path="/api/products",
     *   tags={"crud"},
     *   @OA\Response(
     *     response=200,
     *     description="Response success",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="Successful action!"
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


    public function update(Product $product, $code)
    {
        $product = Product::where('code', '=', $code)->update([$product]);
        if ($product) {
            return response()->json(new BaseResponse(Product::where('code', '=', $code)->get()));
        }
    }

    public function destroy($code)
    {
        $product = Product::where('code', '=', $code)->update(['status'=>'trash']);
        if ($product) {
            return response()->json(new BaseResponse(Product::where('code', '=', $code)->get()));
        }
    }
}
