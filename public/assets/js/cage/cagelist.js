
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var coupletable = $('#cagelist').DataTable({
    'aoColumns': [
        { "width": "20%" },
        { "width": "30%" },
        { "width": "20%" },
        { "width": "20%" },
        
        { "width": "10%" },
                
    ],
    language:{
        "sEmptyTable":     "Nessun dato presente nella tabella",
        "sInfo":           "Vista da _START_ a _END_ di _TOTAL_ elementi",
        "sInfoEmpty":      "Vista da 0 a 0 di 0 elementi",
        "sInfoFiltered":   "(filtrati da _MAX_ elementi totali)",
        "sInfoPostFix":    "",
        "sInfoThousands":  ",",
        "sLengthMenu":     "Visualizza _MENU_ elementi",
        "sLoadingRecords": "Caricamento...",
        "sProcessing":     "Elaborazione...",
        "sSearch":         "Cerca:",
        "sZeroRecords":    "La ricerca non ha portato alcun risultato.",
        "oPaginate": {
        "sFirst":      "Inizio",
        "sPrevious":   "Precedente",
        "sNext":       "Successivo",
        "sLast":       "Fine"
        },
        "oAria": {
        "sSortAscending":  ": attiva per ordinare la colonna in ordine crescente",
        "sSortDescending": ": attiva per ordinare la colonna in ordine decrescente"
        }
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
    $('#cagelist').on('click', 'i.fa-trash', function(e){

        target = $(e.target).parents('tr');
    
        $('#myModalLabel').html(window.lang.really_delete)

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
                $.post("cage/" + id +"/delete",
                {
                    
                },
                function(data, status){
                //    alert("Data: " + data + "\nStatus: " + status);
                    if(data=="ok" && status=="success"){
                        // $("#successToast .toast-body").html("success to delete");
                        // new bootstrap.Toast(document.querySelector('#successToast')).show();
                        show_notify(0,window.lang.success_to_delete);
                        coupletable
                        .row( target )
                        .remove()
                        .draw();                        
                    }
                    else{
                        // $("#failedToast .toast-body").html("failed to delete");
                        // new bootstrap.Toast(document.querySelector('#failedToast')).show();
                        show_notify(1,window.lang.failed_to_delete);
                    }
                });

                
                break;
        
        }
        
     
    }else{
      //Acciones si el usuario no confirma
      
    }
  });
  
$(document).ready(function() {


});