<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Issue;
use App\Models\CategoryIssue;
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

        public function createCategoryIssueByCategory(Request $request){
            DB::beginTransaction();
            try{
                
                $category = Category::find($request->category_id);
                if(is_null($category)){
                    throw new Exception("The category Not Found");
                }
                if(is_null($request->issue_id)){
                    throw new Exception("The issue_id Can't be Empty");
                }
                // validate mapping 
                $categoryIssue = DB::table('category_issue')
                ->select('category_issue.id')
                ->where('category_issue.issue_id' ,$request->issue_id)
                ->where('category_issue.category_id' ,$request->category_id)
                ->first();

                if(!is_null($categoryIssue)){
                    throw new Exception("Mapping Already Exist");
                }

                $issue = Issue::find($request->issue_id);
                
                $category->issue()->attach($issue);

                DB::commit();
                return response()->json(['status'=>'success','data'=>$category->issue],200);
            }catch (Exception $e) {
                DB::rollBack();
                throw new \App\Exceptions\GeneralException($e->getMessage());
            }
        }
    
}
