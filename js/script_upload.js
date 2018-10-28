// CUSTOM SCRIPTS

$(document).ready(function(){
  //process the form
  $('form').submit(function(event) {

    //get the form data

    var attend = $('input[name=attendance]').val();
    var firstTest = $('input[name=firsttest]').val();
    var secondTest = $('input[name=secondtest]').val();

    //process the form

    $.ajax({
      type  : 'POST',     //type of HTTP verb
      url   : 'pro.php',  //the url we are posting our data to
      data  : {attendance : attend,firsttest : firstTest, secondtest : secondTest}, //our data object
      datatype : 'json'  //type of data we are expecting back
      // encode  : true
    })
    //using the done promise callback
    .done(function(data) {
       //handle errors
      //    $('#messages').append('<div class="alert alert-danger">'+ data.errors +'</div>');
      // //   // alert(data.message);
      // }
      //  else{
      //    $('#messages').append('<div class="alert alert-success">'+ data.message +'</div>');
      //  }
      console.log(data);
  });
  event.preventDefault();
 });
});
