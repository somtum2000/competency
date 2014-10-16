(function ($) { 
  $(document).ready(function(){
    $('#nav ul li').each(function(){
      li_parent = $(this);
    
      if(li_parent.hasClass('menuparent')){
        li_parent_id = li_parent.attr('id');
       
   
        li_parent.children('ul').attr('id', 'submenu-'+li_parent_id);
        li_parent.children('a:first').attr('rel', 'submenu-'+li_parent_id);
      }
    });
        
    $('a.colorbox img').after('<span class="overlay zoom"></span>');
		$('#nav ul li a.active').parent('li').addClass('current');
		
		

		///////////////////////////////////
		//////// Social media tab /////////
		///////////////////////////////////
		$("#tab1").click(function() {
			$("#tab2_content").hide(1);
			$("#tab3_content").hide(1);
			$("#tab4_content").hide(1);
			$("#tab1_content").show(1);
			removeClass("selected");
			addClass("tab1","selected");
			
		});
		$("#tab2").click(function() {
			$("#tab1_content").hide(1);
			$("#tab3_content").hide(1);
			$("#tab4_content").hide(1);
			$("#tab2_content").show(1);
			removeClass("selected");
			addClass("tab2","selected");
		});
		$("#tab3").click(function() {
			$("#tab1_content").hide(1);
			$("#tab2_content").hide(1);
			$("#tab4_content").hide(1);
			$("#tab3_content").show(1);
			removeClass("selected");
			addClass("tab3","selected");
		});
		$("#tab4").click(function() {
			$("#tab1_content").hide(1);
			$("#tab2_content").hide(1);
			$("#tab3_content").hide(1);
			$("#tab4_content").show(1);
			removeClass("selected");
			addClass("tab4","selected");

		});
		
		function removeClass(ClassName) {
			for (var i=1; i<=4; i++) {
				$("#tab"+ i).removeClass(ClassName);
			}
		}
		
		function addClass(tabID, ClassName) {
			$("#"+tabID).addClass(ClassName);
		}


		// Request information form
   $("#requestsubmit").click(function(){
	
		var fname		= $.trim($("#firstname").val());
		var lname		= $.trim($("#lastname").val());
		var country	= $.trim($("#country").val());
		var phone		= $.trim($("#phone").val());
		var email		= $.trim($("#email").val());
		var level		= $.trim($("#level").val());
		var university	= $.trim($("#university").val());
		
		
		if(fname=='') {
			alert("Please enter first name");
			$("#firstname").focus();
			return false;
		} else if(lname=='') {
			alert("Please enter last name");
			$("#lastname").focus();
			return false;
		} else if(country=='') {
			alert("Please select country");
			$("#country").focus();
			return false;
		} else if(phone=='') {
			alert("Please enter phone number");
			$("#dayphone").focus();
			return false;
		} else if(email=='') {
			alert("Please enter email");
			$("#email").focus();
			return false;
		} else if(level=='') {
			alert("Please select level of education");
			return false;
		} else if(university=='') {
			alert("Please select university");
			$("#school").focus();
			return false;
		} else {			
			document.form_ri.submit();
		}			  
    }); 

  });
  
})(jQuery);

ddlevelsmenu.setup("nav", "topbar");