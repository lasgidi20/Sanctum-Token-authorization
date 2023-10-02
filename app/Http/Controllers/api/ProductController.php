<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
   public function index()
   {
     $products = Product::all();

     return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
   }

   public function store(Request $request) {
      $input = $request->all();

      $validator = Validator::make($input,[
        'name' => 'required',
        'detail' => 'required'
      ]);

      if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
      }
      
      $product = Product::create($input);
   
      return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
   }

   public function show($id)
   {
      $product = Product::find($id);
      
      if (is_null($product)) {
        return $this->sendErrror('Product not found.');
      }

      return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
   }

   public function update(Request $request)
   {
      $input = $request->all();

      $validator = Validator::make($input, [
          'name' => 'required',
          'detail' => 'required'
      ]);

      if($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors());  
      }

      $product->name = $input['name'];
      $product->detail = $input['detail'];
      $product->save();

      return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
   }

   public function destroy(Product $product)
   {
       $product->delete();
  
       return $this->sendResponse([], 'Product deleted successfully.');
   }
}
