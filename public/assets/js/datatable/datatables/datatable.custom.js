
var usertable = $('#userlist').DataTable({
    'aoColumns': [
        { "width": "25%" },
        { "width": "20%" },
        { "width": "30%" },
        { "width": "15%" },
        { "width": "10%" },
       
    ]
});

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
                        usertable
                        .row( target )
                        .remove()
                        .draw();                        
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
                        target.addClass('d-none');
                        target.next().removeClass('d-none');                        
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
                        target.addClass('d-none');
                        target.prev().removeClass('d-none');                        
                    }
                });
    
                break;
        }
        
     
    }else{
      //Acciones si el usuario no confirma
      
    }
  });

  
$(document).ready(function() {
    $('.toast').toast('show');
    
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