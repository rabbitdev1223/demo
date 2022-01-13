function triggerClick(e) {
    document.querySelector('#profileImage').click();
  }
  function displayImage(e) {
    if (e.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
    }
  }
$(document).ready(function(){
  $('select[name=breed]').select2();
  $('input[name=date_of_birth]').datepicker({
    language: 'en',
    maxDate: new Date() // Now can select only dates, which goes after today
})
});