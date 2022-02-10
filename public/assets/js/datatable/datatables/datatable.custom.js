
var usertable = $('#userlist').DataTable({
    'aoColumns': [
        { "width": "25%" },
        { "width": "15%" },
        { "width": "25%" },
        { "width": "10%" },
        { "width": "10%" },
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
    $('#userlist').on('click', 'i.fa-trash', function(e){
        $('#myModalLabel').html("Do you really want to delete this user?")
        $("#mi-modal").modal('show');
        mode = 0;
        target = $(e.target).parents('tr');
        
    })

    
    $('#userlist').on('click', 'button.btn-primary', function(e){
        
        $('#myModalLabel').html("Do you really want to unsuspend this user?")
        
        $("#mi-modal").modal('show');

        mode = 2;
        target = $(e.target);
        // ... skipped ...
        
    });
    $('#userlist').on('click', 'button.btn-danger', function(e){

        $('#myModalLabel').html("Do you really want to suspend this user?")
        
        $("#mi-modal").modal('show');

        mode = 1;
        target = $(e.target);
        
        
    });
    
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
                $.post("api/user/" + id +"/delete",
                {
                    
                },
                function(data, status){
                //    alert("Data: " + data + "\nStatus: " + status);
                    if(data=="ok" && status=="success"){
                        // $("#successToast .toast-body").html("success to delete");
                        // new bootstrap.Toast(document.querySelector('#successToast')).show();
                        show_notify(0,window.lang.success_to_delete);
                        usertable
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
            case 1://suspend
                id = target.parents('tr').attr("data-id");
                $.post("api/user/" + id +"/setsuspend",
                {
                    status:1
                },
                function(data, status){
                //    alert("Data: " + data + "\nStatus: " + status);
                    if(data=="ok" && status=="success"){
                        // $("#successToast .toast-body").html("Updated successfully!");
                        // new bootstrap.Toast(document.querySelector('#successToast')).show();
                     
                        show_notify(0,"Updated successfully!");
                        target.addClass('d-none');
                        target.next().removeClass('d-none');                        
                    }
                    else{
                        show_notify(1,"Failed to udpated!");
                        // $("#failedToast .toast-body").html("Failed to udpated");
                        // new bootstrap.Toast(document.querySelector('#successToast')).show();
                     
                    }
                });
    
                break;
            case 2://unsuspend
                id = target.parents('tr').attr("data-id");
                $.post("api/user/" + id +"/setsuspend",
                {
                    status:0
                },
                function(data, status){
                //    alert("Data: " + data + "\nStatus: " + status);
                    if(data=="ok" && status=="success"){
                        // $("#successToast .toast-body").html("Updated successfully!");
                        // new bootstrap.Toast(document.querySelector('#successToast')).show();
                        show_notify(0,"Updated successfully!");
                        target.addClass('d-none');
                        target.prev().removeClass('d-none');                        
                    }
                    else{
                        // $("#failedToast .toast-body").html("Failed to udpated");
                        // new bootstrap.Toast(document.querySelector('#successToast')).show();
                        show_notify(1,"Failed to udpated!");
                    }
                });
    
                break;
        }
        
     
    }else{
      //Acciones si el usuario no confirma
      
    }
  });
  $("input[type=checkbox]").on("click", function(evt){
    evt.preventDefault();
    var id = $(this).parents('tr').attr("data-id");
    var role;
    
    if ($(this).is(":checked")==false){
        role = 2;
       
    }
    else{
        role = 1;
       
    }
    $.post("api/user/" + id +"/setSuperadmin",
        {
            role:role
        },
        function(data, status){
        //    alert("Data: " + data + "\nStatus: " + status);
        
            if(status=="success"){
                show_notify(0,"Updated successfully!");
                // $("#successToast .toast-body").html("Updated successfully!");
                // new bootstrap.Toast(document.querySelector('#successToast')).show();
                data = JSON.parse(data);
                
                if (data['role'] == 1){
               
                    $(evt.target).prop( "checked", true );
                }
                else{
                  
                    $(evt.target).prop( "checked", false );
                }
            }
            else{
                // console.log($(this).prop('checked'));
                if (role == 2){
                   
                    $(evt.target).prop('checked',true );
                }
                else{
                   
                    $(evt.target).prop('checked', false);
                }
                // $("#failedToast .toast-body").html("Failed to udpated");
                // new bootstrap.Toast(document.querySelector('#failedToast')).show();
                show_notify(1,"Failed to udpated");
            }
        });
  });
   
$(document).ready(function() {

    //seach API regular expression start
    //Ajax Data Source (Arrays) start 
    // $('#ajax-data-array').DataTable({
        
    //     ajax: {
    //         url: "/api/users",
    //         dataSrc: 'data'
    //     },
    //     columns: [
    //         { data: 'name' },
    //         { data: 'email' },
    //         { data: 'nickname' },
    //         { data: 'age' },
    //         { data: 'type' },
    //         { data: 'farm_address' }
    //     ]
    // });

   
    
    // $('#ajax-data-array').DataTable( {
    //     ajax: {
    //                 url: "/api/users",
    //                 dataSrc: 'data'
    //             },
    //     columns: [
    //         { data: 'name' ,
    //         sortable: false},
            
    //         { data: 'surname' },
    //         { data: 'email' },
    //         {
    //             data: null,
    //             className: "dt-center editor-edit",
    //             defaultContent: '<i class="fa fa-pencil"/>',
    //             orderable: false
    //         },
    //         {
    //             data: null,
    //             className: "dt-center editor-delete",
    //             defaultContent: '<i class="fa fa-trash"/>',
    //             orderable: false
    //         },
    //         {
    //             data: null,
    //             className: "dt-center ",
    //             defaultContent: '<i class="fa fa-eye"/>',
    //             orderable: false
    //         }
    //     ]
    // } );

   
    //datatable dom ordering end here


});