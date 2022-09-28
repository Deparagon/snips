
/*


*/
var editor;
var formdata;
$(document).ready(function(){
$('body').on('click', '.btn_for_object_update_add', function(ev){
	 ev.preventDefault();

	   let form_content = $(this).parents('form.form_for_object_update_add').serialize();
	   let inputs_only = $(this).parents('form.form_for_object_update_add').find('input, select').serialize();
	   
	   
     let btn= $(this);
     let btn_name = btn.html();
     btn.html(btn_name+'......');
     let action = btn.data('action');
     let object = btn.data('object');

     if(object=='Snip'){
     	let code_text = editor.getValue();
     	formdata = inputs_only+'&code_text='+code_text+'&token=B372A5BB8E4C4ED2A196B5EF2EF652B6&action='+action+'&object='+object;
      console.log(formdata);
     }
     else{
     	formdata = form_content+'&token=B372A5BB8E4C4ED2A196B5EF2EF652B6&action='+action+'&object='+object;
     }
   

	 $.ajax({
	 	   url:'processor.php',
	 	   type:'post',
	 	   data:formdata,
	 	   dataType:'json',
	 	   success:function(report){
	 	   	btn.html(btn_name);
	 	   	 if(report['status']=='OK'){
       $('.showmessage_heredata').html(showBoxMessage(report['message'], 'Success')).css('display', 'block');
       
     }
     if(report['status']=='NK'){
       $('.showmessage_heredata').html(showBoxMessage(report['message'], 'Error')).css('display', 'block'); 
     }
    
	 	   }
	 	    ,
	 	    error:function(report){
	 	    		btn.html(btn_name);
         $('.showmessage_heredata').html(showBoxMessage(report.responseText, 'Error')).css('display', 'block'); 
	 	    }

	 });

});

$('body').on('click', '.view_action_process', function(ev){
	 ev.preventDefault();
     let btn= $(this);
     let action = $(this).data('action');
     let object = $(this).data('object');
     let id = $(this).data('id');
	 let data = 'id='+id+'&token=B372A5BB8E4C4ED2A196B5EF2EF652B6&action='+action+'&object='+object;

	 $.ajax({
	 	   url:'processor.php',
	 	   type:'post',
	 	   data:data,
	 	   dataType:'json',
	 	   success:function(report){
	 	   	if(report['status']=='OK'){
       $('.showmessage_heredata').html(showBoxMessage(report['message'], 'Success')).css('display', 'block');
        
     }
     if(report['status']=='NK'){
       $('.showmessage_heredata').html(showBoxMessage(report['message'], 'Error')).css('display', 'block'); 
     }
     

           if(report['content']){
	 	   	  	$('#inside_view_content').html(report['content']);
	 	   	  	if(object =='Snip'){
	 	   	  		var textboxfile = document.getElementById('live_code_text');
          editor = CodeMirror.fromTextArea(textboxfile, {
            lineNumbers: true,
            mode: "javascript",
            keyMap: "sublime",
            autoCloseBrackets: true,
            matchBrackets: true,
            showCursorWhenSelecting: true,
            theme: "monokai",
            autoRefresh:true,
            tabSize: 5,
            indentUnit: 4
          });

	 	   	  	}

	 	   	  	$('#theview_editor_modal').modal('show');
	 	   	  	$('.add_object_box').find('.card-body').toggleClass('display_none');
	 	   	  }

	 	   }
	 	    ,
	 	    error:function(report){
          $('.showmessage_heredata').html(showBoxMessage(report.responseText, 'Error')).css('display', 'block'); 
	 	    }

	 });
});

$('body').on('click', '.delete_action_process', function(ev){
	 ev.preventDefault();
     let btn= $(this);
     let tr = $(this).parents('tr');
     let action = $(this).data('action');
     let object = $(this).data('object');
     let id = $(this).data('id');
	 let data = 'id='+id+'&token=B372A5BB8E4C4ED2A196B5EF2EF652B6&action='+action+'&object='+object;

	 $.ajax({
	 	   url:'processor.php',
	 	   type:'post',
	 	   data:data,
	 	   dataType:'json',
	 	   success:function(report){
	 	   	if(report['status']=='OK'){

       $('.showmessage_heredata').html(showBoxMessage(report['message'], 'Success')).css('display', 'block');
       tr.remove(); 
     }
     if(report['status']=='NK'){
       $('.showmessage_heredata').html(showBoxMessage(report['message'], 'Error')).css('display', 'block'); 
     }
    


           if(report['content']){
	 	   	  	$('.update_object_box').html(report['content']);
	 	   	  	$('.add_object_box').find('.card-body').toggleClass('display_none');
	 	   	  }

	 	   }
	 	    ,
	 	    error:function(report){
         $('.showmessage_heredata').html(showBoxMessage(report.responseText, 'Error')).css('display', 'block'); 
	 	    }

	 });
});

$('body').on('keyup', '#search', function(ev){
	 ev.preventDefault();
	    if( $(this).val().length < 3){
	    	return false;
	    }
     let action = $(this).data('action');
     let object = $(this).data('object');
	   let data = 'keyword='+$(this).val()+'&token=B372A5BB8E4C4ED2A196B5EF2EF652B6&action='+action+'&object='+object;

	 $.ajax({
	 	   url:'processor.php',
	 	   type:'post',
	 	   data:data,
	 	   dataType:'json',
	 	   success:function(report){
	 	   	  console.log(report);
	 	   	  if(report['content']){
	 	   	  	$('#search_show_box').html(report['content']);
	 	   	  }
	 	   	  if(report['status']=='OK'){
       $('.showmessage_heredata').html(showBoxMessage(report['message'], 'Success')).css('display', 'block'); 
     }
     if(report['status']=='NK'){
       $('.showmessage_heredata').html(showBoxMessage(report['message'], 'Error')).css('display', 'block'); 
     }
     


	 	   }
	 	    ,
	 	    error:function(report){
           $('.showmessage_heredata').html(showBoxMessage(report.responseText, 'Error')).css('display', 'block'); 
	 	    }

	 })


});



$('body').on('click', '.card-title', function(ev){

	  $(this).parents('.add_object_box').find('.card-body').toggleClass('display_none');

});

$('#table_data').DataTable({});


       var textboxfile = document.getElementById('code_text');
         var editor = CodeMirror.fromTextArea(textboxfile, {
            lineNumbers: true,
            mode: "javascript",
            keyMap: "sublime",
            autoCloseBrackets: true,
            matchBrackets: true,
            showCursorWhenSelecting: true,
            theme: "monokai",
            autoRefresh:true,
            tabSize: 5,
            indentUnit: 4
          });

});


function showBoxMessage(msg, msgtype ='Alert')
{
   if(msgtype =='Error'){
       return `<div class="alert alert-danger" role="alert">${msg} </div>`;
   }

   if(msgtype =='Success'){
       return `<div class="alert alert-success" role="alert">${msg} </div>`;
   }

   if(msgtype =='Info'){
       return `<div class="alert alert-info" role="alert">${msg} </div>`;
   }

   if(msgtype =='Alert'){
       return msg;
   }
}


function displayReport(report)
{
     
     scrollToMessage();
}
function scrollToMessage(element =$('.showmessage_heredata'))

{

  $('html, body').animate({

        scrollTop: element.offset().top-200

    }, 2000);

}


function displaySuccess(msg)
{
  $('.showmessage_heredata').html('<div role="alert" class="alert alert-success">'+msg+'</div>').css('display', 'block');
  scrollToMessage();
}

function displayFail(msg)
{
  $('.showmessage_heredata').html('<div role="alert" class="alert alert-danger">'+msg+'</div>').css('display', 'block');
  scrollToMessage();
}

function displayInfo(msg)
{
  $('.showmessage_heredata').html('<div role="alert" class="alert alert-info">'+msg+'</div>').css('display', 'block');
  scrollToMessage();
}

function displayWarn(msg)
{
  $('.showmessage_heredata').html('<div role="alert" class="alert alert-warning">'+msg+'</div>').css('display', 'block');
  scrollToMessage();
}














// /* global bootstrap: false */
