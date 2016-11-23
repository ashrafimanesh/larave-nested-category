<?php
/**
 * Created by PhpStorm.
 * User: ashrafi
 * Date: 11/12/16
 * Time: 10:10 AM
 */

namespace Ashrafi\NestedCategories;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Support\Facades\Route;

class NestedCategoriesController extends Controller
{
    const ROUTE='nestedCategories';
    public function index(Request $request){
        echo 'hello to package';
        die;
        dd(NestedCategory::create(['title'=>'digital']));
    }

    public function create(Request $request){

        //redirect back inputs
        $old = $request->old();
        //redirect back action result
        $action_result = $request->old('action_result');
        //form url
        $route=url(self::ROUTE);

        $treeList=NestedCategory::buildTreeList(NestedCategory::nodes());

        //parent ids
        return view('NestedCategories::create',compact('old','action_result','route','treeList'));
    }

    /**
     * store category to database
     * @param Request $request
     */
    public function store(Request $request){

        //validate input
        $validator=Validator::make($request->all(),[
            'title'=>'required|unique:categories|max:255',
            'parent_id'=>'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
                ->withInput(['old'=>$request->all()]);
        }
        //save category
        $title=$request->input('title');
        $parent_id=$request->input(['parent_id']);
        $status=$request->input(['parent_id']);
        $parentAddress=NestedCategory::getParentAddresses($parent_id);
        if($parentAddress){
            $parent_addresses=implode(NestedCategory::Delimiter,$parentAddress).NestedCategory::Delimiter.$parent_id;
        }
        else{
            $parent_addresses=$parent_id;
        }
        NestedCategory::create(compact('title','parent_addresses','status'));
        //redirect
        return redirect()->back()->withInput(['action_result'=>['status'=>true,'messages'=>[]]]);
    }

    public function edit(Request $request,$id){

    }

    public function update(Request $request){

    }



}