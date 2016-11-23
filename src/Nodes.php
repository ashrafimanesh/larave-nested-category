<?php
namespace Ashrafi\NestedCategories;
/**
 * Created by PhpStorm.
 * User: ashrafimanesh
 * Date: 11/22/16
 * Time: 8:13 AM
 */
class Node
{
    protected $children=[],$self=null,$parent=null;

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }

    public function addChild(Node $child){
        $this->children[]=$child;
    }

    public function hasChild(){
        return sizeof($this->children);
    }

    /**
     * @return null
     */
    public function getSelf()
    {
        return $this->self;
    }

    /**
     * @param null $self
     */
    public function setSelf(NestedCategory $self)
    {
        $this->self = $self;
    }

    public function setParent(Node $parent=null){
        $this->parent=$parent;
    }

    public function getParent(){
        return $this->parent;
    }

    public function getParentTitle(){
        return $this->getParent()->getSelf() ? $this->getParent()->getSelf()->title : '';
    }

}

class Nodes{

    protected static $nodes=[];

    public static function add($index){
        self::$nodes[$index]=new Node();
        return self::$nodes[$index];
    }

    public static function getAll(){
        return self::$nodes;
    }

    public static function get($index){
        return isset(self::$nodes[$index]) ? self::$nodes[$index] : null;
    }

    public static function exist($index){
        return isset(self::$nodes[$index]);
    }

    public static function buildTreeList($nodes,$delimiter='-',&$list=[]){
        foreach($nodes as $node){
            $self=$node->getSelf();
            $parent=$node->getParent();

            $list[$self->id]=new \stdClass();
            $list[$self->id]->id=$self->id;
            $list[$self->id]->title=($parent->getSelf() && isset($list[$parent->getSelf()->id]) ? $list[$parent->getSelf()->id]->title.$delimiter : '').$self->title;

            if($node->hasChild()){
                self::buildTreeList($node->getChildren(),$delimiter,$list);
            }
        }
    }
}