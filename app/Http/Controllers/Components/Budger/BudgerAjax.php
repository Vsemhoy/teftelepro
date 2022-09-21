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


    if ($code == 193) // remove group of category Items
    {
      // returns number -1 if not success, 1 if success
      return self::removeGroup($data, $user);
    }

    if ($code == 290) // restore category Item
    {
      // returns number -1 if not success, 1 if success
      return self::removeAccount($data, $user);
    }




    /// ------- ENDOF REMOVE ITEMS ------------ ///


    /// ------- CREATE NEW ITEMS ------------ ///



    /// ------- CREATE NEW ITEMS ------------ ///


    /// ------- LOAD ACC ITEMS ------------ ///
    if ($code = 250)
    {
      // load one account data and fill it to the form
      return self::loadAccountData($data, $user);
    }

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
        $order      = Input::filterMe("INT", $data->order );
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


  // Code about 190 +
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
    $id   = Input::filterMe("INT", $json->id );
    $affected = DB::table(env('TB_BUD_CATEGORIES'))
    ->where('id', $id)
    ->where('user', $user->id)
    ->update([
        'archieved' => '1'//, 'type' => '2', 'ordered' => '1' //, 'grouper' => '1' 
    ]);
    if (!empty($affected)){
      return 1;
    } else {
      return 0;
    }
  }

  public static function  restoreCategoryItem($json, $user)
  {
    r    $id   = Input::filterMe("INT", $json->id );
    $affected = DB::table(env('TB_BUD_CATEGORIES'))
    ->where('id', $id)
    ->where('user', $user->id)
    ->update([
        'archieved' => '1'//, 'type' => '2', 'ordered' => '1' //, 'grouper' => '1' 
    ]);
    if (!empty($affected)){
      return 1;
    } else {
      return 0;
    }
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

  // CODE 250
  public static function loadAccountData($json, $user)
  {
    $id = Input::filterMe("INT", $json->id );
    if ($id == 0)
    { return -1;}
    $item = DB::table(env('TB_BUD_ACCOUNTS'))->where('id', '=', $id )->where('user', '=', $user->id )->first();
    return json_encode($item);
  }






/// ----------------------- CODE 200 ------------------------
/// ACC MANAGE ------------- ACC ------------------ ACC


public static function  saveNewAccount($json, $user)
{
  $dec   = Input::filterMe("INT", $json->decimals );
  $name = Input::filterMe("STRING", $json->name, 64 );
  $descr = Input::filterMe("STRING", $json->description, 256 );
  $type = Input::filterMe("INT", $json->type );
  $currency = Input::filterMe("INT", $json->currency );
  $archieved = Input::filterMe("INT", $json->archieved );
  $notshow = Input::filterMe("INT", $json->notshow );


  $newId  = DB::table(env('TB_BUD_CATEGORIES'))->insertGetId(
    [
      'name'         => $name,
      'description'  => $descr,
      'type'         => $type,
      'currency'     => $currency,
      'decimals'     => $dec,
      'archieved'    => $archieved,
      'notshow'      => $notshow
    ]
  );
  return $newId; 
}


  // CODE 230
  public static function  updateAccountInfo($json, $user)
  {
    $id   = Input::filterMe("INT", $json->id );
    $dec   = Input::filterMe("INT", $json->decimals );
    $name = Input::filterMe("STRING", $json->name, 64 );
    $descr = Input::filterMe("STRING", $json->description, 256 );
    $type = Input::filterMe("INT", $json->type );
    $currency = Input::filterMe("INT", $json->currency );
    $archieved = Input::filterMe("INT", $json->archieved );
    $notshow = Input::filterMe("INT", $json->notshow );
    if ($name == ""){ $name = "empty name";};
    $affected = DB::table(env('TB_BUD_ACCOUNTS'))
    ->where('id', $id)
    ->where('user', $user->id)
    ->update([
        'name'         => $name,
        'description'  => $descr,
        'type'         => $type,
        'currency'     => $currency,
        'decimals'     => $dec,
        'archieved'    => $archieved,
        'notshow'      => $notshow
    ]);
    if (!empty($affected)){
      return 1;
    } else {
      return 0;
    }
  }



  // CODE 290
  public static function removeAccount($json, $user)
  {
    $id   = Input::filterMe("INT", $json->id );
    $item = DB::table(env('TB_BUD_EVENTS'))->where('account', $id)->where('user', '=', $user->id )->first();
    // Check if there any attached events. If not, remove;
    if (!empty($item)){
      return 0;
    }
    else {
      $deleted = DB::table(env('TB_BUD_ACCOUNTS'))->where('id', '=', $id )->where('user', '=', $user->id )->delete();
      return 1;
    }
  }

}
