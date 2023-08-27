<?php
/*
Plugin Name: Sawyan User
Description: Edit User Order for request Shaping
Version: 1.6
Author: Hatem Amir
Author URI: https://www.facebook.com/hatem.amir.14
Email: amirhatem549@gmail.com
License: GPL2
*/

if ( ! defined( 'ABSPATH' ) ){
  die;
}


add_action('admin_menu', 'SawyanUserAdminPage');
function SawyanUserAdminPage() {
	add_menu_page(
		'Hatem E47nly',
		'Hatem E47nly',
		'manage_options',
		'Sawyan-User',
		'Sawyan_User_admin_page',//Call Back Function

	);
	add_submenu_page('Sawyan-User', 'Add New User', 'Add New', 'manage_options', 'Sawyan-User-Add', 'Sawyan_User_add_page');

	// add_submenu_page('Sawyan-User', 'Show Settings', 'Show', 'manage_options', 'Sawyan-User-Show', 'Sawyan-User_Show_page');
}


//==============================Start Admin Page ========================================//

function Sawyan_User_admin_page(){
  global $wpdb;
  $table_name ='Sawyan_user';
	$results 	= $wpdb->get_results("SELECT * FROM $table_name" );


  $Results = $wpdb ->get_results("SELECT * FROM wp40_postmeta WHERE (meta_key='Hatem-ref-Value-for-shipping') ");
  $Results = json_decode(json_encode($Results),true);
  $hatem_ref_value = $Results[0]['meta_value'];



?>
  <style>
    .Hatem-Tabel{
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 20px;

    }
    .Hatem-Tabel table{
      width: 40%;
      color: white;
      background-color: #082241;
      position: relative;
    }
    .Hatem-Tabel th{
      font-size: 20px;
      font-weight: 600;
      padding: 10px;

    }
    .Hatem-Tabel td{
      font-size: 18px;
    /* position: relative; */
    left: 50%;
    /* transform: translate(-50%); */
    /* display: flex; */
    /* flex-direction: revert; */
    text-align: center;
    padding: 10px;
    }
    .Hatem-Tabel tr{
      outline: 1px solid white;
      line-height: 1.3;
      /* display: none ; */
    }
    .Tabel-head{
      display:table-row !important;
    }
    .Hatem-Remove{
      font-weight: 900;
      cursor: pointer;
      font-size: 20px;
      }
      .Hatem-Remove:hover{
        color: lightgray;
      }
      .Hatem-loading{
        width: 20%;
        background-color: #52EFDC;
        position:sticky;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 3%;
        font-size: 22px;
        border-radius: 20px;
        font-weight: 900;
        color: #082241;
      }
      input.Hatem-tabel-input {
    display: flex;
    flex-basis: auto;
    width: 60px;
    background-color: #082241;
    color: white;
    border: none;
    font-size: 16px;
}
th {
  background: white;
  position: sticky;
  top: 20px;
  margin-top: 60px;
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
  background-color: #082241 !important;
  z-index: 10;
}
.input-e7nly{
    display: flex;
    justify-content: space-between;
    padding: 15px;
}
  </style>


  <h2>Hatem E47nly Tabel</h2>
    <div class="input-e7nly">
      <div class="tabel-serch">
      <input type="text" class="hatem-serch-tabel" placeholder="Search for User ID" id="Hatem-Serach-tabel">
      <button class="button button-primary Hatem-Search">Search</button>
      </div>
      <div class="Ref-Value">
        <input type="text" class="hatem-ref-input" name="hatem-ref-input" placeholder="<?php echo $hatem_ref_value; ?>">
        <button class="button button-primary">Update</button><br>
        <label for="hatem-ref-input" style="font-size:18px; color:#082241; font-weight:bold; margin-bottom:5px;">R.V/Per KG</label>

      </div>
    </div>
    <?php


    ?>
    <script>
      (function($){
        $('.Hatem-Search').click(function(){
          let Serach_ID = $('#Hatem-Serach-tabel').val()

          // $('.Tabel-head').css('display','block');
          $(`tr`).css('display','none');
          $(`#${Serach_ID}`).parent().parent().css('display','table-row');

        });
      })(jQuery);
    </script>
  <div class="Hatem-Tabel">

  <table>
    <thead>
    <tr class="Tabel-head">
      <th>remove</th>
      <th>User ID</th>
      <th>Weight</th>
      <th>تعبئة وتغليف</th>
      <th>فحص ومطابقة المنتج</th>
      <th>رسوم المرتجع</th>
      <th>اتعاب المرتجع</th>
      <th>انتقالات داخلية</th>
      <th>اتعاب الانتقالات الداخلية</th>
      <th>أخري</th>
      <th>تفعيل</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $testHTML="";
    foreach($results as $result){

      if ($result ->Active ==1){
            echo "<tr id='$result->id'>
            <td><span class='Hatem-Remove'>x</span></td>
            <td><span id='$result->user_ID'>$result->user_ID</span></td>
            <td><input type='text' class='Hatem-tabel-input' name='user_weight' value='$result->user_weight'></td>
            <td><input type='text' class='Hatem-tabel-input' name='fee1' value='$result->fee1'></td>
            <td><input type='text' class='Hatem-tabel-input' name='fee2' value='$result->fee2'></td>
            <td><input type='text' class='Hatem-tabel-input' name='fee3' value='$result->fee3'></td>
            <td><input type='text' class='Hatem-tabel-input' name='fee4' value='$result->fee4'></td>
            <td><input type='text' class='Hatem-tabel-input' name='fee5' value='$result->fee5'></td>
            <td><input type='text' class='Hatem-tabel-input' name='fee6' value='$result->fee6'></td>
            <td><input type='text' class='Hatem-tabel-input' name='fee7' value='$result->fee7'></td>
            <td><input type='checkbox' checked
            class='Active_check'</td>
            </tr>";
      }else{
              echo "<tr id=$result->id>
            <td><span class='Hatem-Remove'>x</span></td>
            <td><span id='$result->user_ID'>$result->user_ID</span></td>
            <td><input type='text' class='Hatem-tabel-input' name='user_weight' value='$result->user_weight'> </td>
            <td><input type='text' class='Hatem-tabel-input' name='fee1' value='$result->fee1'> </td>
            <td><input type='text' class='Hatem-tabel-input' name='fee2' value='$result->fee2'> </td>
            <td><input type='text' class='Hatem-tabel-input' name='fee3' value='$result->fee3'> </td>
            <td><input type='text' class='Hatem-tabel-input' name='fee4' value='$result->fee4'> </td>
            <td><input type='text' class='Hatem-tabel-input' name='fee5' value='$result->fee5'> </td>
            <td><input type='text' class='Hatem-tabel-input' name='fee6' value='$result->fee6'> </td>
            <td><input type='text' class='Hatem-tabel-input' name='fee7' value='$result->fee7'> </td>
            <td><input type='checkbox'
            class='Active_check'</td>
            </tr>";
      }

          }
            ?>
    </tbody>
  </table>
  </div>
  <script>
    (function($){            //Change DataBase Value
      let id ="";
      let col_name;
      let new_val;
      $('.Hatem-tabel-input').focusout(function(){
        $('.Hatem-tabel-input').prop('disabled',true);
        $('.Hatem-Tabel').append('<div class="Hatem-loading"><span>Wait..</span></div>');
        id = $(this).parent().parent().attr('id');
        col_name =  $(this).attr('name') ;
        new_val = $(this).val();


      jQuery.ajax({
        url: '/wp-admin/admin-ajax.php',
        data: {
          'action': 'Hatem_change_database_value',
          'php_ID': id,
          'php_col_name': col_name,
          'php_new_val': new_val,
        },
        success: function(){
          location.reload();
        },
        error: function(){
          alert("SomeThing Went Wrong , Contact with your IT Team");
        }
      });
    });
    })(jQuery);

    (function($){                 //Change-ref-value For product 9113

      $('.hatem-ref-input').focusout(function(){
        $('.hatem-ref-input').prop('disabled',true);
        let value = $('.hatem-ref-input').val();
        console.log(value);
        $('.Hatem-Tabel').before('<div class="Hatem-loading"><span>Wait..</span></div>');
        jQuery.ajax({
        url: '/wp-admin/admin-ajax.php',
        data: {
          'action': 'Hatem_change_ref_value',
          'php_value': value

        },
        success: function(){
          location.reload();
        },
        error: function(){
          alert("SomeThing Went Wrong , Contact with your IT Team");
        }
      });
      });

    })(jQuery);

    (function($){              //For Active or Deactive Active_checkbox


      $('.Active_check').change(function(){
        $('.Hatem-Tabel').before('<div class="Hatem-loading"><span>Wait..</span></div>');
        let id="";
        let Value ="";
        id = $(this).parent().parent().attr('id');
        Value = $(this).prop('checked');

        if (Value){
          jQuery.ajax({
          url: '/wp-admin/admin-ajax.php',
          data: {
            'action': 'Hatem_Active_DataBase',
            'php_ID': id,
            'php_value': 1,
          },
          success: function(){
            location.reload();

          },error: function(){
            alert("SomeThing Went Wrong , Contact with your IT Team");
          }
          });
        }else{
          jQuery.ajax({
          url: '/wp-admin/admin-ajax.php',
          data: {
            'action': 'Hatem_Active_DataBase',
            'php_ID': id,
            'php_value': 0,
          },
          success: function(){
            location.reload();

          },error: function(){
            alert("SomeThing Went Wrong , Contact with your IT Team");
          }
          });
        }

        });

      let id;
      $('.Hatem-Remove').click(function(){           //For Delete Row (User_ID)
        id= $(this).parent().parent().attr('id');

        $('.Hatem-Tabel').append('<div class="Hatem-loading"><span>Wait..</span></div>');

        jQuery.ajax({
      // type: 'POST',
      url: '/wp-admin/admin-ajax.php',
      data: {
        'action': 'Hatem_Delete_DataBase',
        'php_ID': id
      },
      success:function(){
        // $('.Hatem-loading').remove();
        location.reload();
      },error:function(){
        alert("SomeThing Went Wrong , Contact with your IT Team");
      }

    });
      });

    })(jQuery);


</script>

<?php
}


//*********************************** Start Ajax *****************************//

add_action( 'wp_ajax_Hatem_change_ref_value','Hatem_change_ref_value' );

function Hatem_change_ref_value(){
  if(isset($_REQUEST)){
    $value="";
    $value= $_REQUEST['php_value'];
  }
  global $wpdb;
  $data = array(
    "meta_value"=>$value,

  );
  $table_name = "wp40_postmeta";

  $wpdb->update( $table_name,
    $data,
    array( 'meta_id' => 93804 )
  );


}


//---------------------------------------------------------------

add_action( 'wp_ajax_Hatem_change_database_value','Hatem_change_database_value' );

function Hatem_change_database_value(){
  global $wpdb;
  $ID ="";
  $col_name="";
  $new_val="";
  $oldValue="";
  if(isset($_REQUEST)){
      $ID = $_REQUEST['php_ID'];
      $col_name = $_REQUEST['php_col_name'];
      $new_val = $_REQUEST['php_new_val'];

      $table_name="Sawyan_user";
    $results =$wpdb -> get_results("SELECT * FROM $table_name WHERE id=$ID");
    foreach($results as $result){
      $oldValue =$result -> $col_name;
    }
    if($oldValue== $new_val){
      return;
    }

    $rlyValue = (float)$oldValue + (float)$new_val;

    $data = array(
      $col_name =>$rlyValue,

    );

    $wpdb->update( $table_name,
      $data,
      array( 'ID' => $ID )
    );
  }
}
//---------------------------------------------------------------

add_action('wp_ajax_Hatem_Delete_DataBase','Sawyan_User_Delete_Row' );

function Sawyan_User_Delete_Row(){
  if (isset($_REQUEST)){
    global $wpdb;
    $table_name="Sawyan_user";
    $ID = $_REQUEST['php_ID'];
      $wpdb->delete( $table_name, array( 'id' => $ID ) );
  }

}
//---------------------------------------------------------------
add_action('wp_ajax_Hatem_Active_DataBase','Hatem_Active_DataBase' );

function Hatem_Active_DataBase(){

  if (isset($_REQUEST)){
    global $wpdb;
    $table_name="Sawyan_user";
    $value=$_REQUEST['php_value'];
    $ID = $_REQUEST['php_ID'];
    global $wpdb;

		$data = array(
			'Active' => $value,
		);
    $Email="";

    $WP_ID_ROW = $wpdb ->get_results("SELECT * FROM $table_name Where (id=$ID) ");
    $WP_USER_ID="";
    foreach($WP_ID_ROW as $row){
      $USER__ID = $row->user_ID;
    }



    $tabel_name1 = 'wp40_users';
    $result = $wpdb ->get_results("SELECT * FROM $tabel_name1 WHERE id=$USER__ID" );
    foreach($result as $row){
      $Email = $row->user_email;
    }

    if($value){
    wp_mail($Email ,"Order","Sawyan Team \r\nطبلكم للشحن جاهز الان"); //$to:string|array, $subject:string, $message:string, $headers:string|array, $attachments:string|array
    // wp_mail("amirhatem549@gmail.com" ,"Order","Sawyan Team \r\nطبلكم للشحن جاهز الان\r\n$Email"); //$to:string|array, $subject:string, $message:string, $headers:string|array, $attachments:string|array
    }




		$wpdb->update( $table_name,
			$data,
			array( 'ID' => $ID )
		);
  }

}
//*********************************** End Ajax *****************************//

//==============================End Admin Page ========================================//




//==============================Start Sub Admin Page ========================================//


function Sawyan_User_add_page(){
  ?>
  <style>
    /* {
      height: 30%;
    } */
    .wrap{
      position: absolute;
    width: 30%;
    /* height: 20%; */
    margin-top: 70px;
    background-color: #082241;
    display: flex;
    justify-content: center;
    align-items: center;
    left: 50%;
    transform: translate(-50%);
    border-radius: 40px;
    color: white;
    padding: 10px;
    font-size: 20px;
    margin-bottom: 20% !important;
    padding-bottom: 30px;
    }
    .Hatm-add-new-order {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: auto;
    }
    .Hatm-add-new-order label{
      padding: 10px;
    }
    .Hatm-add-new-order input{
      position: relative;
      width: 80%;
      border-radius: 20px;
      height: 40px;
      font-size: 20px;
    }
    .Hatem-add-new-order input::placeholder{
      position: absolute;
      left: 50%;
      transform: translate(-50%);
    }
    /* .Hatm-add-new-order input:focus{
      border-color: #52EFDC;
      outline: 2px solid #52EFDC;
    } */
    #Saywan-User-add {
      width: 30%;
    border-radius: 20px;
    border-color: #52EFDC;
    outline: none !important;
    background-color: #52EFDC;
    border: none;
    font-size: 20px;
    font-weight: 601;
    cursor: pointer;

    }
    #Saywan-User-add:hover{
      background-color: #33BCAE;
      color:#082241;
    }

    .users-tabel{
      width: 100%;
      display: flex;
      justify-content: center;
      align-self: center;
      font-size: 16px;
    }
    .users-tabel tr{
      height: 60px;
      text-align: center;
      outline: 1px solid white !important;
    }
    .users-tabel td{
      padding: 5px;
    }
    .users-tabel th{
      padding: 5px;
    }
    table{

      border-color: white !important;
      background-color: #082241 !important;
      color: white !important;
    }
    .Hatem-loading{
      width: 20%;
    background-color: #52EFDC;
    position: fixed;
    /* top: -50%; */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60px;
    width: 50%;
    font-size: 22px;
    border-radius: 20px;
    font-weight: 900;
    color: #082241;
    }
    .fee-Holder {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    }

  </style>




<h2>Add New Order</h2>
  <!-- <div class="hatem-users-section">
  <div class="users-tabel">
    <table>
    <thead>
    <tr>
      <th>User ID</th>
      <th>User Name</th>
      <th>User gmail</th>
    </tr>
    </thead>
    <tbody>
      <?php
        // global $wpdb;

        // $tabel_name = 'wp40_users';
        // $result = $wpdb ->get_results("SELECT * FROM $tabel_name" );
        // foreach($result as $row){

        //   echo "<tr>
        //         <td>$row->ID </td>
        //         <td>$row->display_name </td>
        //         <td>$row->user_email </td>
        //         </tr>
        //         ";
        // }
      ?>
    </tbody>
    </table>


  </div>
  </div> -->
  <div class="wrap">
  <div class="Hatm-add-new-order">
  <label for="Sawyan_user_add_ID">ID:</label>
  <input type="text" id="Sawyan_user_add_ID" required><br><br>
  <label for="Sawyan_user_add_Weight">Weight:</label>
  <input type="text" id="Sawyan_user_add_Weight" required ><br><br>
  <div class="add-fee button button-primary" style="margin: 10px;">Add Fee</div>
  <div class="fee-Holder"></div>



  <button id="Saywan-User-add" >Add New User</button>
</div>
  </div>

  </div>

  <script>
    (function($){
      let counter=1;
      $('.add-fee').click(function(){
        $('.fee-Holder').append(  `<select name="new-fee" id="fee${counter}">
      <option value="اختر النوع">اختر النوع</option>
      <option value="تعبئة وتغليف">تعبئة وتغليف</option>
      <option value="فحص ومطابقة المنتج">فحص ومطابقة المنتج</option>
      <option value="رسوم المرتجع">رسوم المرتجع</option>
      <option value="اتعاب المرتجع">اتعاب المرتجع</option>
      <option value="انتقالات داخلية">انتقالات داخلية</option>
      <option value="اتعاب الانتقالات الداخلية">اتعاب الانتقالات الداخلية</option>
      <option value="أخرى">أخرى</option>
      </select>
      <input type="text" id="feeValue${counter}" placeholder="قيمتها" style="margin: 10px;">
      <p>************************************</p>`);
      counter++;
      });
      let fee1= "";
          let fee2= "";
          let fee3= "";
          let fee4= "";
          let fee5= "";
          let fee6= "";
          let fee7= "";

      $('#Saywan-User-add').click(function(){
        $('#Saywan-User-add').prop('disabled', true);
        $('.wrap').append('<span class="Hatem-loading">Wait..</span>');
        for(let i=counter-1; i>0; i--){

          if($(`#fee${i}`).val() == 'تعبئة وتغليف'){
            fee1 =  $(`#feeValue${i}`).val();
          }
          if($(`#fee${i}`).val() == 'فحص ومطابقة المنتج'){
            fee2 =  $(`#feeValue${i}`).val();
          }
          if($(`#fee${i}`).val() == 'رسوم المرتجع'){
            fee3 =  $(`#feeValue${i}`).val();
          }
          if($(`#fee${i}`).val() == 'اتعاب المرتجع'){
            fee4 =  $(`#feeValue${i}`).val();
          }
          if($(`#fee${i}`).val() == 'انتقالات داخلية'){
            fee5 =  $(`#feeValue${i}`).val();
          }
          if($(`#fee${i}`).val() == 'اتعاب الانتقالات الداخلية'){
            fee6=  $(`#feeValue${i}`).val();
          }
          if($(`#fee${i}`).val() == 'أخرى'){
            fee7=  $(`#feeValue${i}`).val();
          }
        }

        if ($('#Sawyan_user_add_ID')==""){
          alert("ID must be required")
        }else if($('#Sawyan_user_add_Weight')==""){
          alert("Weight must be required")
        }else{
          let NEWID =  $('#Sawyan_user_add_ID').val();
          let new_weight =$('#Sawyan_user_add_Weight').val();

          jQuery.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: {
              action: 'Hatem_User_add_new',
              php_new_Id: NEWID,
              php_new_Weight: new_weight,
              php_Fee1: fee1,
              php_Fee2: fee2,
              php_Fee3: fee3,
              php_Fee4: fee4,
              php_Fee5: fee5,
              php_Fee6: fee6,
              php_Fee7: fee7,
            },
            success:function(){
              location.reload();

            },
            error:function(){
              alert("SomeThing Went Wrong , Contact with your IT Team");
            }
          });
        }
      });

    })(jQuery);
  </script>

  <?php
}
//*********************************** Start Ajax *****************************//

add_action('wp_ajax_Hatem_User_add_new', 'Hatem_User_add_new');

function Hatem_User_add_new(){

  if(isset($_REQUEST)){
    global $wpdb;
    $table_name="Sawyan_user";
    $NEW_ID = $_REQUEST['php_new_Id'];
    $NEW_Weight = $_REQUEST['php_new_Weight'];
    $fee1 = $_REQUEST['php_Fee1'];
    $fee2 = $_REQUEST['php_Fee2'];
    $fee3 = $_REQUEST['php_Fee3'];
    $fee4 = $_REQUEST['php_Fee4'];
    $fee5 = $_REQUEST['php_Fee5'];
    $fee6 = $_REQUEST['php_Fee6'];
    $fee7 = $_REQUEST['php_Fee7'];
    global $wpdb;
    $Email="";
    $tabel_name = 'wp40_users';
    $result = $wpdb ->get_results("SELECT * FROM $tabel_name WHERE id=$NEW_ID" );
    foreach($result as $row){
      $Email = $row->user_email;
    }
    // $headers = array('Content-Type: text; charset=UTF-8','From: Sawyancom <AmirHatem@549@gmail.com>');
    // wp_mail($Email ,"Order","نحطكم علما بأنه تم استلام بضاعة بوزن $NEW_Weight\r\nو للتفاصيل يرجي التواصل معانا عبر الواتس اب"); //$to:string|array, $subject:string, $message:string, $headers:string|array, $attachments:string|array

    $wpdb->insert($table_name,array(
      "user_ID"=>$NEW_ID,
      "User_Weight"=>$NEW_Weight,
      "fee1"=>$fee1,
      "fee2"=>$fee2,
      "fee3"=>$fee3,
      "fee4"=>$fee4,
      "fee5"=>$fee5,
      "fee6"=>$fee6,
      "fee7"=>$fee7,
      ));
  }
  }


  //For Mail to Admin Start Shipping
  add_action("wp_ajax_hatem_send_email_start_shipping","hatem_send_email_start_shipping");

  function hatem_send_email_start_shipping(){
    if(isset($_REQUEST)){
      $Curent_UserID =  $_REQUEST['php_userID'];

      $to = "Amirhatem549@gmail.com";
      $to1 = "abdelhamiid.shawkat@gmail.com";
      $subject = "Order e47nly";
      $message = 'Active Weight For '. $Curent_UserID ;
      $sent = wp_mail($to, $subject, strip_tags($message));
      $sent1 = wp_mail($to1, $subject, strip_tags($message));
    }
  }
//*********************************** End Ajax *****************************//

//==============================End Sub Admin Page ========================================//



//==============================Start Edit For Product_ID_9113 خدمة اشحنلي ========================================//


  add_action('wp_footer','Sawyan_User_set_product_id_9113_weight',999 );


  function Sawyan_User_set_product_id_9113_weight(){
    global $wpdb;
    $user_ID = get_current_user_id();
    $table_name =  'Sawyan_user';
    $results 	= $wpdb->get_results("SELECT * FROM $table_name where (user_ID = $user_ID)" );
    $weight=1;
    $values = json_decode(json_encode($results), true);
    $active = 0;
    foreach($values as $value){
      $weight = $value['user_weight'];
      $active = $value['Active'];
    }

    $Results = $wpdb ->get_results("SELECT * FROM wp40_postmeta WHERE (meta_key='Hatem-ref-Value-for-shipping') ");
    $Results = json_decode(json_encode($Results),true);
    $hatem_ref_value = $Results[0]['meta_value'];

    if (is_numeric($active) && $active != 0){
      $product = wc_get_product( 9113 );
      (float) $ref_value = (float)$weight * (float) $hatem_ref_value;

      $product->set_weight($weight);
      $product->update_meta_data('uap-woo-wsr-value', $ref_value);
      $product->save();

      // echo $ref_value;
    }


  }



  //Append Weight to Weiht Cart Total for اشحنلي

if ( ! defined('ABSPATH') ) exit();

if ( ! function_exists('Sawyan_User_custom_add_weight' ) ) {
          // This is necessary for WC 3.0+
          if ( is_admin() && ! defined( 'DOING_AJAX' ) )
          return;

      // Avoiding hook repetition (when using price calculations for example)
      if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 ) //woocommerce_cart_calculate_fees
          return;


    add_action('woocommerce_before_calculate_totals','Sawyan_User_custom_add_weight' );


    function Sawyan_User_custom_add_weight($cart){

      $fee7="";
      $fee6="";
      $fee5="";
      $fee4="";
      $fee3="";
      $fee2="";
      $fee1="";
        global $wpdb;
        $user_ID = get_current_user_id();
        $table_name =  'Sawyan_user';
        $results 	= $wpdb->get_results("SELECT * FROM $table_name where (user_ID = $user_ID)" );

        $values = json_decode(json_encode($results), true);
        foreach($values as $value){
          $weight = $value['user_weight'];
          $fee7 = $value['fee7'];
          $fee6 = $value['fee6'];
          $fee5 = $value['fee5'];
          $fee4 = $value['fee4'];
          $fee3 = $value['fee3'];
          $fee2 = $value['fee2'];
          $fee1 = $value['fee1'];
      }

      foreach ( $cart->get_cart() as $key => $item ) {
        $product= $item['data'];
        $productID =$product-> id;
        if ($productID == 9113){

          $ref_value = $weight * 0.25;
        $product->set_weight($weight);
        $product->update_meta_data('uap-woo-wsr-value', $ref_value);
        // $key['data'] -> set_weight($weight);

          // if (is_numeric($fee1)&& $fee1!=0){
          //   $cart -> add_fee('تعبئة وتغليف',$fee1);
          // }
          // if (is_numeric($fee2)&& $fee2!=0){
          //   $cart -> add_fee('فحص ومطابقة المنتج',$fee2);
          // }
          // if (is_numeric($fee3)&& $fee3!=0){
          //   $cart -> add_fee('رسوم المرتجع',$fee3);
          // }
          // if (is_numeric($fee4)&& $fee4!=0){
          //   $cart -> add_fee('اتعاب المرتجع',$fee4);
          // }
          // if (is_numeric($fee5)&& $fee5!=0){
          //   $cart -> add_fee('انتقالات داخلية',$fee5);
          // }
          // if (is_numeric($fee6)&& $fee6!=0){
          //   $cart -> add_fee('اتعاب الانتقالات الداخلية',$fee6);
          // }
          // if (is_numeric($fee7)&& $fee7!=0){
          //   $cart -> add_fee('أخرى',$fee7);
          // }


          $shipping_total = $cart->get_shipping_total() ?: 0;
          $tax_total      = $cart->get_taxes_total() ?: 0;

          $grand_total = $shipping_total + $tax_total;

          $donation = ($grand_total + $fee1 + $fee2 + $fee3 + $fee4 + $fee5 + $fee6 + $fee7) *0.1;

          // print_r($order->calculate_shipping());

      }






      }
    }
  }


  add_action('wp_footer','SawyanUser_Active_button_Shaping' );

  function SawyanUser_Active_button_Shaping(){
    global $wpdb;
    $weight="0";
    $Curent_UserID = get_current_user_id();
    $if_user_exit="";
    $table_name ='Sawyan_user';
    $results 	= $wpdb->get_results("SELECT * FROM $table_name WHERE user_ID = $Curent_UserID" );
    foreach($results as $result){
      $if_user_exit = $result ->user_ID;
      $weight = $result -> user_weight;
      $Active =  $result -> Active;
    }

    $check= false;
    if (is_numeric($if_user_exit) && $Active == 1 ){
      $check = true;
    }

    // echo $results -> user_ID;


    ?>
    <style>
      .Weight-counter {
    display: flex;
    justify-content: flex-end;
    margin: 43px;
    padding: 8px;
    /* background-color: #52EFDC; */
    flex-direction: column;
    align-items:flex-end;
    }
    .Weight-counter span{
    background-color: #52EFDC;
    width: 80px;
    font-size: 20px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;

    font-weight: 900;
    color: #082241;
    border-radius: 50%;
    direction: ltr;
    }
    </style>
    <script>
      (function($){

        let check;

        $('.page-id-9144 .single_add_to_cart_button').html('اشحنلي');
        $('.page-id-9144 .single_add_to_cart_button').prop('disabled', true);
        if(`<?php  echo $check ?>` == 1){
          check=true;
        }else
        check=false;

        $('.page-id-9144 .woocommerce').append(`<div class="Weight-counter"><span> 0 kg </span></div>`);
        //Append Button To Email
        //<a href="mailto:email@example.com?subject='Hello from Abstract!'&body='Just popped in to say hello'">Click to Send an Email</a>
        $('.page-id-9144 .single_add_to_cart_button.button').before(`<div id="Ship-to-me" style="display:block; background-color:#1E4068; color:white; border-radius:8px; padding: 8px 19px; width: fit-content; cursor: pointer; margin-bottom:10px">ارغب بمعرفة و تأكيد الشحن</div>`);

        $('#Ship-to-me').click(function(){
          let user_ID2  = `<?php echo $Curent_UserID; ?>`;


          jQuery.ajax({
        url: '/wp-admin/admin-ajax.php',
        data: {
          'action': 'hatem_send_email_start_shipping',
          'php_userID': user_ID2,

        },
        success: function(){
          // location.reload();
          alert("سيتم تأكيد الوزن  خلال يومين و سوف يتم ابلاغكم عن طريق البريد الالكتروني و تفعيل الزر بمجرد انتهاء المراجعة");
        },
        error: function(){
          alert("SomeThing Went Wrong , Contact with your IT Team");
        }
      });

        });
        if(check){
          // Cond2 Has Weight And Not Active
          $('.Hatem-shaping-msg').append(`<div><h3>يمكنك الان الشحن ما لديك بالمخزن بمجرد الضغط علي اشحنلي و للتفاصيل برجاء التواصل معانا</h3></div>`);
          $('.page-id-9144 .single_add_to_cart_button').prop('disabled', false);

          $('.Weight-counter span').html('<?php echo $weight ?> kg');
          let ProductName = $('.page-id-9 .woocommerce-cart-form__cart-item .product-name a').text().trim();
          if (ProductName == 'خدمة اشحنلي'){
            $('.page-id-9 .woocommerce-cart-form__cart-item').html(`<h2 style="margin:10px; color:#082241;">لمعرفة ما لديكم في المخزن يرجي التواصل معانا عبر الواتس اب</h2>`);
            $('.page-id-9 .cart-subtotal').remove();
          }
        }else{

          $('.Hatem-shaping-msg').append(`<div><h3>ابدأ بالتسوق و شراء المنتجات كي تتمكن من شحنهم لاحقا تسوق من <a style="color:#57b5aa;" href="https://sawyancom.com/#buy">خدمة اشتريلي</a></h3></div>`);

          $('.Weight-counter span').html('<?php echo $weight ?> kg');

          if ('<?php echo $weight ?>' != 0 ){
            $('.Hatem-shaping-msg').html(`<div><h3> اضغط علي ارغب بمعرفه و تأكيد الشحن كي نبدأ المراجعة</h3></div>`);
          }

        }

      $('.Weight-counter').append(`<p>اجمالي الوزن في مخزنكم</p>`);
      })(jQuery);
    </script>

<?php

  }





//============================== End Edit For Product_ID_9113 خدمة اشحنلي ========================================//


//Function to Know if order created and Change What we need


add_action("wp_footer","Hatem_Deleted_User_e47nly_when_order_created");

function Hatem_Deleted_User_e47nly_when_order_created(){

  if(is_user_logged_in()){


  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
  $url = "https://";
  else
      $url = "http://";
  // Append the host(domain name, ip) to the URL.
  $url.= $_SERVER['HTTP_HOST'];

  // Append the requested resource location to the URL
  $url.= $_SERVER['REQUEST_URI'];

  $PureURL = explode ("?", $url);
  if ($PureURL[0] == "https://sawyancom.com/order-received/thank-you/"){
    global $wpdb;
    $Curent_UserID = get_current_user_id();
    $table_name="Sawyan_user";
    $Last_order = wc_get_customer_last_order( $Curent_UserID );
    $ITEMS = $Last_order->get_items();
    foreach ($ITEMS as $Item) {
      $product_id = $Item->get_product_id();
      if($product_id == 9113){
      $wpdb->delete( $table_name, array( 'user_ID' => $Curent_UserID ) );
      return 0;
      }
    }
  }

  }
}



//===================================== END =========================================== //


// //Function IF user Role Is Vendor Remove Frist Shapping Method (For Testing);

// add_action("wp_footer","Hatem_Remove_Sec_Shipping_for_vendors");

// function Hatem_Remove_Sec_Shipping_for_vendors(){

//   $user_ID = get_current_user_id();
//   $user_Data = $user = get_userdata( $user_ID );

//   $user_roles = $user->roles;

//   $user_Role = $user_roles[0];



// }
