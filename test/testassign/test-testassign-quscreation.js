//Answertype=12 - Drag N Drop Type - 2  Starts
function rearrangeballs()
{
	var emtpdiv='<div class="empty" style="width: 30px; height: 30px; float: left;pointer-events:none"></div>';
	var totaldivmodulescnt =$('.ballcontainer > div[class]').length%10;
	var adddivcnt = 10-totaldivmodulescnt;
	ul = $('div.ballcontainer div:first-child'); // your parent ul element
	if(adddivcnt!=0)
	{
		for(i=0;i<adddivcnt;i++)
		{
			ul.before(emtpdiv);
		}
	}
}

function fn_ballsrowview(type)
{
	var id = parseInt($('#hidtextrowcnt').val());
	if(type==1)
	{
		id++;
		$('#trow'+id).show();
		$('#hidtextrowcnt').val(id);
		$('#remove-btn').removeClass('dim');
		if(id>4)
			$('#add-btn').addClass('dim');
	}
	else if(type==2)
	{
		$('#trow'+id).hide();
		id--;
		$('#hidtextrowcnt').val(id); 
		$('#remove-btn').removeClass('dim');	
		$('#add-btn').removeClass('dim');
		if(id<2)
			$('#remove-btn').addClass('dim');
	}
}

function fn_previewballs()
{
	$('#wrapper').show();
	$(".ballsplitted").html('');
	$(".ballcontainer").html('');
	$('tr[id^=tanswerrow]').each(function(){
		$(this).html('');  
	});	 
	var ballcolor = '';
	var insideball ='';
	var outsideball = '';
	$('input[id^=colorSelector]').each(function(){
		ballcolorid=$(this).attr('id').replace('colorSelector','');
		
		if($('#trow'+ballcolorid).is(":visible")==true)
		{
			outsideboxval=$('#outsidered'+ballcolorid).val();
			insideboxval=$('#insidered'+ballcolorid).val();
			colorSelector=$('#colorSelector'+ballcolorid).val();
			
			if(ballcolor=='')
				ballcolor = colorSelector;
			else 
				ballcolor = ballcolor+'~'+colorSelector;
				
			if(insideball=='')
				insideball = insideboxval;
			else 
				insideball = insideball+'~'+insideboxval;
				
			if(outsideball=='')
				outsideball = outsideboxval;
			else 
				outsideball = outsideball+'~'+outsideboxval;
				
			for(i=0;i<insideboxval;i++)
			{
				divelement='<div style=" background: none repeat scroll 0 0 #'+colorSelector+';pointer-events:none" class="ball-green"></div>';
				$(".ballcontainer").append(divelement);
			}
			for(j=0;j<outsideboxval;j++)
			{
				divt='<div  style=" background: none repeat scroll 0 0 #'+colorSelector+';cursor:all-scroll" class="ball-blue"></div>';
				$(".ballsplitted").append(divt);
			}
			if(outsideboxval!='' && outsideboxval!=0)
			{
				var td='<td><span id="color'+ballcolorid+'">#'+colorSelector+'</span></td>';
				td=td+'<td><input class="mix-input qit-medium" maxlength="2" type="text" id="correct'+ballcolorid+'" style="width:75px;height:20px;" name="outsidered" onkeyup="ChkValidChar(this.id);"/></td>';           
				td=td+'<td><input class="mix-input qit-medium" maxlength="2" type="text" id="anocorrect'+ballcolorid+'" style="width:75px;height:20px;" name="outsidered" onkeyup="ChkValidChar(this.id);"/></td>'; 
				$('#tanswerrow'+ballcolorid).show();
				$('#tanswerrow'+ballcolorid).html(''); 
				$('#tanswerrow'+ballcolorid).append(td); 
			}
		}
		$('#hidballcolor').val(ballcolor); 
		$('#hidinsideball').val(insideball); 
		$('#hidoutsideball').val(outsideball); 
	});
	
	$("#correct1,#anocorrect1,#correct2,#anocorrect2,#correct3,#anocorrect3,#correct4,#anocorrect4,#correct5,#anocorrect5").keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
	});
	
	$('.ball-green').shuffle();
	$('.ball-blue').shuffle();
	rearrangeballs();
	$('#correctans').show();
}

String.prototype.startsWith = function (str) {
	return (this.indexOf(str) === 0);
}
function ChkValidChar(id) {	
	var nextid = id.replace('correct','outsidered');
	nextid = nextid.replace('anooutsidered','outsidered');	
	var txtbx = document.getElementById(id).value;
	var nexttxtbx = document.getElementById(nextid).value;
	if(parseInt(txtbx) > parseInt(nexttxtbx)) // true
	{
		document.getElementById(id).value = "";
	}
}
//Answertype=12 - Drag N Drop Type - 2  Ends



function addanochoice(id,type){
	if(type==0)
	{
		id++;
		$('#TextBoxDiv'+id).show();
		$('#txtanswereditor'+id+'_tbl').css('width','485px');
		var newheight = 200*id;
		$('#questionTools1').css('height',newheight);
		$('#hidchoicename').val(id);
		$('#removemulchoice').show();
		if(id>7)
			$('#addmulchoice').addClass('dim');
	}
	else if(type==1)
	{
		$('#TextBoxDiv'+id).hide();
		$('#txtanswereditor'+id+'_tbl').css('width','485px');
		id--;
		var newheight = 200*id;
		$('#questionTools1').css('height',newheight);
		$('#hidchoicename').val(id);
		$('#removemulchoice').show();
		$('#addmulchoice').removeClass('dim');
		if(id<3)
			$('#removemulchoice').hide();
	}
}

function addanoimg(id,type){
	if(type==0)
	{
		id++;
		$('#img'+id).show();
		$('#hidimgchname').val(id);
		$('#removemulimg').show();
		if(id>7)
			$('#addmulimg').addClass('dim');
	}
	else if(type==1)
	{
		$('#img'+id).hide();
		id--;
		$('#hidimgchname').val(id);
		$('#removemulimg').show();
		$('#addmulimg').removeClass('dim');
		if(id<3)
			$('#removemulimg').hide();
	}
}

function addanoqus(id,type){
	
	if(type==0)
	{
		id++;
		$('#TextQusBox'+id).show();
		$('#hidchoicename').val(id);
		$('#removemulqus').show();
		if(id>9)/* changes has made due to increase in question and option */
			$('#addmulqus').addClass('dim');
	}
	else if(type==1)
	{
		$('#TextQusBox'+id).hide();
		id--;
		$('#hidchoicename').val(id);
		$('#removemulqus').show();
		$('#addmulqus').removeClass('dim');
		if(id<2)
			$('#removemulqus').hide();
	}
}

/*---
fn_preview()
Function to load user answer type boxes
----*/
function fn_preview(quesid)
{
	var dataparam = "oper=preview&anspattern="+$('#anspattern').val()+"&quesid="+quesid;	
	$.ajax({
		type: 'post',
		url: 'test/testassign/test-testassign-quscreationdb.php',
		data: dataparam,
		beforeSend: function(){
			showloadingalert('Loading, please wait.');	
		},		
		success:function(data) {			
			closeloadingalert();
			$('#preview').show();
			$('#preview').html(data);			
			var answer = $('#hidanswer').val();
			answer = answer.split(',');			
			var i=0;
			$("input[id='txt']").each(function(){
			   $(this).val(answer[i]);
			   i++;
			});
		},	
	});
}



/*----
fn_loadanswerchoice()
Function to load answer choises
----*/
function fn_loadanswerchoice(answertypeid,quesid) 
{	
	var counter = $('#selectcount').val();
	var mulboxvalues='';
	var mulboxanswers='';
	
	var dataparam = "oper=loadanswerchoice&answertypeid="+answertypeid+"&questionid="+quesid;	
	$.ajax({
		type: 'post',
		url: 'test/testassign/test-testassign-quscreationdb.php',
		data: dataparam,
		beforeSend:function()
		{
			$('#divloadanswer').show();
                        $('#divpreviewmatrices').hide();
			$('#divloadanswer').html(innercloading);
		},
		success:function(data)
		{
			$('#divloadanswer').html(data);
			$('#showstep').show();
                        if(answertypeid==16){
                            
                            $('#showstep').hide();
                            if(quesid!=0){
                                fn_matpreview(answertypeid,quesid);
		}
                          
                        }
		}
	});
}
 /************Custom Materices Code Start Here Developed by Mohan M 30-7-2015************/
 function fn_clkpreview(quesid) 
{
    if(quesid!=0){
         $('#previewclick').val(0);
    }
}
function fn_matpreview(answertypeid,quesid) 
{
    var mrow = $('#rowval').val();
    var mcol = $('#columnval').val();

    var mprecount = $('#previewclick').val();
    
     if(mrow==""){
            showloadingalert("Please enter a Rows value.");
            setTimeout('closeloadingalert()',1000);
            return false;  
    }
    if(mcol==""){
       showloadingalert("Please enter a Columns value.");
       setTimeout('closeloadingalert()',1000);
       return false;  
   }

    var dataparam = "oper=loadpreviewmatrices&answertypeid="+answertypeid+"&questionid="+quesid+"&mrow="+mrow+"&mcol="+mcol+"&mprecount="+mprecount;    
    $.ajax({
            type: 'post',
            url: 'test/testassign/test-testassign-quscreationdb.php',
            data: dataparam,
            beforeSend:function()
            {
                    $('#divpreviewmatrices').show();                   
            },
            success:function(data)
            {
                    $('#divpreviewmatrices').html(data);
                    $('#showstep').show();      
            }
    });
}


function acceptablerange(i) {
    if(i==1)
    {
        var mrow = $('#rowval').val();
        if((parseInt(mrow)) > 5)
        {

            var data ="Acceptable Range of rows value is 5. Try again";	  

            $.Zebra_Dialog("<div style='text-align:left'>"+data+"</div>",
            {
                'type':     'confirmation',
                'buttons':  [
                                {caption: 'OK', callback: function() {
                                    $('rowval').val('');
                                    $('rowval').focus();
                                }},
                            ]
            });
            $('.ZebraDialog').css({"posiion":"absolute","left":"50%","top":"50%","transform":"translate(-50%,-50%)","width":"450px"});
            closeloadingalert();

        }
    }
    
    if(i==2)
    {
        var mcol = $('#columnval').val();
        if((parseInt(mcol))> 5)
        {
            var data ="Acceptable Range of Columns value is 5. Try again";	  

            $.Zebra_Dialog("<div style='text-align:left'>"+data+"</div>",
            {
                'type':     'confirmation',
                'buttons':  [
                                {caption: 'OK', callback: function() {
                                    $('columnval').val('');
                                    $('columnval').focus();
                                }},
                            ]
            });
            $('.ZebraDialog').css({"posiion":"absolute","left":"50%","top":"50%","transform":"translate(-50%,-50%)","width":"450px"});
            closeloadingalert();

        }
    }
}
 /************Custom Materices Code End Here Developed by Mohan M 30-7-2015************/


/*----
fn_insertmathboxes()
Function to load text boxes match
----*/
function fn_insertmathboxes(answertypeid,questionid)
{	
	var dataparam = "oper=insertmathboxes&count="+$('#selectcount').val()+"&answertypeid="+answertypeid+"&qid="+questionid;	
	$.ajax({
		type: 'post',
		url: 'test/testassign/test-testassign-quscreationdb.php',
		data: dataparam,
		beforeSend: function(){			
		},
		success:function(ajaxdata) {
			$('#mulboxes').html(ajaxdata);	
		}
	});	
}

/*----
fn_addtoquestion()
Function to add question to the editor
----*/
function fn_addtoquestion(element,type) 
{	
	
	var equ_sym = $(element).attr("alt");
	var tempeq = '<span class="AM">`'+equ_sym+'`</span>&nbsp;';
	var editorcontent = tinyMCE.activeEditor.selection.getContent();	
	var totlen = (editorcontent.length-4);
	editorcontent = editorcontent.substring(0,totlen);
	
	tinyMCE.activeEditor.selection.setContent(editorcontent+"&nbsp;"+tempeq+"&nbsp;</p>");
	tinyMCE.activeEditor.focus();	
	if(type != 0) {
		hidealert();	
	}
}

/*----
fn_selectans()
Function to right/wrong button
----*/
function fn_selectans(type,id)
{	
	var flag = 0;
	if(type=='right1')
	{
		flag = 1;
		$('#PAR2_'+id).removeClass("red_dark");
		$('#PAR2_'+id).addClass("red_light");
		$('#PAR1_'+id).addClass("green_dark");
		$('#PAR1_'+id).removeClass("green_light");
	}
	
	if(type=='wrong1')
	{
		flag = 0;
		$('#PAR1_'+id).removeClass("green_dark");
		$('#PAR1_'+id).addClass("green_light");
		$('#PAR2_'+id).addClass("red_dark");
	}
	
	if(type=='yes1')
	{
		$('#yes1').val(1);
		$('#no1').val(0);
		$('#yes2').val(0);
		$('#no2').val(1);
		$('#PAR10').removeClass("red_dark");
		$('#PAR10').addClass("red_light");
		$('#PAR9').removeClass("green_light");
		$('#PAR9').addClass("green_dark");
		$('#PAR12').addClass("red_dark");
		$('#PAR11').removeClass("green_dark");
		$('#PAR11').addClass("green_light");
	}
	if(type=='no1')
	{
		$('#no1').val(1);
		$('#yes1').val(0);
		$('#yes2').val(1);
		$('#no2').val(0);
		$('#PAR9').removeClass("green_dark");
		$('#PAR9').addClass("green_light");
		$('#PAR11').removeClass("green_light");
		$('#PAR10').addClass("red_dark");
		$('#PAR11').addClass("green_dark");
		$('#PAR12').removeClass("red_dark");
		$('#PAR12').addClass("red_light");
	}
	if(type=='yes2')
	{
	
		$('#yes2').val(1);
		$('#no2').val(0);
		$('#yes1').val(0);
		$('#no1').val(1);
		$('#PAR12').removeClass("red_dark");
		$('#PAR12').addClass("red_light");
		$('#PAR11').removeClass("green_light");
		$('#PAR11').addClass("green_dark");
		$('#PAR10').addClass("red_dark");
		$('#PAR9').removeClass("green_dark");
		$('#PAR9').addClass("green_light");
	}
	if(type=='no2')
	{
		$('#no2').val(1);
		$('#yes1').val(1);
		$('#no1').val(0);
		$('#yes2').val(0);
		$('#PAR11').removeClass("green_dark");
		$('#PAR11').addClass("green_light");
		$('#PAR12').addClass("red_dark");
		$('#PAR9').removeClass("green_light");
		$('#PAR9').addClass("green_dark");
		$('#PAR10').removeClass("red_dark");
		$('#PAR10').addClass("red_light");
	}
}

/*----
fn_step2()
Function to save step 2
----*/
function fn_step2(quesid,testid)
{	
	var answertype = $('#answertypeid').val();
	var anschoicevalues = '';
	
	var frmvalid = false;
	frmvalid =  $("#questionforms").validate().form();
	
	if(frmvalid)
	{
		var question = '';
		
		//validate question
		if(encodeURIComponent(tinymce.get('txtquestioneditor').getContent())==0)
		{
			showloadingalert("Please Enter a Question");	
			setTimeout('closeloadingalert()',2000);
			$('#txtquestioneditor').focus();
			return false;
		}
		else
		{
			question = encodeURIComponent(tinymce.get('txtquestioneditor').getContent().replace(/tiny_mce\//g,""));
			$('#txtquestioneditor').html('');
		}
		
		//validate no.of boxes dropdown
		if(answertype==3 || answertype==9)
		{
			if($('#selectcount').val() == 0){
				showloadingalert("Please select no of boxes");	
				setTimeout('closeloadingalert()',2000);
				//alert("Please select no of boxes.");
				$('#selectcount').focus();
				return false;
			}
		}
		
		
		
		//multiple choice
		if(answertype==1)
		{
			var choicecnt = 0;
			var anschoice = "";
			var mulanschoice = 0;
			
			$('textarea[name^="txtanswereditor"]').each(function(index,element){
				var choiccontent = tinymce.get($(this).attr("name")).getContent();
				
				if($(this).parents('div[id^="TextBoxDiv"]:visible').attr("id"))
				{
					if(choiccontent != ''){
						choicecnt++;		
						if(anschoice == ''){
							anschoice = encodeURIComponent(choiccontent);
						}
						else {
							anschoice = anschoice +"~"+ encodeURIComponent(choiccontent);	
						}
					}
					else
					{
						mulanschoice++;						
					}
				}
				
			});
			
			if(mulanschoice > 0) {
				showloadingalert("Please enter all the answers");	
				setTimeout('closeloadingalert()',1000);
				return false;	
			}
			else if(choicecnt == 0 || choicecnt == 1) {
				showloadingalert("Please enter at least 2 answers");	
				setTimeout('closeloadingalert()',1000);
				return false;	
			}
			
			var chkcnt = 0;
			var chkcnt1 = 0;
			var anschoicecorrect = '';
			
			for(i=1;i<=8;i++)
			{
				var a = $('#ans'+i).val();				
				if(a==1 && tinymce.get($('#txtanswereditor'+i).attr("name")).getContent()!='')
				{
					var tempchk = i;
					if(anschoicecorrect == '')
					{
						anschoicecorrect = tempchk;	
					}
					else 
					{
						anschoicecorrect = anschoicecorrect+"~"+tempchk;
					}
					chkcnt++;
				}
				if(a==0)
				{
					chkcnt1++;
				}
				
			}			
			if(chkcnt == 0 || chkcnt1 == 8) {
				showloadingalert("Please select a correct answer");	
				setTimeout('closeloadingalert()',1000);
				return false;	
			}
			anschoicevalues = "&answer="+anschoice+"&correct="+anschoicecorrect;
		}
		
		//single Answer
		if(answertype==2)
		{
			if($('#txtsingleanswer').val()=='')
			{
				showloadingalert("Please Enter Answer");	
				setTimeout('closeloadingalert()',2000);				
				$('#txtsingleanswer').focus();
				return false;
			}
			
			var pretext = $('#pretext').val();
			var posttext = $('#posttext').val();
			anschoicevalues = "&answer="+encodeURIComponent($('#txtsingleanswer').val())+"&prefix="+pretext+"&suffix="+posttext;
		}
		
		//Match the following
		if(answertype==3)		
		{
			var counter = $('#selectcount').val();
			var mulboxvalues='';
			var mulboxanswers='';
			for(i=1; i<=counter; i++)
			{
				if(i==counter)
					mulboxvalues+=$('#mulbox'+i).val();
				else
					mulboxvalues+=$('#mulbox'+i).val()+'~';				 
			}	
			
			for(j=1; j<=counter; j++)
			{
				if(j==counter)
					mulboxanswers+=$('#ans'+j).val();
				else
					mulboxanswers+=$('#ans'+j).val()+'~';				 
			}

			anschoicevalues = "&prefix="+encodeURIComponent(mulboxvalues)+"&suffix="+encodeURIComponent(mulboxanswers);		
 		}
		
		//Custom Answer Type
		if(answertype==4)
		{
			var ordertype=$('input:radio[name=ordertype]:checked').val();
			var textvalue =[];
			$('input#txt').each(function(){
				var value = $(this).val();
				value = value.replace(",", "&#130 "); 
				textvalue.push(value);
			});
			anschoicevalues = "&patternanswer="+encodeURIComponent(textvalue)+"&pattern="+$('#anspattern').val()+"&ordertype="+ordertype;
		}

		//answer choice
		if(answertype==5)
		{
			var anschoicecorrect = '';
			var pretext =$('#pretext').val();
			var posttext =$('#posttext').val();
			
			for(i=1;i<=2;i++)
			{
				if($('#yesno'+i).val()=='yes')
				{
					anschoicecorrect = i;
				}
			}
			anschoicevalues = "&answer="+pretext+"~"+posttext+"&correct="+anschoicecorrect;
		}
		
		// menu & extream
		if(answertype==6)
		{
			var pretext = $('#pretext').val();
			var posttext = $('#posttext').val();
			anschoicevalues = "&answer="+encodeURIComponent($('#mean1').val())+"~"+encodeURIComponent($('#mean2').val())+"~"+encodeURIComponent($('#ext1').val())+"~"+encodeURIComponent($('#ext2').val());
		}
		
		//single answer range 
		if(answertype==7)
		{	
			var pretext = $('#pretext').val();
			var posttext = $('#posttext').val();
			var a='';
			var a = $('#loweranswer').val();
			var b='';
			var b = $('#upperanswer').val();
			
			if(parseInt(a.valueOf(),10) > parseInt(b.valueOf(),10) )
			{
				showloadingalert("Please Enter Greater Value than "+a);	
				setTimeout('closeloadingalert()',2000);				
				$('#upperanswer').focus();
				return false;
			}
			if(a=='')
			{
				showloadingalert("Please Enter Lower Value");	
				setTimeout('closeloadingalert()',2000);				
				$('#loweranswer').focus();
				return false;
			}			
			else if(isNaN(a))
			{
				showloadingalert("Please Enter numeric values");	
				setTimeout('closeloadingalert()',2000);				
				$('#loweranswer').focus();
				return false;
			}
			else if(b=='')
			{
				showloadingalert("Please Enter Upper Value");	
				setTimeout('closeloadingalert()',2000);				
				$('#upperanswer').focus();
				return false;
			}
			else if(isNaN(b))
			{
				showloadingalert("Please Enter numeric values");	
				setTimeout('closeloadingalert()',2000);				
				$('#upperanswer').focus();
				return false;
			}	
			anschoicevalues = "&answer="+encodeURIComponent($('#loweranswer').val())+'~'+encodeURIComponent($('#upperanswer').val())+"&prefix="+pretext+"&suffix="+posttext;
		}
		
		// multiple image
		if(answertype==8)
		{
			var imgcnt = 0;
			var anschoice = "";
			var mulansimg = 0;
			
			$('div[id^="img"]:visible').each(function(index, element) {
				var img = ($(this).attr('id').replace('img',''));
				if($('#image'+img).val() != '') {		
					imgcnt++;
					if(anschoice == ''){
						anschoice = $('#image'+img).val();
					}
					else {
						anschoice = anschoice +"~"+ $('#image'+img).val();	
					}
				}
				if($('#image'+img).val() == '') {
					mulansimg++;
				}
			});
						
			if(mulansimg > 0) {
				showloadingalert("Please upload all the choice images");	
				setTimeout('closeloadingalert()',1000);
				return false;	
			}
			else if(imgcnt < 2)
			{
				showloadingalert("Please upload at least two choice images");	
				setTimeout('closeloadingalert()',1000);
				return false;
			}
			
			var chkcnt = 0;
			var chkcnt1 = 0;
			var anschoicecorrect = '';
			
			for(i=1;i<=8;i++)
			{
				var a = $('#ans'+i).val();
				var temp_path = $('#txtimageans'+i).attr("src").split("/");
				var path1 = temp_path[(temp_path.length - 1)];
				if(a==1 && path1 != "no-image.png")
				{
					var tempchk = i;
					if(anschoicecorrect == '')
					{
						anschoicecorrect = tempchk;	
					}
					else 
					{
						anschoicecorrect = anschoicecorrect+"~"+tempchk;
					}
					chkcnt++;
				}
				if(a==0)
				{
					chkcnt1++;
				}
				
			}
			if(chkcnt == 0 || chkcnt1 == 8) {
				showloadingalert("Please select a correct answer");	
				setTimeout('closeloadingalert()',1000);
				return false;	
			}
			
			anschoicevalues = "&answer="+anschoice+"&correct="+anschoicecorrect;			
		}
		
		//single multiple
		if(answertype==9)		
		{
			var pretext = $('#pretext').val();
			var posttext = $('#posttext').val();
			var counter = $('#selectcount').val();
			var mulboxvalues='';
				
			for(i=1; i<=counter; i++)
			{
				if(i==counter)
					mulboxvalues+=$('#mulbox'+i).val();
				else
					mulboxvalues+=$('#mulbox'+i).val()+'~';	
			}
			
			anschoicevalues = "&answer="+encodeURIComponent(mulboxvalues)+"&prefix="+pretext+"&suffix="+posttext;
		}
		
		//drag and drop
		if(answertype==10)
		{
			var anscount=0;
			var counter = $('#selectcount').val();
			var listoptions='';
			var mulboxanswers='';
			$("span[id^=option_]").each(function(){	
				if(listoptions == ''){
					listoptions = $(this).html();
					
				}
				else
				 {
					listoptions = listoptions +"~"+ $(this).html();	
				}							
			});					
			for(j=1; j<=counter; j++)
			{
				if(j==counter)
					mulboxanswers+=$('#ans'+j).val();
				else
					mulboxanswers+=$('#ans'+j).val()+'~';	
				if($('#ans'+j).val()!='')
					anscount++;			 
			}
			
			if(anscount<counter)
			{
				showloadingalert("Please enter all the answers");	
				setTimeout('closeloadingalert()',1000);
				return false;
			}
			anschoicevalues = "&listoptions="+listoptions+"&correct="+mulboxanswers;	
		}
		
		/****this is for pull down */
		if(answertype==11)		
		{
			var anschoice='';
			var anschoicecorrect='';
			var count=0;
			var anscount=0;
			var listoptions='';
			
			$('div[id^="TextQusBox"]:visible').each(function(index,element){
				var pullqus = ($(this).attr('id').replace('TextQusBox',''));
				if($('#pullqus'+pullqus).val() != '') {		
					if(anschoice == ''){
						anschoice = encodeURIComponent($('#pullqus'+pullqus).val());
					}
					else {
						anschoice = anschoice +"~"+ encodeURIComponent($('#pullqus'+pullqus).val());	
					}
					if(anschoicecorrect=='')
					{
						anschoicecorrect = encodeURIComponent($('#pullans'+pullqus).val());	
					}
					else
					{
						anschoicecorrect =anschoicecorrect +"~"+ encodeURIComponent($('#pullans'+pullqus).val());	
					}
				}
				
				if($('#pullqus'+pullqus).val() == '') {
					count++;
					
				}
				if($('#pullans'+pullqus).val() == '') {
					anscount++;
					
				}
				});
				$("span[id^=opt_]").each(function(){	
					if(listoptions == ''){
						listoptions = $(this).html();
						
					}
					else
					 {
						listoptions = listoptions +"~"+ $(this).html();	
					}							
				  
				});	
				
				if(count!=0)
				{
					showloadingalert("Please enter  the question ");	
					setTimeout('closeloadingalert()',1000);
					return false;
				}
				if(anscount!=0)
				{
					showloadingalert("Please select the option ");	
					setTimeout('closeloadingalert()',1000);
					return false;
				}
				
			anschoicevalues = "&answer="+anschoice+"&correctpulldown="+anschoicecorrect+"&listoptions="+listoptions;
		}
		
		if(answertype==12)
		{
			var ballcount = $('#hidtextrowcnt').val();
			var ballcolor = $('#hidballcolor').val(); 
			var insideball = $('#hidinsideball').val(); 
			var outsideball = $('#hidoutsideball').val();
			var newball = ballcolor.split('~');
			var anscolor = '';
			var correct = '';
			var anocorrect = '';
			var count=0;
			var anocount=0;
			if(ballcount==newball.length && outsideball!='')
			{
				$('tr[id^="tanswerrow"]:visible').each(function(index,element){
					var ansboxid = ($(this).attr('id').replace('tanswerrow',''));
					
					if(anscolor=='')
						anscolor = $('#color'+ansboxid).html();
					else
						anscolor = anscolor +'~'+ $('#color'+ansboxid).html();
					
					if($('#correct'+ansboxid).val() != '') {
						count++;
						cor = $('#correct'+ansboxid).val();
					}
					else
						cor = '-';
					
					if(correct == '')
						correct = cor;
					else 
						correct = correct +"~"+ cor;
					
					if($('#anocorrect'+ansboxid).val() != '') {
						anocount++;
						anocor = $('#anocorrect'+ansboxid).val();
					}
					else
						anocor = '-';
						
					if(anocorrect == '')
						anocorrect = anocor;
					else 
						anocorrect = anocorrect +"~"+ anocor;	
				});
				if(count==0 && anocount==0)
				{
					showloadingalert("Please enter atlest one correct answer");	
					setTimeout('closeloadingalert()',1000);
					return false;
				}
				
				anschoicevalues = "&ballcolor="+ballcolor+"&insideball="+insideball+"&outsideball="+outsideball+"&dragcorrect="+correct+"&draganocorrect="+anocorrect+"&anscolor="+anscolor;
			}
			else if(ballcount!=newball.length)
			{
				showloadingalert("Please select the color");	
				setTimeout('closeloadingalert()',1000);
				return false;
			}
			else
			{
				showloadingalert("Please enter atleast one outsideball count");	
				setTimeout('closeloadingalert()',1000);
				return false;
			}
		}
		
		/***This is for drag and drop type-3********/
		if(answertype==13)		
		{
 			$('#hideimagedragpos').val();
			var anschoice = "";
			var points = 0;
 			if($('#hideimagename').val()=='')
			{
				showloadingalert("Please select for image for Drag and Drop");	
				setTimeout('closeloadingalert()',2000);
				return false;
			}
			
			$('div[id^="balldraggable"]:visible').each(function(index, element) {
				var val = ($(this).attr('id').replace('balldraggable',''));
				if($('#hideimagedragpos'+val).val() != '') {		
					if(anschoice == ''){
						anschoice = $('#hideimagedragpos'+val).val();
					}
					else {
						anschoice = anschoice +"~"+ $('#hideimagedragpos'+val).val();	
					}
				}
				if($('#hideimagedragpos'+val).val() == '') {
					points++;
				}
			});			
			if(points>0)
			{
				showloadingalert("Please drag all the point to the image");	
				setTimeout('closeloadingalert()',2000);
				return false;
			}
			anschoicevalues += "&answer="+$('#hideimagename').val()+"&correct="+anschoice;
 		}
		/*******End of drag and drop type 3********/
		
		if(answertype==14)
		{
			var iframe = document.getElementById('iframegraphline');
			var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
			var input = innerDoc.getElementById('hidlinevalue').value;			
			if($('#hideimagename').val()=='')
			{
				showloadingalert("Please select for image for Drag and Drop");
				setTimeout('closeloadingalert()',2000);
				return false;
			}
			if(input=='')
			{
				showloadingalert("Please draw the line");
				setTimeout('closeloadingalert()',2000);
				return false;
			}
			anschoicevalues += "&answer="+$('#hideimagename').val()+"&correct="+input;
		}
		
                if(answertype==16)
                {
                    var mrow = $('#rowval').val();
                    var mcol = $('#columnval').val();
                    var mprecount = $('#previewclick').val();     

                    var flag='0';
                    for(var k=1;k<=mrow;k++)
                    {
                        for(var l=0;l<mcol;l++)
                        {
                            var mm=$('#txt_'+k+"_"+l).val();
                            if(mm==''){
                                flag++;
                            }
                        }
                    }

                    if(flag!="0"){
                        showloadingalert("Please enter all values");
                        setTimeout('closeloadingalert()',1000);
                        return false;  
                    }

                    var k=0;
                    var detail=new Array();

                    for(var i=1;i<=mrow;i++)
                    {
                        for(var j=0;j<mcol;j++)
                        {
                            detail[k] = $('#txt_'+i+"_"+j).val();
                            if(j==(mcol-1)){
                                detail[k] = $('#txt_'+i+"_"+j).val()+"^";
                            }
                            k++;
                        }
                    }
                }
		
		var dataparam = "oper=savequestionbank&questionid="+quesid+"&question="+question+"&answertype="+answertype+anschoicevalues+"&tags="+escapestr($('#form_tags_questions1').val())+"&mrow="+mrow+"&mcol="+mcol+"&mprecount="+mprecount+"&detail="+detail+"&testid="+testid;
		$.ajax({
			type: "POST",
			url: 'test/testassign/test-testassign-quscreationdb.php',
			data: dataparam,
			beforeSend:function(){
				showloadingalert('Loading, please wait.');	
			},
			success: function(data){
				$('.lb-content').html('Saved Question successfully');
				setTimeout('closeloadingalert()',1000);
				
				if(testid !="qbank"){
					var val = testid;
					var sid = "4_testengine";
					
                                        setTimeout('removesections("#test-testassign-steps");',500);
			                setTimeout('showpages("test-testassign-testquestion","test/testassign/test-testassign-testquestion.php?id='+val+'");',500);
					setTimeout('showpages("test-testassign-addquestion","test/testassign/test-testassign-addquestion.php?id='+val+'&sid='+sid+'");',500);
					
				}
				else{
					if($('#form_tags').val()=='')					
						var sid = $('#form_tags_questions1').val();
					else
						var sid = $('#form_tags').val();
						
					removesections("#test");
					var values = "0_"+data;
					var datas = data+",qbank,edit";
				
					showpages("test-testassign-testenginequestion","test/testassign/test-testassign-testenginequestion.php?sid="+sid);
					setTimeout('showpages("test-testassign-qusactions","test/testassign/test-testassign-qusactions.php?id='+datas+'");',500);
					
				}
			}
		});
	}
	else {
		window.scrollTo(0,0);
	}
}

/***** Import excel sheet used code created by chandra start line ***********/
function fn_importexcelsheet(path){
	var actionmsg ="Saving Questions";
	dataparam="oper=importexcelsheet&path="+path;
	$.ajax({
		type: 'post',
		url:'test/testassign/test-testassign-quscreationdb.php',
		data: dataparam,
		beforeSend: function(){
			showloadingalert(actionmsg+", please wait.");	
		},
		success:function(ajaxdata){
			closeloadingalert();
			$.Zebra_Dialog('The spreadsheet has been successfully uploaded',
			{
				'type': 'confirmation',

			});
		}

	});

}

//Show import new question options
function fn_loadanswertype(answertypeid) 
{
	if(answertypeid == '1')
	{
		$('#multiplechoice').show();
	}
	
}
/***** Import excel sheet used code end line **********/