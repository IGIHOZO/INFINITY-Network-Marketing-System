(function ($) {
    "use strict";

    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })
    })

  function url(m,u,d){
  var req=$.ajax({type:m,url:u,cache:false,async:true,data:d});
  req.fail(function(JqXHR,textStatus){alert('Check your internet Connection');});
return req;
}

$("#pincode-owner").change(function(){
  if ($(this).val()=='you'){$(".display-becouse").hide();}
  else if($(this).val()=='member'){$(".display-becouse").show();}
  else{$(".display-becouse").hide();}
});

$(".display-before").hide();
var inputs=$("#sign-up-form .input100");
var inputs2=$("#sign-up-form .inputs");
inputs2.mouseenter(function(){$(this).css({"border":"1px solid #909497"});});
$("#sign-up-form").on('submit',function(e){
    e.preventDefault();
   var check=true;

   var thisform=$(this).attr('SignUp');
   if (thisform=="form-2"){
   for (var i=0;i<inputs2.length;i++){
    if (validate(inputs2[i])== false){
    var obj=$(inputs2[i]);
    obj.css({"border":"1px solid #ed292a"});
    check=false;
    }
   }

   }
    else{
    for(var i=0;i<inputs.length;i++) {
            if(validate(inputs[i]) == false){
                showValidate(inputs[i]);
                check=false;
            }
        }
   }
   
        if (check==true){
if (thisform=="form-2"){$("#fnames,#lnames,#nmPin").removeAttr('disabled');}
            $("#signUpClick").html('Wait....').attr("disabled",true);
             var datas=$("#sign-up-form").serialize();
         datas +="&registerDistr=1&d_uname=1";
     var pagings="../assests/ajax/YYUIUTYTGFSDJFKSDRHKHFJFHSKRODJSKRJDKSKRDSSKDFDSFPOLLIJUYSDSD";
       var  rexqtt=url("get",pagings,datas);
     rexqtt.done(function(res){
    if (thisform=="form-2"){$("#fnames,#lnames,#nmPin").attr('disabled',true);}
         $("html, body").animate({scrollTop: 0},"slow");//removeAttr("disabled",true);
         if (res.indexOf('Do you really want to register')>-1){ 
             $("#signUpClick").html('Confirming...');
           $(".error-label3").hide().show();
         $(".error-label3 .repon").html(res);
     }else{
     $("#signUpClick").html('SIGN UP').removeAttr("disabled",true);
       $(".error-label3").hide();
     $(".error-label2").hide().show().html(res);

         }

     });
             }
        return check;

});


$(".printer").click(function () {var con=$(this).attr("ref");printContent(con);});
function printContent(div){
        var contents = $(div).html();
        var frame1 = $('<iframe/>');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>Print Content</title>');
        frameDoc.document.write('</head><body>');
      frameDoc.document.write('<link href="../assests/css/print.css" rel="stylesheet" type="text/css"/>');
        frameDoc.document.write('<div class="watermark"><img class="img-water" src="../img/logo.png"></div>');
        frameDoc.document.write('<div class="top">RS EMPIRE Co Ltd<br>TIN NO:108852122<br>www.rsempire.net<br>Email:rsempire@gmail.com<br>Tel:+250838435/+250876533</div>');
        frameDoc.document.write('<div class="base-lines">'+$("#fname-v").val()+' '+ $("#lname-v").val()+'</div>');
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 100);

}





$("#new-memberse").click(function(){
  var inputs=$("#sign-up-form .input100");
  inputs.val(' ');$(".display-first").hide();$(".display-before").hide();
  $(".error-label3").hide();$("#signUpClick").html('SIGN UP').removeAttr("disabled",true);
});

$("#cancel-this").click(function(e){
    e.preventDefault();
   var thisform=$("#sign-up-form").attr('SignUp');
    if (thisform=="form-2"){$("#fnames,#lnames,#nmPin").attr('disabled',"true");}
    $(".error-label3").hide();$("#signUpClick").html('SIGN UP').removeAttr("disabled",true);
});

$("#confirm-this").click(function(e){
    e.preventDefault();
$("#confirm-this").attr('disabled','true');
$("#cancel-this").attr('disabled','true');
var thisform=$("#sign-up-form").attr('SignUp');
if (thisform=="form-2"){$("#fnames,#lnames,#nmPin").removeAttr('disabled');}

      $(".error-label3 .repon").html('Please Wait...');
var datas=$("#sign-up-form").serialize();
datas +="&registerDistr=1&confirmed=1&d_uname=1";
var pagings="../assests/ajax/YYUIUTYTGFSDJFKSDRHKHFJFHSKRODJSKRJDKSKRDSSKDFDSFPOLLIJUYSDSD";
var  rexqtt=url("get",pagings,datas);
rexqtt.done(function(res){
    var thisform=$("#sign-up-form").attr('SignUp');
    if (thisform=="form-2"){$("#fnames,#lnames,#nmPin").attr('disabled',"true");}

  if (res.indexOf('has been registered')>-1){
$(".error-label3 .repon").html(res);
$(".display-first").hide();$(".display-before").show();
}else{
    $(".error-label2").html(res);$(".error-label3").hide();}
});
});


    var input1 = $('.validate-input .input100');
    $('.validate-form').on('submit',function(e){
        e.preventDefault();
        var check = true;
        for(var i=0; i<input1.length;i++) {
            if(validate(input1[i]) == false){
                showValidate(input1[i]);
                check=false;
            }
        }
        if (check==true){
            $("#button-login").attr('disabled',true);
            $("#button-login").html('Wait...');
var data=$(".validate-form").serialize();
var page="../assests/ajax/YYUIUTYTGFSDJFKSDRHKHFJFHSKRODJSKRJDKSKRDSSKDFDSFPOLLIJUYSDSD";
  data +="&mLogin=true";
   var  urlx=url("GET",page,data);
   urlx.done(function(res){
    if (res.indexOf('Login successful') > -1){
$("#resp_n").hide();$("#resp").hide().show('drop').html('<span style="color:white">'+res+'</span>');
    }else{
        $("#button-login").removeAttr('disabled');
        $("#button-login").html('LOGIN');
  $("#resp").hide();$("#resp_n").hide().show('drop').html('<span style="color:white">Wrong username and/or password</span>');
    }

});
        }

        return check;
    });


    $(".btn3432").click(function(e){
       e.preventDefault();
    var upcode=$("#ref_id").val();var check=true;
    if($("#ref_id").val().trim().match(/^[a-zA-Z0-9 ,-/ ]+$/i) == null){check=false;}
    var datas="upcode="+$("#ref_id").val();
    datas +="&checkUpline=1";
    var pagings="../assests/ajax/YYUIUTYTGFSDJFKSDRHKHFJFHSKRODJSKRJDKSKRDSSKDFDSFPOLLIJUYSDSD";
    var  rexqtt=url("get",pagings,datas);
    rexqtt.done(function(res){$("#resp_upl").html(res);});
    });

$('.form-generate-pincode').on('submit',function(e){
    e.preventDefault();
     var check=true;
     var insy=$(".form-generate-pincode input");
        var check = true;
        for(var i=0; i<insy.length;i++) {
            if(validate(insy[i]) == false){
            showValidate2(insy[i]);
                check=false;
            }else{hideValidate2(insy[i]);}
        }
        if (check==true){
var dat= $(".form-generate-pincode").serialize();
dat +="&addDistributor=true";
var pageM="../assests/ajax/YYUIUTYTGFSDJFKSDRHKHFJFHSKRODJSKRJDKSKRDSSKDFDSFPOLLIJUYSDSD";
var mcvd=url("GET",pageM,dat);
mcvd.done(function(res){
$("#resp_pincodes").html(res);
});
        }
});

function commas(x){return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");}
$(".buttonbvcd").click(function(){$(".all-lixs").css({"display":"none"});});
$(".li-all").on('click',function(){$(".all-lixs").css({"display":"block"});});
$(".choose-account-ul").mouseleave(function(){$(".all-lixs").css({"display":"none"});});
$(".lixs").click(function(){
  $(".lixs").removeAttr('currentli','false');
  $(this).attr('currentli','true');
    $('.check2').hide();
    $(this).children('.check2').show();
var mnv=$(this).attr('nn');var account=$(this).attr('account');
$(".choose-account-ul .li-all").attr('nn',mnv);
$(".choose-account-ul .li-all").attr('account',account);
$(".li-all  .account-label").html("ACCOUNT:  "+ account);
$("#input-balance").attr('vl',mnv);
$("#input-balance").attr('value',"RWF "+commas(mnv));
$(".all-lixs").css({"display":"none"});
});

$("#typex").change(function(){
    $("#make-encash").attr('disabled','true');
    $(".dv-encash-bank").html('Please Wait....');
    var dty="onSelectEncash=1&encash-type="+$(this).val();
$.ajax({type:'GET',url:'../assests/ajax/main.php',data:dty,success:function(res){
    $("#make-encash").removeAttr('disabled');
    $(".dv-encash-bank").html(res);}});
});

$("#encash-form").submit(function(e){
  $(".response-rs2").hide();
    e.preventDefault(); var check=true;
    var inpux=$("#encash-form .inputs");
   if ($(".li-all").attr('nn')<8000 || $("#input-balance").attr('vl')<8000){
      $(".response-rs").hide().show('slide').html('Choose Account with minimum amount of  8,000 RWF');
    check=false;$(".li-all").css({"border":"1px solid #ed292a"});}
    for (var i =0;i <inpux.length;i++) {
     if (validate(inpux[i])== false){
    var obj=$(inpux[i]);
    obj.css({"border":"1px solid #ed292a"});
    check=false;
    }   
    }
  var balance=parseInt($("#input-balance").attr('vl'));var am=parseInt($("#inputsamount").val());
    if (am<8000){check=false;$(".response-rs").hide().show('slide').html('The minimum amount to encash is 8,000 RWF');}
    if (am>balance) {check=false;$(".response-rs").hide().show('slide').html('Enter the Amount less or equal to your account balance');}
    if (check==true){
      $("#make-encash").attr('disabled','true');
  var dtvy=$(this).serialize()+"&encash-account="+$(".choose-account-ul .li-all").attr('account');
     dtvy +="&setEncashment=1"; 
$.ajax({type:'GET',url:'../assests/ajax/main.php',data:dtvy,success:function(res){
   $("#make-encash").removeAttr('disabled','true');
  if (res.indexOf('has been requested successfully')>-1) {
  $(".response-rs").hide();$(".response-rs2").hide().show('slide').html(res);
  var remain=balance-am;
  $("#encash-form .inputs").val(' ');
  $("#input-balance").attr('vl',remain);
  $(".li-all").attr('nn',remain);
  var thislix=$(".li-all .lixs");
  for (var i =0;i<thislix.length;i++){
    if ($(thislix[i]).attr('currentli')=='true'){
      $(thislix[i]).attr('nn',remain);
       $(thislix[i]).children('.money-li').html('RWF '+ commas(remain));
    }
  }

  $("#input-balance").attr('value','RWF'+commas(remain));
  }else{
    $(".response-rs2").hide();
$(".response-rs").hide().show('slide').html(res);
  }
}});   
    }
    
   
});



var selCountry='1';$.ajax({type:'GET',url:'../assests/ajax/main.php',data:{selCountry:selCountry},success:function(res){$("#countries").html(res);}});

var dats="UpdateBalances=1&ds=1";
$.ajax({type:'GET',url:'../assests/ajax/main.php',data:dats,success:function(res){}});
   

    $('.input100').each(function(){$(this).focus(function(){hideValidate(this);});});
    $('.inputs').each(function(){$(this).focus(function(){hideValidate2(this);});});

    function validate (input){
  if($(input).attr('valid') == 'email'){
    if ($(input).val()=="") {return true;}
        else{
if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
        return false;
            }        
        }
    
        }
if ($(input).attr('valid') == 'names') {
     if ($(input).val().trim().match(/^[a-zA-Z0-9 ,-/ ]+$/i) == null){
        return false;
     }
  }

if ($(input).attr('valid') == 'password' ) {
     if ($(input).val().trim().match(/^[a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]{8,}$/g) == null){
        return false;
     }
  }

  if ($(input).attr('valid') == 'confirm-password' ) {
    var confirmObj=$(input).attr('confirmPw');var confirmPw=$(confirmObj).val();
    if (confirmPw==$(input).val()) {
      if ($(input).val().trim().match(/^[a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]{8,}$/g) == null){
         return false;
      }
    }else{return false;}

    }


if ($(input).attr('valid') == 'rwanda-id') {
     if ($(input).val().trim().match(/^(119[2-9]{1}[0-9]{1}[8,7]{1}[0-9]{7}[0-9]{1}[0-9]{2})+$/i) == null &&
         $(input).val().trim().match(/^(1200[0-9]{1}[8,7]{1}[0-9]{7}[0-9]{1}[0-9]{2})+$/i) == null){
        return false;
     }
  }

if ($(input).attr('valid') == 'number') {
    if ($(input).val().trim().match(/^[0-9]+$/i) == null){return false;}
  }

  if ($(input).attr('valid') == 'dob') {
if ($(input).val().trim().match(/^\d{2}[./-]\d{2}[./-]\d{4}$/) == null && $(input).val().trim().match(/^\d{4}[./-]\d{2}[./-]\d{2}$/) == null){return false;}
  }

   if ($(input).attr('valid') == 'rwanda-phone' ) {
if ($(input).val().trim().match(/^(7[2,3,8]{1}[0-9]{7})+$/i) == null){return false;}
  }

  if ($(input).attr('valid') == 'fname') {
if ($(input).val().trim().match(/^[a-zA-Z ]+$/i) == null){return false;}
  }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input){
        var thisAlert = $(input).parent();
        $(thisAlert).addClass('alert-validate'); }
    function hideValidate(input){
        var thisAlert = $(input).parent();
        $(thisAlert).removeClass('alert-validate');}
    function showValidate2(input){
         var thisAlert =$(input).closest(".form-element").find(".span-error");
        $(thisAlert).show().html(thisAlert.attr('valid-data')); }

  function showValidate2(input){
    $(input).css({"border":"5px solid #ed292a"});
         }

    function hideValidate2(input){
        var thisAlert =$(input).closest(".form-element").find(".span-error");
        $(thisAlert).hide().html('');}

})(jQuery);
