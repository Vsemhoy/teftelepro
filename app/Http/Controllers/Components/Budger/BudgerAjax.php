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
    if ($code == 201){
      // returns number -1 if not success, 1 if success
      return self::reorderCategoriesInRow($data, $user);
    }
    
    
    /// ------- ENDOF REORDER ITEMS ------------ ///



    /// ------- REMOVE ITEMS ------------ ///
    if ($code == 901) // remove category item
    {
      // returns number -1 if not success, 1 if success
      return self::removeCategoryItem($data, $user);
    }


    if ($code == 911) // archieve category item
    {
      // returns number -1 if not success, 1 if success
      return self::archieveCategoryItem($data, $user);
    }


    if ($code == 910) // restore category Item
    {
      // returns number -1 if not success, 1 if success
      return self::restoreCategoryItem($data, $user);
    }
    /// ------- ENDOF REMOVE ITEMS ------------ ///


    /// ------- CREATE NEW ITEMS ------------ ///



    /// ------- CREATE NEW ITEMS ------------ ///

  }

  
  public static function  saveNewCategoryGroup($json, $user)
  {
    return rand(1000000,32000000);
  }
  
  public static function  saveNewCategory($json, $user)
  {
    return rand(1000000,32000000);
    
  }

  public static function  reorderCategoriesInRow($json, $user)
  {
    //return($json[0]);
    return "MOVED!";
    return rand(1000000,32000000);
    
  }

  public static function  removeCategoryItem($json, $user)
  {
    return "REMOVED!";
    // Check if there any attached events. If not, remove;
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
}
