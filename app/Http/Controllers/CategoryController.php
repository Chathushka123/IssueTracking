<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Validators\CategoryCommonValidator;


class CategoryController extends Controller
{
        // Create New Category  
        public function createCategory(Request $request){
            DB::beginTransaction();
    
            try{
                // Validate Category
                $validator = Validator::make(
                    $request->all(),
                    CategoryCommonValidator::getCommonRules()
                );
                if ($validator->fails()) {
                    throw new Exception($validator->errors());
                }
    
                $category = Category::create($request->all());
                DB::commit();
                return response()->json(['status'=>'success','data'=>$category],200);
            }catch (Exception $e) {
                DB::rollBack();
                throw new \App\Exceptions\GeneralException($e->getMessage());
            }
    
        }
    
}
