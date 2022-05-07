<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{

   public static function tree(){

    $allMenus = MenuItem::get();
    $rootMenus = $allMenus->whereNull('parent_id') ;

    
    self::formatTree($rootMenus, $allMenus);

    return $rootMenus ;

   }


   // recursive function for ammending children menus 
   private static function formatTree($menus,$allMenus){


    foreach($menus as $menu){ 
        $menu->children = $allMenus->where('parent_id',$menu->id)->values();
       
       if($menu->children->isNotEmpty()){
            self::formatTree($menu->children, $allMenus) ; 
        }
      
    }

    
    

   }

}
