<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="../assests/jquery/jquery.min.js"></script>
  <link rel="stylesheet" href="../assests/jquery-ui/jquery-ui.min.css">
  <script src="../assests/jquery-ui/jquery-ui.min.js"></script>
  <script src="../assests/bootstrap/js/bootstrap.min.js"></script>
 <script src="../assets/lib/jquery/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="../assests/metismenu/metisMenu.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="../assests/sparklines/jquery.sparkline.js"></script>
<script type="text/javascript">
$('.ticker').sparkline([1,2,3,4,5,4,3,2,1], { type:'bar', height:'30px', barWidth:15 });
</script>
<script>
  if (screen.width>10000){$(".sidebar").show();}
$(".bars-top").click(function (){
	$("#tops").toggleClass('greater');
var effect = 'slide';var varx="left";var options = {direction:varx};
var duration =800;$('.sidebar').toggle(effect,options,duration);
});

isClicked = function($i, e){return $i.length>0 && $(e.target).parents().andSelf().index($i)>-1;}
var width = screen.width;var height = screen.height;
$(".searchBtn-li").click(function(){$(".searchForm").show();});
$(document).click(function(e) {
	if (!isClicked( $('.searchForm') , e )){
	if (screen.width<=576 && !isClicked( $('.searchBtn-li') , e )){
		$('.searchForm').animate({height:"50px"});$(".suggestionBox").hide();
		$('.searchForm').hide();}
	else{$(".suggestionBox").hide();$('.searchForm').animate({height:"50px"});}
$(".searchForm").css({"-moz-box-shadow":"0px 0px 0px 0px #000","-webkit-box-shadow":"0px 0px 0px 0px #000","box-shadow":"0px 0px 0px 0px #000"});

	}
    if( isClicked( $('.sidebar') , e )){}
    	else if(isClicked( $('.bars-top') , e )){}
    		else{
    	if (screen.width<=576){
    var effect ='slide';var varx="left";
 var options ={direction:varx};var duration=500;
    	$('.sidebar').hide(effect,options,duration);
    	}
    	}
});
$('.searchTerm').focus(function(){
	$(".suggestion-content").show();});
$('.searchTerm').blur(function(){$(".suggestion-content").hide();});
$('.searchTerm').on("focus", function(){
    $(this).parent().animate({height:"400px"});
   $(".searchForm").css({"-moz-box-shadow":"-8px 8px 6px -6px #000","-webkit-box-shadow":"-8px 8px 20px -6px #000","box-shadow":"-8px 8px 20px -6px #000"});
     $(this).siblings('.suggestionBox').toggle();
    });
$(".suggestionBox li").click(function(){
	var rs=$(this).attr('rs');
	$('.searchTerm').html('hello');
});

</script>
