
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function show_notify(error,msg){
  if(error == 0){
      $.notify({
          title:'Success',
          message:msg
       },
       {
          type:'primary',
          allow_dismiss:false,
          newest_on_top:false ,
          mouse_over:false,
          showProgressbar:false,
          spacing:10,
          timer:2000,
          placement:{
            from:'top',
            align:'right'
          },
          offset:{
            x:30,
            y:30
          },
          delay:1000 ,
          z_index:10000,
          animate:{
            enter:'animated bounce',
            exit:'animated bounce'
        }
      });
  }
  else{
      $.notify({
          title:'Failed',
          message:msg
       },
       {
          type:'danger',
          allow_dismiss:false,
          newest_on_top:false ,
          mouse_over:false,
          showProgressbar:false,
          spacing:10,
          timer:2000,
          placement:{
            from:'top',
            align:'right'
          },
          offset:{
            x:30,
            y:30
          },
          delay:1000 ,
          z_index:10000,
          animate:{
            enter:'animated bounce',
            exit:'animated bounce'
        }
      });
  }
}
var mode = 0; //0:delete user;1:suspend user;2:unsuspend user;

var modalConfirm = function(callback){
  
  //when click delete button
  $('#couplelist').on('click', 'i.fa-trash', function(e){

      target = $(e.target).parents('tr');
      
      $('#myModalLabel').html(window.lang.my_couple);
      
      $("#mi-modal").modal('show');
      mode = 0;
     
  })
  
  $("#modal-btn-si").on("click", function(){
    callback(true);
    $("#mi-modal").modal('hide');
  });
  
  $("#modal-btn-no").on("click", function(){
    callback(false);
    $("#mi-modal").modal('hide');
  });
};

modalConfirm(function(confirm){
  if(confirm){
    
      switch(mode){
          case 0:
              id = target.attr("data-id");
              $.post("couple/" + id +"/delete",
              {
                  
              },
              function(data, status){
              //    alert("Data: " + data + "\nStatus: " + status);
                  if(data=="ok" && status=="success"){
                      // $("#successToast .toast-body").html("success to delete");
                      // new bootstrap.Toast(document.querySelector('#successToast')).show();
                      show_notify(0,"success to delete");
                      coupletable
                      .row( target )
                      .remove()
                      .draw();                        
                  }
                  else{
                      // $("#failedToast .toast-body").html("failed to delete");
                      // new bootstrap.Toast(document.querySelector('#failedToast')).show();
                      show_notify(1,"Failed to delete");
                  }
              });

              
              break;
      
      }
      
   
  }else{
    //Acciones si el usuario no confirma
    
  }
});

