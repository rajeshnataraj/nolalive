<?php
@include("sessioncheck.php");

/*--- Select the city based the satate ---*/
$oper = isset($method['oper']) ? $method['oper'] : '';
if($oper == "changecity" and $oper != ""){
	$statevalue =  isset($method['statevalue']) ? $method['statevalue'] : '';
	?>
		<div class="selectbox">
		  <input type="hidden" name="ddlcity" id="ddlcity" value="" onchange="$('#ddlcity').valid();fn_loaddistrict(this.value);" >
		  <a class="selectbox-toggle" role="button" data-toggle="selectbox" href="#">
			<span class="selectbox-option input-medium" data-option=""> Select city</span>
			<b class="caret1"></b>
		  </a>
		  <div class="selectbox-options">
			<input type="text" class="selectbox-filter" placeholder="Search city" >
			<ul role="options">
				<?php
					$cityqry = $ObjDB->QueryObject("SELECT DISTINCT(fld_cityname) AS cityname
													FROM itc_state_city
													WHERE fld_statevalue='".$statevalue."' AND fld_delstatus=0
													ORDER BY fld_cityname ASC");
				   while($rowcity = $cityqry->fetch_assoc()){
					   extract($rowcity);
					   ?>
							<li><a tabindex="1" href="#" data-option="<?php echo ucwords(strtolower($cityname));?>"><?php echo  ucwords(strtolower($cityname))?></a></li>
					<?php
					}?>
			</ul>
		  </div>
		</div>
   <?php
}
/*--- Select the district based on state and district  ---*/
if($oper == "changedistrict" and $oper != ""){
		$statevalue =  isset($method['statevalue']) ? $method['statevalue'] : '';
		$cityname =  isset($method['cityname']) ? $method['cityname'] : '';
		?>
        <div class="selectbox">
          <input type="hidden" name="ddldist" id="ddldist" value="" onchange="$('#ddldist').valid();fn_loadschool('<?php echo $statevalue;?>','<?php echo $cityname;?>');">
          <a class="selectbox-toggle" role="button" data-toggle="selectbox" href="#">
            <span class="selectbox-option input-medium" data-option="">Select district</span>
            <b class="caret1"></b>
          </a>
          <div class="selectbox-options">
            <input type="text" class="selectbox-filter" placeholder="Search district" >
            <ul role="options">
            	<li><a tabindex="1" href="#" data-option="sp"><?php echo "School Purchase"?></a></li>
                <?php
                    $distqry = $ObjDB->QueryObject("SELECT fld_id,fld_district_name AS districtname
													FROM itc_district_master
													WHERE fld_state='".$statevalue."' AND fld_city='".$cityname."' AND fld_delstatus='0'
													ORDER BY fld_district_name ASC");
                    while($rowdist = $distqry->fetch_assoc()){
					extract($rowdist);
					?>
                           <li><a tabindex="1" href="#" data-option="<?php echo $fld_id;?>"><?php echo $districtname;?></a></li>
                    <?php
                    }?>
            </ul>
          </div>
        </div>
 <?php
}
/*--- Select the school based on district ---*/
if($oper == "changeschool" and $oper != ""){
		$distid =  isset($method['distid']) ? $method['distid'] : '';
		$state =  isset($method['state']) ? $method['state'] : '';
		$city =  isset($method['city']) ? $method['city'] : '';
		?>
        <div class="selectbox">
          <input type="hidden" name="ddlshl" id="ddlshl" value="" onchange="$('#ddlshl').valid();">
          <a class="selectbox-toggle" role="button" data-toggle="selectbox" href="#">
            <span class="selectbox-option input-medium" data-option="">Select school</span>
            <b class="caret1"></b>
          </a>
          <div class="selectbox-options">
            <input type="text" class="selectbox-filter" placeholder="Search school" >
            <ul role="options">
                <?php
				if($distid == "sp"){
					$shlph = $ObjDB->QueryObject("SELECT fld_id, fld_school_name AS schoolname
												FROM itc_school_master
												WHERE fld_district_id ='0' AND fld_state='".$state."' AND fld_city='".$city."' AND fld_delstatus='0'
												ORDER BY fld_school_name ASC");
                    while($rowshlp = $shlph->fetch_assoc()){
					extract($rowshlp);
					?>
                           <li><a tabindex="1" href="#" data-option="<?php echo $fld_id;?>"><?php echo $schoolname;?></a></li>
                    <?php
                    }
				}
				else{
                    $shlqry = $ObjDB->QueryObject("SELECT fld_id, fld_school_name AS schoolname
												FROM itc_school_master
												WHERE fld_district_id ='".$distid."' AND fld_delstatus='0'
												ORDER BY fld_school_name ASC ");
                    while($rowshl = $shlqry->fetch_assoc()){
					extract($rowshl);
					?>
                           <li><a tabindex="1" href="#" data-option="<?php echo $fld_id;?>"><?php echo $schoolname;?></a></li>
					<?php
                    }
                }?>
            </ul>
          </div>
        </div>
<?php
}

/*--- Select the city based the satate ---*/
if($oper == "changecity1" and $oper != ""){
		$statevalue =  isset($method['statevalue']) ? $method['statevalue'] : '';

		?>
            <div class="selectbox">
              <input type="hidden" name="ddlcity1" id="ddlcity1" value="" onchange="fn_changezip1(this.value);" >
              <a class="selectbox-toggle" role="button" data-toggle="selectbox" href="#">
                <span class="selectbox-option input-medium" data-option=""> Select city</span>
                <b class="caret1"></b>
              </a>
              <div class="selectbox-options">
                <input type="text" class="selectbox-filter" placeholder="Search city" >
                <ul role="options">
                    <?php
                        $cityqry = $ObjDB->QueryObject("SELECT DISTINCT(fld_cityname) AS cityname
														FROM itc_state_city
														WHERE fld_statevalue='".$statevalue."' AND fld_delstatus=0
														ORDER BY fld_cityname ASC");
                       while($rowcity = $cityqry->fetch_assoc()){
						   extract($rowcity);
						   ?>
                                <li><a tabindex="1" href="#" data-option="<?php echo $cityname;?>"><?php echo  ucwords(strtolower($cityname))?></a></li>
                        <?php
                        }?>
                </ul>
              </div>
            </div>
       <?php
	}
/*--- Select the zipcode based on city ---*/
if($oper == "changezip1" and $oper != ""){
		$cityvalue =  isset($method['cityvalue']) ? $method['cityvalue'] : '';
		$statevalue =  isset($method['statevalue']) ? $method['statevalue'] : '';
		?>
            <div class="selectbox">
              <input type="hidden" name="ddlzip1" id="ddlzip1" value="">
              <a class="selectbox-toggle" role="button" data-toggle="selectbox" href="#">
                <span class="selectbox-option input-medium" data-option=""> Select zip</span>
                <b class="caret1"></b>
              </a>
              <div class="selectbox-options">
                <input type="text" class="selectbox-filter" placeholder="Search zip" >
                <ul role="options">
                    <?php
                        $zipqry = $ObjDB->QueryObject("SELECT DISTINCT(fld_zipcode) AS zipcode
													FROM itc_state_city
													WHERE fld_cityname='".$cityvalue."' AND fld_statevalue='".$statevalue."' AND fld_delstatus=0
													ORDER BY fld_zipcode ASC");
                       while($rowzip = $zipqry->fetch_assoc()){
						   extract($rowzip);
						   ?>
                                <li><a tabindex="1" href="#" data-option="<?php echo $zipcode;?>"><?php echo $zipcode;?></a></li>
                        <?php
                        }?>
                </ul>
              </div>
            </div>
		<?php
	}
/*--- Save and update the tecaher ---*/
if($oper == "saveteacher" and $oper != ""){

	try /**Here starts with saving the details uster master and district master tables**/
		{
		$date=date("Y-m-d H:i:s");
		$editid =  isset($method['id']) ? $method['id'] : '0';
		$state =  isset($method['state']) ? $method['state'] : '';
		$city =  isset($method['city']) ? $method['city'] : '';
		$city =	ucwords(strtolower($city));
		$distid =  isset($method['distid']) ? $method['distid'] : '';
		$shlid =  isset($method['shlid']) ? $method['shlid'] : '';

		$fname =  isset($method['fname']) ? $method['fname'] : '';
		$lname =  isset($method['lname']) ? $method['lname'] : '';
		$email =  isset($method['email']) ? $method['email'] : '';
		$photo =  isset($method['photo']) ? $method['photo'] : '';

		$address1 =  isset($method['address1']) ? $method['address1'] : '';
		$state1 =  isset($method['state1']) ? $method['state1'] : '';
		$city1 =  isset($method['city1']) ? $method['city1'] : '';
		$city1 =	ucwords(strtolower($city1));
		$zipcode1 =  isset($method['zipcode1']) ? $method['zipcode1'] : '';
		$officeno =  isset($method['officeno']) ? $method['officeno'] : '';
		$faxno =  isset($method['faxno']) ? $method['faxno'] : '';
		$mobileno =  isset($method['mobileno']) ? $method['mobileno'] : '';
		$homeno =  isset($method['homeno']) ? $method['homeno'] : '';
                //       New Line for training teacher or not start
                $chkteacher = isset($method['chkteacher']) ? $method['chkteacher'] : '';
                $chkitct = isset($method['chkitct']) ? $method['chkitct'] : '';
                $chksost = isset($method['chksost']) ? $method['chksost'] : '';
                //       New Line for training teacher or not end
		$shlname = $ObjDB->SelectSingleValue("select fld_school_name from itc_school_master where fld_id = '".$shlid."'");
		$tags = isset($method['tags']) ? $method['tags'] : '';
		$uguid = gen_uuid();

		/**validation for the parameters and these below functions are validate to return true or false***/
		$validate_editid=true;
		$validate_state=true;
		$validate_city=true;
		$validate_zipcode=true;
		$validate_fname=true;
		$validate_lname=true;
		$validate_email=true;

		if($editid!=0) $validate_editid=validate_datatype($editid,'int');
		$validate_address1=validate_datas($address1,'letterswithbasicpunc');
		$validate_fname=validate_datas($fname,'lettersonly');
		$validate_lname=validate_datas($lname,'lettersonly');
		$validate_email=validate_datatype($email,'email');

		$fname = $ObjDB->EscapeStrAll($fname);
		$lname = $ObjDB->EscapeStrAll($lname);
		$address1 = $ObjDB->EscapeStrAll($address1);
		$tags = $ObjDB->EscapeStrAll($tags);

		if($validate_fname and $validate_lname and $validate_email)
			{
			if($editid==0){
				if($sessmasterprfid == 5){
					$userid =$ObjDB->NonQueryWithMaxValue("INSERT INTO itc_user_master (fld_uuid, fld_email, fld_fname, fld_lname, fld_profile_id, fld_role_id,
															fld_profile_pic, fld_district_id, fld_school_id, fld_user_id, fld_created_by, fld_created_date, fld_flag,fld_itcteacher,fld_sosteacher)
														VALUES ('".$uguid."','".$email."','".$fname."','".$lname."','9','5','".$photo."','0','0','".$uid."',
															'".$uid."','".$date."','".$chkteacher."','".$chkitct."','".$chksost."')");

					$shlname = $ObjDB->SelectSingleValue("SELECT CONCAT(fld_fname,' ',fld_lname) AS iname
														FROM itc_user_master
														WHERE fld_id='".$uid."'");
				}
				else{
					$userid =$ObjDB->NonQueryWithMaxValue("INSERT INTO itc_user_master (fld_uuid, fld_email, fld_fname, fld_lname, fld_profile_id, fld_role_id,
															fld_profile_pic,fld_district_id, fld_school_id, fld_created_by, fld_created_date, fld_flag,fld_itcteacher,fld_sosteacher)
														VALUES ('".$uguid."','".$email."','".$fname."','".$lname."','9','5','".$photo."','".$distid."','".$shlid."',
															'".$uid."','".$date."','".$chkteacher."','".$chkitct."','".$chksost."')");
				}


				/*--Tags insert-----*/
				fn_taginsert($tags,8,$userid,$uid);
				$arr = array($officeno,$faxno,$mobileno,$homeno,$address1,$state1,$city1,$zipcode1);
				$j=3;
				for($i=0;$i<sizeof($arr);$i++)
				{
					if($arr[$i]!='')
					{
						$ObjDB->NonQuery("INSERT INTO itc_user_add_info (fld_user_id,fld_field_id,fld_field_value)
										VALUES ('".$userid."','".$j."','".$arr[$i]."')");
					}
					$j++;
				}

				/*-------Mail----------*/
				$html_txt = '';
				$headers = '';
				$mailtitle = $shlname;

				$subj = "You're invited to join our learning management system";
				$random_hash = md5(date('r', time()));

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
				$headers .= "From: Synergy ITC <do_not_reply@nolaedu.net>" . "\r\n";

				$html_txt = '<table cellpadding="0" cellspacing="0" border="0" width="98%"><tbody><tr><td style="padding:15px;padding-top:10px;padding-bottom:40px;font-family:Helvetica,Arial,sans-serif;font-size:16px;
color:#222222;text-align:left" valign="top">
<h1 style="font-family:Helvetica,Arial,sans-serif;color:#222222;font-size:28px;line-height:normal;letter-spacing:-1px">
Invitation to create a Synergy ITC account</h1><p>Hello, </p><p>Thank you for choosing NOLA Education and Synergy ITC. In order to activate your account, click on the link below to choose a user name and password.</p><p><strong>Click this link to get started:</strong><br /><a href="'.$domainame.'register.php?e='.md5($userid).'">'.$domainame.'register.php?e='.md5($userid).'</a></p>
    <p><b>Access your <font style="font-style: italic;">Synergy ITC</font> account: &nbsp;&nbsp; By clicking on this link and logging into ITC, you agree the following agreement.</b><br><a href="'.__HOSTADDR__.'" target="_blank">'.__HOSTADDR__.'</a></p>
    <p align="center"><br><br>
          <b>PITSCO, INC. SYNERGY ITC LICENSE AGREEMENT</b><br>
39527<br><br>



<p style="margin-left:150px;width:70%;text-align:left;">YOU SHOULD CAREFULLY READ THE FOLLOWING TERMS AND CONDITIONS BEFORE ACCESSING THE SOFTWARE. ACCESSING THE SOFTWARE INDICATES YOUR ACCEPTANCE OF THESE TERMS AND CONDITIONS.<br><br>

Pitsco, Inc. provides these programs and licenses for use directly or through authorized dealers. You assume responsibility for the selection of the programs to achieve your intended results, and for the installation, use, and results obtained from the programs.<br><br>

<b>LICENSE</b><br>
Purchase or annual license of Synergy ITC entitles you to:<br><br>

a.	Access of Synergy ITC from the web.<br>
b.	Access of Synergy ITC by classroom or location equal to the number of Synergy ITC licenses purchased.<br><br>

YOU MAY NOT USE, COPY , MODIFY, OR TRANSFER THE PROGRAMS, OR ANY COPY, MODIFICATION, OR MERGED PORTION, IN WHOLE OR IN PART, EXCEPT AS EXPRESSLY PROVIDED FOR IN THIS LICENSE. IF YOU OTHERWISE USE OR TRANSFER POSSESSION OR ANY COPY, MODIFICATION, OR MERGED PORTION OF THE PROGRAMS TO ANOTHER PARTY, YOUR LICENSE IS AUTOMATICALLY TERMINATED. <br><br>

<b>TERM</b><br>
The license is effective until terminated. You may terminate it at any time by destroying the programs together with all copies, modification, and merged portions in any form. It will also terminate upon conditions set forth elsewhere in this Agreement or if you fail to comply with any term or condition of this Agreement. You agree upon such termination to destroy the programs together with all copies, modifications, and merged portions in any form. If you purchased an annual license, the term shall expire in one year. <br><br>

LIMITED WARRANTY<br>
THE PROGRAMS ARE PROVIDED �AS IS� WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAMS IS WITH YOU. SHOULD THE PROGRAMS PROVE DEFECTIVE, YOU (AND NOT NOLA EDUCATION) ASSUME THE ENTIRE COST OF ALL NECESSARY SERVICING, REPAIR, OR CORRECTION.<br><br>

SOME STATES AND COUNTRIES DO NOT ALLOW THE EXCLUSION OF IMPLIED WARRANTIES, SO THE ABOVE EXCLUSION MAY NOT APPLY TO YOU. THIS WARRANTY GIVES YOU SPECIFIC LEGAL RIGHTS AND YOU MAY ALSO HAVE OTHER RIGHTS WHICH VARY BY STATE OR COUNTRY.<br><br>

Pitsco, Inc. does not warrant that the functions contained in the programs will meet your requirements or that the operation of the programs will be uninterrupted or error-free.<br><br>

However, Pitsco, Inc. warrants the software on which the programs are furnished, to be free from defects in materials and workmanship under normal use for a period of ninety (90) days from the date of delivery to you as evidenced by a copy of your receipt. <br><br>


<b>LIMITATIONS OF REMEDIES</b><br>
Pitsco, Inc.�s entire liability and your exclusive remedy shall be:<br><br>

1.	The replacement of any software not meeting Pitsco, Inc.�s �Limited Warranty� and which is returned to Pitsco, Inc. <br><br>

IN NO EVENT WILL PITSCO, INC. BE LIABLE TO YOU FOR ANY DAMAGES, INCLUDING ANY LOST PROFITS, LOST SAVINGS, OR OTHER INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE SUCH PROGRAMS EVEN IF PITSCO, INC. HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES, OR FOR ANY CLAIM BY ANY OTHER PARTY.<br><br>

SOME STATES DO NOT ALLOW THE LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES SO THE ABOVE LIMITATION OR EXCLUSION MAY NOT APPLY TO YOU.<br><br>

<b>GENERAL</b><br>
You may not sublicense, assign, or transfer the license or the programs except as expressly provided in this Agreement. Any attempt otherwise to sublicense, assign, or transfer any of the rights, duties, or obligations hereunder is void.<br><br>

This Agreement will be governed by the laws of the country in which you bought the license.<br><br>

YOU ACKNOWLEDGE THAT YOU HAVE READ THIS AGREEMENT, UNDERSTAND IT AND AGREE TO BE BOUND BY ITS TERMS AND CONDITIONS. YOU FURTHER AGREE THAT IT IS THE COMPLETE AND EXCLUSIVE STATEMENT OF THE AGREEMENT BETWEEN US WHICH SUPERSEDES ANY PROPOSAL OR PRIOR AGREEMENT, ORAL OR WRITTEN, AND ANY OTHER COMMUNICATIONS BETWEEN US RELATING TO THE SUBJECT MATTER OF THIS AGREEMENT.<br><br>

    </p>
<p>If you are in need of technical support, please don&lsquo;t hesitate to contact our industry-leading customer support line at 800-526-5173.</p><p>Thank you,</p><p><strong>NOLA Education</strong><br>800-526-5173<br>www.nolaedu.net</p><p align="center"  style="font-style: italic;">Thank you for being a loyal Pitsco customer! <br>We appreciate all you do for students!</p>
</td></tr></tbody></table>';
				$param = array('SiteID' => '30','fromAddress' => 'do_not_reply@nolaedu.net','fromName' => 'Synergy ITC','toAddress' => $email,'subject' => $subj, 'plainTex' => '','html' => $html_txt,'options' => '','groupID' => '805014','log' => 'True');
				$client = new nusoap_client(PAPI_URL . '/msgg/msgg.asmx?wsdl', 'wsdl');
				$client->call('SendJangoMailTransactional', $param, '', '', false, true);
			}
			else{
				/*---tags------*/
				$ObjDB->NonQuery("UPDATE itc_main_tag_mapping SET fld_access='0'
								WHERE fld_tag_type='8' AND fld_item_id='".$editid."' AND fld_tag_id
								IN(SELECT fld_id FROM itc_main_tag_master WHERE fld_created_by='".$uid."' AND fld_delstatus='0')");
				fn_tagupdate($tags,8,$editid,$uid);

				$ObjDB->NonQuery("UPDATE itc_user_master
								SET fld_email = '".$email."', fld_fname = '".$fname."', fld_lname = '".$lname."', fld_district_id ='".$distid."',
									fld_school_id = '".$shlid."', fld_profile_pic = '".$photo."', fld_updated_by = '".$uid."', fld_updated_date = '".$date."' , fld_flag='".$chkteacher."' , fld_itcteacher='".$chkitct."' , fld_sosteacher='".$chksost."'
									WHERE fld_id = '".$editid."' AND fld_delstatus ='0'");

				$arr = array($officeno,$faxno,$mobileno,$homeno,$address1,$state1,$city1,$zipcode1);
				$j=3;
				for($i=0;$i<sizeof($arr);$i++)
				{
					if($arr[$i]!='')
					{
						$cnt=$ObjDB->SelectSingleValue("SELECT COUNT(fld_id)
														FROM itc_user_add_info
														WHERE fld_user_id = '".$editid."' AND  fld_field_id = '".$j."'");
						if($cnt>0)
						{
						$ObjDB->NonQuery("UPDATE itc_user_add_info
										SET fld_field_value = '".$arr[$i]."'
										WHERE fld_user_id = '".$editid."' AND fld_field_id = '".$j."' AND fld_delstatus ='0'");
						}
						else if($cnt==0)
						{
							$ObjDB->NonQuery("INSERT INTO itc_user_add_info (fld_user_id,fld_field_id,fld_field_value)
											VALUES ('".$editid."','".$j."','".$arr[$i]."')");
						}
					}
					$j++;
				}
			}
			echo "success";
		}
		else{
			echo "fail";
		}
	}
	catch(Exception $e)
	{
		 echo "fail";
	}
}
/*--- Delete the teacher details ---*/
if($oper == "deletteacher" and $oper != ""){

	$editid =  isset($method['editid']) ? $method['editid'] : '';
	$ObjDB->NonQuery("UPDATE itc_user_master
					SET fld_delstatus = '1', fld_deleted_by = '".$uid."', fld_deleted_date='".date("Y-m-d H:i:s")."'
					WHERE fld_id = '".$editid."'");
}
/*--- Reset the teacher password ---*/
if($oper=="resett" and $oper != '')
{
		$editid = (isset($method['editid'])) ? $method['editid'] : '';
		$userdetail = $ObjDB->QueryObject("SELECT fld_username AS uname, fld_fname AS fname,fld_lname AS lname,fld_email AS email
										FROM itc_user_master
										WHERE fld_id='".$editid."' AND fld_delstatus='0' AND fld_activestatus='1'");
		$rowuserdetail = $userdetail->fetch_assoc();
		extract($rowuserdetail);

		$subj = "your pitsco password";
		$newpassword=generatePassword();
		echo $newpassword;
		$random_hash = md5(date('r', time()));
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= "From: Synergy ITC <do-not-reply@synergyitc.com>" . "\r\n";

		$html_txt = '<table cellpadding="0" cellspacing="0" border="0" width="98%"><tbody><tr><td style="padding:15px;font-family:Helvetica,Arial,sans-serif;font-size:16px;text-align:left"><img src="http://development.pitsco.info/images/pitsco-logo-n.png"/></td></tr><tr><td style="padding:15px;padding-top:10px;padding-bottom:40px;font-family:Helvetica,Arial,sans-serif;font-size:16px;text-align:left" valign="top"><h1 style="font-family:Helvetica,Arial,sans-serif;color:#222222;font-size:28px;line-height:normal;letter-spacing:-1px">Your Synergy ITC Username And Password</h1><p>Hi '.$fname.',</p><p>Can&lsquo;t remember your password? Don&lsquo;t worry about it &ndash; it happens.</p><p>Your username is: <strong>'.$uname.'</strong></p><p> your password:<strong>'.$newpassword.'</strong><br></p><hr style="margin-top:30px;border:none;border-top:1px solid #ccc"><p style="font-size:13px;line-height:1.3em"><b>Didn&lsquo;t ask to reset your password?</b><br><p>If you didn&lsquo;t ask for your password, it&lsquo;s likely that another user entered your username or email address by mistake while trying to reset their password. If that&lsquo;s the case, you don&lsquo;t need to take any further action and can safely disregard this email.</p></td></tr></tbody></table>';

	$ObjDB->NonQuery("UPDATE itc_user_master
						SET fld_password = '".fnEncrypt($newpassword,$encryptkey)."', fld_updated_by = '".$uid."', fld_updated_date = '".date("Y-m-d H:i:s")."'
						WHERE fld_id = '".$editid."' AND fld_delstatus ='0'");
	$param = array('SiteID' => '30','fromAddress' => 'do_not_reply@nolaedu.net','fromName' => 'Synergy ITC','toAddress' => $email,'subject' => $subj, 'plainTex' => '','html' => wordwrap($html_txt),'options' => '','groupID' => '805014','log' => 'True');
	$client = new nusoap_client(PAPI_URL . '/msgg/msgg.asmx?wsdl', 'wsdl');
	$client->call('SendJangoMailTransactional', $param, '', '', false, true);
}
/*----- Resend the mail to user -----*/
if($oper=="saveteachermail" and $oper != '')
{
	$userid = (isset($method['mailid'])) ? $method['mailid'] : '';
	$userdetail = $ObjDB->QueryObject("SELECT fld_username AS uname, fld_fname AS fname,fld_lname AS lname,fld_email AS email, fld_school_id as schoolidno
									FROM itc_user_master
									WHERE fld_id='".$userid."' AND fld_delstatus='0' AND fld_activestatus='0'");

	  while($rowshl = $userdetail->fetch_assoc())
	  {
	 	 extract ($rowshl);
		 $shlname = $ObjDB->SelectSingleValue("SELECT fld_school_name
		 									FROM itc_school_master
											WHERE fld_id = '".$schoolidno."'");

	    $full_name = (string)$fname.' '.(string)$lname;

		$html_txt = '';
		$headers = '';
		$mailtitle = $shlname;

		$subj = "You're invited to join our learning management system";
		$random_hash = md5(date('r', time()));

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
		$headers .= "From: Synergy ITC <do_not_reply@nolaedu.net>" . "\r\n";

		$html_txt = '<table cellpadding="0" cellspacing="0" border="0" width="98%"><tbody><tr><td style="padding:15px;padding-top:10px;padding-bottom:40px;font-family:Helvetica,Arial,sans-serif;font-size:16px;
color:#222222;text-align:left" valign="top">
<h1 style="font-family:Helvetica,Arial,sans-serif;color:#222222;font-size:28px;line-height:normal;letter-spacing:-1px">
Invitation to create a Synergy ITC account</h1><p>Hello,</p><p>Thank you for choosing NOLA Education and Synergy ITC. In order to activate your account, click on the link below to choose a user name and password.</p><p><strong>Click this link to get started:</strong><br /><a href="'.$domainame.'register.php?e='.md5($userid).'">'.$domainame.'register.php?e='.md5($userid).'</a></p>
    <p><b>Access your <font style="font-style: italic;">Synergy ITC</font> account: &nbsp;&nbsp; By clicking on this link and logging into ITC, you agree the following agreement.</b><br><a href="'.__HOSTADDR__.'" target="_blank">'.__HOSTADDR__.'</a></p>
    <p align="center"><br><br>
          <b>PITSCO, INC. SYNERGY ITC LICENSE AGREEMENT</b><br>
39527<br><br>



<p style="margin-left:150px;width:70%;text-align:left;">YOU SHOULD CAREFULLY READ THE FOLLOWING TERMS AND CONDITIONS BEFORE ACCESSING THE SOFTWARE. ACCESSING THE SOFTWARE INDICATES YOUR ACCEPTANCE OF THESE TERMS AND CONDITIONS.<br><br>

Pitsco, Inc. provides these programs and licenses for use directly or through authorized dealers. You assume responsibility for the selection of the programs to achieve your intended results, and for the installation, use, and results obtained from the programs.<br><br>

<b>LICENSE</b><br>
Purchase or annual license of Synergy ITC entitles you to:<br><br>

a.	Access of Synergy ITC from the web.<br>
b.	Access of Synergy ITC by classroom or location equal to the number of Synergy ITC licenses purchased.<br><br>

YOU MAY NOT USE, COPY , MODIFY, OR TRANSFER THE PROGRAMS, OR ANY COPY, MODIFICATION, OR MERGED PORTION, IN WHOLE OR IN PART, EXCEPT AS EXPRESSLY PROVIDED FOR IN THIS LICENSE. IF YOU OTHERWISE USE OR TRANSFER POSSESSION OR ANY COPY, MODIFICATION, OR MERGED PORTION OF THE PROGRAMS TO ANOTHER PARTY, YOUR LICENSE IS AUTOMATICALLY TERMINATED. <br><br>

<b>TERM</b><br>
The license is effective until terminated. You may terminate it at any time by destroying the programs together with all copies, modification, and merged portions in any form. It will also terminate upon conditions set forth elsewhere in this Agreement or if you fail to comply with any term or condition of this Agreement. You agree upon such termination to destroy the programs together with all copies, modifications, and merged portions in any form. If you purchased an annual license, the term shall expire in one year. <br><br>

LIMITED WARRANTY<br>
THE PROGRAMS ARE PROVIDED �AS IS� WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAMS IS WITH YOU. SHOULD THE PROGRAMS PROVE DEFECTIVE, YOU (AND NOT NOLA EDUCATION) ASSUME THE ENTIRE COST OF ALL NECESSARY SERVICING, REPAIR, OR CORRECTION.<br><br>

SOME STATES AND COUNTRIES DO NOT ALLOW THE EXCLUSION OF IMPLIED WARRANTIES, SO THE ABOVE EXCLUSION MAY NOT APPLY TO YOU. THIS WARRANTY GIVES YOU SPECIFIC LEGAL RIGHTS AND YOU MAY ALSO HAVE OTHER RIGHTS WHICH VARY BY STATE OR COUNTRY.<br><br>

Pitsco, Inc. does not warrant that the functions contained in the programs will meet your requirements or that the operation of the programs will be uninterrupted or error-free.<br><br>

However, Pitsco, Inc. warrants the software on which the programs are furnished, to be free from defects in materials and workmanship under normal use for a period of ninety (90) days from the date of delivery to you as evidenced by a copy of your receipt. <br><br>


<b>LIMITATIONS OF REMEDIES</b><br>
Pitsco, Inc.�s entire liability and your exclusive remedy shall be:<br><br>

1.	The replacement of any software not meeting Pitsco, Inc.�s �Limited Warranty� and which is returned to Pitsco, Inc. <br><br>

IN NO EVENT WILL PITSCO, INC. BE LIABLE TO YOU FOR ANY DAMAGES, INCLUDING ANY LOST PROFITS, LOST SAVINGS, OR OTHER INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE SUCH PROGRAMS EVEN IF PITSCO, INC. HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES, OR FOR ANY CLAIM BY ANY OTHER PARTY.<br><br>

SOME STATES DO NOT ALLOW THE LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES SO THE ABOVE LIMITATION OR EXCLUSION MAY NOT APPLY TO YOU.<br><br>

<b>GENERAL</b><br>
You may not sublicense, assign, or transfer the license or the programs except as expressly provided in this Agreement. Any attempt otherwise to sublicense, assign, or transfer any of the rights, duties, or obligations hereunder is void.<br><br>

This Agreement will be governed by the laws of the country in which you bought the license.<br><br>

YOU ACKNOWLEDGE THAT YOU HAVE READ THIS AGREEMENT, UNDERSTAND IT AND AGREE TO BE BOUND BY ITS TERMS AND CONDITIONS. YOU FURTHER AGREE THAT IT IS THE COMPLETE AND EXCLUSIVE STATEMENT OF THE AGREEMENT BETWEEN US WHICH SUPERSEDES ANY PROPOSAL OR PRIOR AGREEMENT, ORAL OR WRITTEN, AND ANY OTHER COMMUNICATIONS BETWEEN US RELATING TO THE SUBJECT MATTER OF THIS AGREEMENT.<br><br>

    </p>
<p>If you are in need of technical support, please don&lsquo;t hesitate to contact our industry-leading customer support line at 800-526-5173.</p><p>Thank you,</p><p><strong>NOLA Education</strong><br>800-526-5173<br>www.nolaedu.net</p><p align="center"  style="font-style: italic;">Thank you for being a loyal Pitsco customer! <br>We appreciate all you do for students!</p>
</td></tr></tbody></table>';
		$param = array('SiteID' => '30','fromAddress' => 'do_not_reply@nolaedu.net','fromName' => 'Synergy ITC','toAddress' => $email,'subject' => $subj, 'plainTex' => '','html' => $html_txt,'options' => '','groupID' => '805014','log' => 'True');
		$client = new nusoap_client(PAPI_URL . '/msgg/msgg.asmx?wsdl', 'wsdl');
		$client->call('SendJangoMailTransactional', $param, '', '', false, true);
	}
}


if($oper == "showteachers" and $oper != '')
{
    $distid = isset($_REQUEST['distid']) ? $_REQUEST['distid'] : '0';
    $schoolid = isset($_REQUEST['schoolid']) ? $_REQUEST['schoolid'] : '0';
?>
     <div class='row buttons' id="loadteacher">
        <a class='skip btn mainBtn' href='#users-individuals-teacher_newteacher' id='btnusers-individuals-teacher_newteacher' name='0'>
          <div class="icon-synergy-add-dark"></div>
          <div class='onBtn'>New Teacher</div>
        </a>

            <?php

            $sqry = $ObjDB->QueryObject("SELECT fld_id AS id, CONCAT(fld_lname,' ',fld_fname) AS fullname,
		  								fn_shortname(CONCAT(fld_lname,' ',fld_fname),1) AS shortname, fld_profile_pic AS photo, fld_district_id AS sdistid,
										fld_school_id AS sshlid, fld_user_id AS suserid
									FROM itc_user_master
									WHERE fld_profile_id= '9' AND fld_school_id='".$schoolid."' AND fld_district_id='".$distid."' AND  fld_delstatus='0'
									ORDER BY fullname ASC");

            while($stures = $sqry->fetch_assoc())
            {
                    extract($stures);
                    ?>
                    <a class='skip btn mainBtn' href='#users-individuals-teacher_newteacher' id='btnusers-individuals-teacher_newteacher' name="<?php echo $id.",".$sdistid.",".$sshlid.",".$suserid;?>">
                    <div class="icon-synergy-user">
                        <?php if($photo != "no-image.png" && $photo != ''){ ?>
                            <img class="thumbimg" src="thumb.php?src=<?php echo __CNTPPPATH__.$photo; ?>&w=40&h=40&q=100" />
                        <?php } ?>
                    </div>
                    <div class='onBtn tooltip' title="<?php echo $fullname;?>"><?php echo $shortname;?></div>
                    </a>
            <?php
            }
        ?>
    </div>
        <?php
}

if($oper=="showschools" and $oper != " " )
{
    $distid = isset($method['distid']) ? $method['distid'] : '';
	?>

     <p class="lightSubTitle">School</p>
    <dl class='field row'>
                        <dt class='dropdown'>

                        <div class="selectbox">
                            <input type="hidden" name="schoolid" id="schoolid" value="">
                            <a class="selectbox-toggle" role="button" data-toggle="selectbox" href="#"> <span class="selectbox-option input-medium" data-option="">Select School</span> <b class="caret1"></b> </a>
                            <div class="selectbox-options">
                                <input type="text" class="selectbox-filter" placeholder="Search School">
                                <ul role="options">
                                                                            <?php
                                    $qry = $ObjDB->QueryObject("SELECT fld_id as schoolid, fld_school_name AS schoolname
                                                                                            FROM itc_school_master
                                                                                            WHERE fld_district_id ='".$distid."' AND fld_delstatus='0'
                                                                                            ORDER BY fld_school_name ASC ");
                                        if($qry->num_rows>0){
                                        while($row = $qry->fetch_assoc())
                                        {
                                                extract($row);
                                                ?>
                                                <li><a tabindex="-1" href="#" data-option="<?php echo $schoolid;?>" onclick="javascript:$('#RadioGroup').show();$('#types6').show();fn_session(<?php echo $schoolid;?>,<?php echo $distid;?>);fn_showteachers(<?php echo $schoolid;?>,<?php echo $distid;?>);"><?php echo $schoolname; ?></a></li>
                                                <?php
                                        }
                                    }?>
                                </ul>
                            </div>
                          </div>
                        </dt>
                    </dl>

            <?php
}


if($oper=="schoolpurchase" and $oper != " " )
{
?>
        <p class="lightSubTitle">School</p>
	<div class="selectbox">
            <input type="hidden" name="schoolid" id="schoolid" value="">
            <a class="selectbox-toggle"  role="button" data-toggle="selectbox" href="#"> <span class="selectbox-option input-medium" data-option="">Select School</span> <b class="caret1"></b> </a>
            <div class="selectbox-options">
                <input type="text" class="selectbox-filter" placeholder="Search School">
                <ul role="options">
                                                            <?php
                    $qry = $ObjDB->QueryObject("SELECT fld_id as schoolid, fld_school_name AS schoolname
                                                                            FROM itc_school_master
                                                                            WHERE fld_district_id ='0' AND fld_delstatus='0'
                                                                            ORDER BY fld_school_name ASC ");
                        if($qry->num_rows>0){
                        while($row = $qry->fetch_assoc())
                        {
                                extract($row);
                                ?>
                                <li><a tabindex="-1" href="#" data-option="<?php echo $schoolid;?>" onclick="javascript:$('#RadioGroup').show();$('#types6').show();fn_session(<?php echo $schoolid;?>,0);fn_showteachers(<?php echo $schoolid;?>,0);"><?php echo $schoolname; ?></a></li>
                                <?php
                        }
                    }?>
                </ul>
            </div>

        </div>

	<?php
}


if($oper == "homepurchaseteacher" and $oper != '')
{
   ?>
     <div class='row buttons' id="loadteacher">
        <a class='skip btn mainBtn' href='#users-individuals-teacher_newteacher' id='btnusers-individuals-teacher_newteacher' name='0'>
          <div class="icon-synergy-add-dark"></div>
          <div class='onBtn'>New Teacher</div>
        </a>

            <?php

            $sqry = $ObjDB->QueryObject("SELECT fld_id AS id, CONCAT(fld_lname,' ',fld_fname) AS fullname,
		  								fn_shortname(CONCAT(fld_lname,' ',fld_fname),1) AS shortname, fld_profile_pic AS photo, fld_district_id AS sdistid,
										fld_school_id AS sshlid, fld_user_id AS suserid
									FROM itc_user_master
									WHERE fld_profile_id= '9' AND fld_school_id='0' AND fld_district_id='0' AND fld_user_id<>'0' AND  fld_delstatus='0'
									ORDER BY fullname ASC");

            while($stures = $sqry->fetch_assoc())
            {
                    extract($stures);
                    ?>
                    <a class='skip btn mainBtn' href='#users-individuals-teacher_newteacher' id='btnusers-individuals-teacher_newteacher' name="<?php echo $id.",".$sdistid.",".$sshlid.",".$suserid;?>">
                    <div class="icon-synergy-user">
                        <?php if($photo != "no-image.png" && $photo != ''){ ?>
                            <img class="thumbimg" src="thumb.php?src=<?php echo __CNTPPPATH__.$photo; ?>&w=40&h=40&q=100" />
                        <?php } ?>
                    </div>
                    <div class='onBtn tooltip' title="<?php echo $fullname;?>"><?php echo $shortname;?></div>
                    </a>
            <?php
            }
        ?>
    </div>
        <?php
}

	@include("footer.php");
