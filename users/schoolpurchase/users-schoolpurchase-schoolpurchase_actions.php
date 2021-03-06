<?php 
/*------
	Page - users-schoolpurchase-schoolpurchase_actions
	Description:
		showing the buttons to perform Edit, Delete and view operation for a schoolpurchase
	History:	
------*/
@include("sessioncheck.php");

$id = isset($method['id']) ? $method['id'] : '';
$id=explode(",",$id);

?>
<script>
	$.getScript("users/schoolpurchase/users-schoolpurchase-newschoolpurchase.js");
</script>

<section data-type='#users-schoolpurchase' id='users-schoolpurchase-schoolpurchase_actions'>
  <div class='container'>
    <div class='row'>
      <div class='twelve columns'>
      	<p class="lightTitle"><?php echo $id[1]." Actions";?></p>
        <p class="lightSubTitleLight">&nbsp;</p>
      </div>
    </div>
    <div class='row buttons'>
      <a class='skip btn mainBtn' href='#users-newschoolpurchase' id='btnusers-schoolpurchase-newschoolpurchaseview' name='<?php echo $id[0];?>'>
        <div class="icon-synergy-view"></div>
        <div class='onBtn'>View</div>
      </a>
      <a class='skip btn mainBtn' href='#users-newschoolpurchase' id='btnusers-schoolpurchase-newschoolpurchase' name='<?php echo $id[0];?>'>
       <div class="icon-synergy-edit"></div>
        <div class='onBtn'>Edit</div>
      </a>
      <a class='skip btn main' href='#users-newschoolpurchase' onclick="fn_deletschoolpurchase(<?php echo $id[0];?>)">
        <div class="icon-synergy-trash"></div>
        <div class='onBtn'>Delete</div>
      </a>

      <?php 
	  	$status = $ObjDB->SelectSingleValueInt("SELECT a.fld_activestatus 
											FROM itc_user_master AS a, `itc_school_master` AS b 
											WHERE a.fld_id= b.fld_school_admin_id AND b.fld_id='".$id[0]."' AND a.fld_delstatus='0'");?>

        <?php $username = $ObjDB->SelectSingleValue("SELECT fld_username FROM itc_user_master 
	  												WHERE fld_id='".$id[0]."'");?>
                                            
      <a class='skip btn main <?php if($status !=1){ echo "dim"; } ?>' href='#users-newschoolpurchase' onclick="fn_resetsp('<?php echo $username;?>')">
         <div class='icon-synergy-key'></div>
        <div class='onBtn'>Reset<br/>Password</div>
      </a>
       <?php  if($status==0) { ?>
            <a class='skip btn main' href='#users-individuals-teacheradmin_newteacheradmin' onclick="fn_resendmail(<?php echo $id[0];?>)">
                <div class='icon-synergy-mail'></div>
                <div class='onBtn'>Resend <br/> Invitation</div>
            </a>
		<?php } ?>
    </div>
  </div>
</section>
<?php
	@include("footer.php");
