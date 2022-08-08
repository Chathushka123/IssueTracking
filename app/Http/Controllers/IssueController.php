<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\Category;
use App\Models\Subcategory;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Validators\IssueCreateValidator;
// use App\Http\Validators\IssueUpdateValidator;
use App\Http\Validators\ImageCommonValidator;
use App\Http\Validators\CommentCommonValidator;
use App\Http\Resources\IssueResource;

class IssueController extends Controller
{
    public function getIssue(){
        return IssueResource::collection(Issues::paginate(25));
    }


    // Create New Issue  
    public function createRec(Request $request){
        DB::beginTransaction();

        try{
            // Validate Issue
            $validator = Validator::make(
                $request->all(),
                IssueCreateValidator::getCreateRules()
            );
            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            $issue = Issue::create($request->all());
            DB::commit();
            return response()->json(['status'=>'success','data'=>$issue],201);
        }catch (Exception $e) {
            DB::rollBack();
            throw new \App\Exceptions\GeneralException($e->getMessage());
        }

    }

    // Add Issue Image
    public function addIssueImage(Request $request){
        DB::beginTransaction();
        try{

            if(!isset($request->issue_id)){
                throw new Exception('issue_id required');
            }
            $issue = Issue::find($request->issue_id);
            if(is_null($issue)){
                throw new Exception('The issue is not found');
            }

            $image_data = [
                'size' => $request->size,
                'path' => $request->path,
                'name' => $request->name,
                'extention' => $request->extention
            ];
            // Validate Issue Image
            $validator = Validator::make(
                $image_data,
                ImageCommonValidator::getCommonRules()
            );
            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            $issue->image()->create($image_data);            
            DB::commit();
            return response()->json(['status'=>'success','data'=>$issue->image],201);
        }catch (Exception $e) {
            DB::rollBack();
            throw new \App\Exceptions\GeneralException($e->getMessage());
        }
    }

    // Get Issue By Uuid
    public function  getIssueByUuid($uuid){
        try{
            $issue = Issue::select('*')
                    ->where('uuid' ,$uuid)
                    ->first();

            if(is_null($issue)){
                return response()->json(['message'=>"Issue Not Found"],404);
            }
            return response()->json(['status'=>'success','data'=>$issue],200);
        }catch (Exception $e) {
            throw new \App\Exceptions\GeneralException($e->getMessage());
        }
    }

    // Get Issue by categoryId
    public function getIssueByCategory($categoryId){
        try{

            $issue = Category::find($categoryId)->issue()->get();
            return response()->json(['status'=>'success','data'=>$issue],200);

        }catch (Exception $e) {
            throw new \App\Exceptions\GeneralException($e->getMessage());
        }
    }

    // Get Issue by SubcategoryId
    public function getIssueBySubcategory($subcategoryId){
        try{

            $issue = Subcategory::find($subcategoryId)->issue()->get();
            return response()->json(['status'=>'success','data'=>$issue],200);

        }catch (Exception $e) {
            throw new \App\Exceptions\GeneralException($e->getMessage());
        }
    }

    // Add Comment to an Issue
    public function addIssueComment(Request $request){
        try{

            $issue = Issue::find($request->issue_id);
            if(is_null($issue)){
                throw new Exception('The issue is not found');
            }
            $comment_data = [
                'body'=>$request->body
            ];
            // validate comment
            $validator = Validator::make(
                $comment_data,
                CommentCommonValidator::getCommonRules()
            );
            if ($validator->fails($comment_data)) {
                throw new Exception($validator->errors());
            }

            $issue->comments()->create($comment_data);
            return response()->json(['status'=>'success','data'=>$issue],200);

        }catch (Exception $e) {
            throw new \App\Exceptions\GeneralException($e->getMessage());
        }
    }
}
