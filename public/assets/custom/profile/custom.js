function readURL(){
  const fi = document.getElementById('file');

  if (fi.files.length > 0) {
    const fsize = fi.files[0].size;
    const file = Math.round((fsize / 1024));
    if (file >= 200) {
      swal("File too Big!", "Please select a file less than 200KB!", "warning");
    } else {
      var elems = document.getElementsByClassName('update_img');
      console.log("file data: ", fi.files[0]);
      $('.update_img').attr("src", window.URL.createObjectURL(fi.files[0]));
      console.log("file URL data: ", window.URL.createObjectURL(fi.files[0]));
    }
  }
};

$(document).ready(function () {
  
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $("#update-profile").submit(function (event) {
    event.preventDefault();

    var files = $('#file')[0].files;
    
    //console.log("files.length", files.length);
    if(files.length > 0){
      var formData = new FormData(this);
    } else {
      var formData = {
        'name': $("#name").val(),
        'surname': $("#surname").val(),
        'nickname': $("#nickname").val(),
        'age': $("#age").val(),
        'option': $("#option").val(),
        'mycity': $("#mycity").val(),
        'mycap': $("#mycap").val(),
        'is_visible': $("#is_visible").val() == 'on' ? 1 : 0
      }
    }

    swal({
      title: "Are you sure?",
      text: "If you click OK button, your profile will be updated.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type: "POST",
          url: "/user-profile",
          data: formData,
          dataType: "json",
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            var baseUrl = "http://dashboard.parots.it/images/";

            swal("Profile Update Success!", {
                	icon: "success",
            	});

			$("#side_img").attr("src", baseUrl + data);
            $("#show_img").attr("src", baseUrl + data);
            $("#upload_img").attr("src", baseUrl + data);

            $.ajax({
              type: "GET",
              url: "/user-profile",
              data: "",
              dataType: "json",
              success: function (data) {
				
                $("#side_fullname").innerHTML = data.name + " " + data.surname;
                $("#side_option").innerHTML = data.option;
                $("#fullname").innerHTML = data.name + " " + data.surname;
                $("#disp_option").innerHTML = data.option;
                $("#disp_name").val(data.name);
                $("#disp_surname").val(data.surname);
                $("#disp_nickname").val(data.nickname);
                $("#disp_option").val(data.option);
                $("#disp_mycity").val(data.mycity);
                $("#disp_mycap").val(data.mycap);
  
                
              }
            });         
          },
          error: function (data) {
            swal("Profile Update Failed!", {
              icon: "warning",
            });
            console.log(data);
          }
        }).done(function (data) {
          console.log("profile updated!");
        });
      } else {
        swal("Operation Cancelled!", {
          icon: "warning",
        });
      }
    });
  });

  $("#update-password").submit(function (event) {
    swal({
      title: "Are you sure?",
      text: "If you click OK button, your password will be changed.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var current_pass = $("#password").val();
        var new_pass = $("#new_password").val();
        var confirm_pass = $("#password_confirmation").val();

        if(current_pass === "" || new_pass === "") {
          swal("Password Empty!", {
            icon: "warning",
          });
        } else if( new_pass === confirm_pass ) {
          var formData = {
            'password': current_pass,
            'new_password': new_pass
          }

          $.ajax({
            type: "POST",
            url: "/user-password",
            data: formData,
            dataType: "json",
            success: function (data) {
              swal("Success! Password Changed!", {
                  icon: "success",
              });
              $("#password").val("");
              $("#new_password").val("");
              $("#password_confirmation").val("");
            },
            error: function (data) {
              swal("Failed! Password Unchanged!", {
                icon: "warning",
            });
              console.log(data);
            }
          }).done(function (data) {
            console.log("Password Change Success!");
          });
        } else {
          swal("Password Confirm Error!", {
            icon: "warning",
          });
        }
      } else {
        swal("Operation Cancelled!", {
          icon: "warning",
        });
      }
    });
    event.preventDefault();
  });

  $("#update-email").submit(function (event) {
    swal({
        title: "Are you sure?",
        icon: "warning",
        text: "If you click OK button, your email address will be updated.",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
          var formData = {
            'email': $("#new_email").val()
          }
      
          $.ajax({
            type: "POST",
            url: "/user-email",
            data: formData,
            dataType: "json",
            success: function (data) {
              swal("Success! Email Changed!", {
                  icon: "success",
              });
              $("#disp_email").val(formData.email);
            },
            error: function (data) {
              swal("Failed! Email Unchanged!", {
                icon: "warning",
            });
              console.log(data);
            }
          }).done(function (data) {
            console.log(data);
          });
        } else {
            swal("Operation Cancelled!", {
              icon: "warning",
            });
        }
    });

    event.preventDefault();
    
  });
});
  