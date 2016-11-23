<?php
namespace Ashrafi\NestedCategories;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: ashrafimanesh
 * Date: 11/20/16
 * Time: 9:32 PM
 */
class NestedCategory extends Model
{
    const Delimiter=',';
    protected $table='categories';
    protected $fillable=['title','parent_addresses','status'];


    public static function checkDuplicate($title){
        return self::where('title',$title)->count();
    }

    public static function getParentAddresses($id=0){
        if(!$id){
            return null;
        }

        $parent=self::find($id);
        if($parent instanceof NestedCategory){
            return explode(self::Delimiter,$parent->parent_addresses);
        }
        return null;
    }

    public static function nodes(){

        $rows=NestedCategory::orderBy('id','asc')->get();
        foreach($rows as $category){
            $node=Nodes::add($category->id);
            $node->setSelf($category);

            $parentAddress=explode(self::Delimiter,$category->parent_addresses);
            $pId=$parentAddress[sizeof($parentAddress)-1];
            if(!Nodes::exist($pId)){
                $parentNode=Nodes::add($pId);
            }
            else{
                $parentNode=Nodes::get($pId);
            }
            $node->setParent($parentNode);
            $parentNode->addChild($node);
        }
        $nodes=Nodes::getAll();

        return isset($nodes[0]) ? $nodes[0]->getChildren() : [];
    }

    public static function buildTreeList($nodes){
        $result=[];
        Nodes::buildTreeList($nodes,self::Delimiter,$result);
        return $result;
    }

}
