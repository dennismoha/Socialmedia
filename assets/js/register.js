//adding jquery to our page .we first google jquery lin
// then google hosted libraries
// scroll down and click Jquery
//then Jquery,  2.X snippet and copy it and paste it in the register.php underneath the css link


$(document).ready(function(){  
  //on click singup,hide login and show registration form
  $("#signup").click(function(){
      $("#first").slideUp("slow",function() {
       $("#second").slideDown("slow");   
      });
  });
  
  
  $("#signin").click(function(){
     $("#second").slideUp("slow",function() {
         $("#first").slideDown("slow");
     }) ;
  });

});
