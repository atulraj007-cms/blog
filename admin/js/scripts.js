
$(document).ready(function () {
 
  ClassicEditor
 
    .create(document.querySelector('#body'))
 
    .catch(error => {
 
      console.error(error);
 
    });
 
});
 
 
$(document).ready(function () {
 
 
  $('#SelectAllBoxes').click(function (event) {
 
 
    if (this.checked) {
 
      $('.checboxes').each(function () {
 
 
 
        this.checked = true;
 
 
 
 
      });
 
 
    } else {
 
 
      $('.checboxes').each(function () {
 
 
 
        this.checked = false;
 
 
 
      });
    }
  });
});


var div_box = "<div id='load-screen'><div id='loading'></div></div>";

  $('body').prepend(div_box);

  $('#load-screen')
    .delay(700)
    .fadeOut(600, function () {
      $(this).remove();

    });

 function loadUsersOnline() {

$.get("function.php?onlineuser=result", function(data){

  $(".usersonline").text(data);


});



 }  
 
 setInterval(function(){

  loadUsersOnline();


 },500);

