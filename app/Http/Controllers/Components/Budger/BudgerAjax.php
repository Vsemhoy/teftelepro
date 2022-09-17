<?php
namespace App\Http\Controllers\Components\Budger;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Objects\SidemenuItem;
use App\Http\Controllers\Base\Input;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;



class BudgerAjax extends BaseController
{   

  
  public function ajaxcall(Request $request)
  {
    //return "HELLO DADDY!";
    //return $_SESSION['LoggedUser'];
    if (empty($request->code))
    {
      return "WRONG CODE NUMBER";
    }
    $user = User::where('id', '=', session('LoggedUser'))->first();

    $code = $request->code;
    $format = $request->format; // can be number, text  or json
    $json =  file_get_contents('php://input');
    $data = json_decode($json);
  

    if ($user == null || empty($user)) // 
    {
      if ($format == "plain"){
        return -1;
      } 
      elseif ($format == "text")
      {
        return "There is no access to user data:( Check this case";
      }
      return false;
    }
    //return $data->name;
   //return $_REQUEST['code'];

    /// ------- CREATE NEW ITEMS ------------ ///
    if ($code == 100)
    {
      // returns plain integer of item ID
      return self::saveNewCategoryGroup($data, $user);
    }
    elseif ($code == 101)
    {
      // returns plain integer of item ID
      return self::saveNewCategory($data, $user);
    }
    
    /// ------- ENDOF CREATE NEW ITEMS ------------ ///



    /// ------- REORDER ITEMS ------------ ///
    if ($code == 120){
      // returns number -1 if not success, 1 if success
      return self::reorderCategoriesInRow($data, $user);
    }
    

    if ($code == 121){
      // returns number -1 if not success, 1 if success
      return self::reorderGroups($data, $user);
    }
    
    /// ------- ENDOF REORDER ITEMS ------------ ///


    if ($code == 130){
      // returns number -1 if not success, 1 if success
      return self::renameCategoryGroup($data, $user);
    }
    if ($code == 131){
      // returns number -1 if not success, 1 if success
      return self::renameCategory($data, $user);
    }


    /// ------- REMOVE ITEMS ------------ ///
    if ($code == 191) // remove category item
    {
      // returns number -1 if not success, 1 if success
      return self::removeCategoryItem($data, $user);
    }


    if ($code == 192) // archieve category item
    {
      // returns number -1 if not success, 1 if success
      return self::archieveCategoryItem($data, $user);
    }


    if ($code == 190) // restore category Item
    {
      // returns number -1 if not success, 1 if success
      return self::restoreCategoryItem($data, $user);
    }


    if ($code == 193) // restore category Item
    {
      // returns number -1 if not success, 1 if success
      return self::removeGroup($data, $user);
    }
    /// ------- ENDOF REMOVE ITEMS ------------ ///


    /// ------- CREATE NEW ITEMS ------------ ///



    /// ------- CREATE NEW ITEMS ------------ ///

  }

  /// CODE 100
  public static function  saveNewCategoryGroup($json, $user)
  {
    $name = Input::filterMe("STRING", $json->name );
    $newId = DB::table(env('TB_BUD_GROUPS'))->insertGetId(
      ['name' => $name,
      'user' => $user->id,
      'type' => '2'
      ]
    );
    return $newId;
  }
  
  // CODE 101
  public static function  saveNewCategory($json, $user)
  {
    $name   = Input::filterMe("STRING", $json->name, 64 );
    $group  = Input::filterMe("INT", $json->group );
    $type   = Input::filterMe("INT", $json->type );
    $archieved  =  Input::filterMe("INT", $json->archieved );


    $newId  = DB::table(env('TB_BUD_CATEGORIES'))->insertGetId(
      ['name' => $name,
      'user' => $user->id,
      'type' => $type,
      'archieved' => $archieved, 
      'grouper'  => $group
      ]
    );
    return $newId; 
  }

  // CODE 120
  public static function  reorderCategoriesInRow($json, $user)
  {
    //return($json[0]);
    //return "MOVED! catinrow ";
    $affected;
    if (count($json) > 0)
    {
      foreach ($json AS $data){
        $name       = Input::filterMe("STRING", $data->name, 64 );
        $group      = Input::filterMe("INT", $data->group );
        $type       = Input::filterMe("INT", $data->type );
        $id         = Input::filterMe("INT", $data->id );
        $order         = Input::filterMe("INT", $data->order );
        $archieved  = Input::filterMe("INT", $data->archieved );

        $affected = DB::table(env('TB_BUD_CATEGORIES'))
        ->where('id', $id)
        ->where('user', $user->id)
        ->update([
            'name' => $name,
            'type' => $type,
            'ordered' => $order,
            'grouper' => $group,
            'archieved' => $archieved
        ]);
      }
    }
    if (!empty($affected)){
      return 1;
    } else {
      return 0;
    }
  }
  // CODE 121
  public static function  reorderGroups($json, $user)
  {
    //return($json);
    $affected;
    if (count($json) > 0)
    {
      foreach ($json AS $data){
       // $name       = Input::filterMe("STRING", $data->name, 64 );
        $type       = Input::filterMe("INT", $data->type );
        $id         = Input::filterMe("INT", $data->id );
        $order      = Input::filterMe("INT", $data->order );
        $archieved  = Input::filterMe("INT", $data->archieved );

        $affected = DB::table(env('TB_BUD_GROUPS'))
        ->where('id', $id)
        ->where('user', $user->id)
        ->update([
            'type' => $type,
            'ordered' => $order,
            'archieved' => $archieved
        ]);
      }
    }
    if (!empty($affected)){
      return 1;
    } else {
      return 0;
    }
  }




  // CODE 130
  public static function  renameCategoryGroup($json, $user)
  {
    //return($user->id);
    $id   = Input::filterMe("INT", $json->id );
    $name = Input::filterMe("STRING", $json->name, 64 );
    $color = Input::filterMe("STRING", $json->color, 12 );
    $type = Input::filterMe("INT", $json->type );
    $archieved = Input::filterMe("INT", $json->archieved );
    if ($name == ""){ $name = "empty name";};
    $affected = DB::table(env('TB_BUD_GROUPS'))
    ->where('id', $id)
    ->where('user', $user->id)
    ->update([
        'name'          => $name,
        'color'         => $color,
        'type'          => $type,
        'archieved'  => $archieved
    ]);
    if (!empty($affected)){
      return 1;
    } else {
      return 0;
    }
  }

  // CODE 131
  public static function  renameCategory($json, $user)
  {
    //return($user->id);
    $id   = Input::filterMe("INT", $json->id );
    $name = Input::filterMe("STRING", $json->name, 64 );
    if ($name == ""){ $name = "empty name";};
    //return($name);
      $affected = DB::table(env('TB_BUD_CATEGORIES'))
      ->where('id', $id)
      ->where('user', $user->id)
      ->update([
          'name' => $name //, 'type' => '2', 'ordered' => '1' //, 'grouper' => '1' 
      ]);
      
      return $affected;
      if (!empty($affected)){
        return 1;
      } else {
        return 0;
      }
  }


  public static function  removeCategoryItem($json, $user)
  {
    $id   = Input::filterMe("INT", $json->id );
    $item = DB::table(env('TB_BUD_EVENTS'))->where('category', $id)->where('user', '=', $user->id )->first();
    // Check if there any attached events. If not, remove;
    if (!empty($item)){
      return 0;
    }
    else {
      $deleted = DB::table(env('TB_BUD_CATEGORIES'))->where('id', '=', $id )->where('user', '=', $user->id )->delete();
      return 1;
    }
  }

  public static function  archieveCategoryItem($json, $user)
  {
    return "ARCHIEVED ITEM FROM JAX!";
    // Check if there any attached events. If not, remove;
  }

  public static function  restoreCategoryItem($json, $user)
  {
    return "RESTORED TOT!";
    // Check if there any attached events. If not, remove;
  }

  // CODE 193
  public static function  removeGroup($json, $user)
  {
    $id   = Input::filterMe("INT", $json->id );
    $item = DB::table(env('TB_BUD_CATEGORIES'))->where('grouper', $id)->where('user', '=', $user->id )->first();
    // Check if there any attached events. If not, remove;
    if (!empty($item)){
      return 0;
    }
    else {
      $deleted = DB::table(env('TB_BUD_GROUPS'))->where('id', '=', $id )->where('user', '=', $user->id )->delete();
      return 1;
    }
  }
}
