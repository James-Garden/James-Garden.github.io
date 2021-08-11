var searchHidden = true; //This defines the initial state of the search bar

$(document).ready(function(){ //This function triggers when the page is fully loaded
  $('#media_type').on('change', function() {
    if ($('select#media_type').val()=="film") {
      $('#book_form').css('display',"none");
      $('#tv_form').css('display',"none");
      $('#film_form').css('display',"block");
    }
    if ($('select#media_type').val()=="tv_series") {
      $('#book_form').css('display',"none");
      $('#tv_form').css('display',"block");
      $('#film_form').css('display',"none");
    }
    if ($('select#media_type').val()=="book") {
      $('#book_form').css('display',"block");
      $('#tv_form').css('display',"none");
      $('#film_form').css('display',"none");
    }
      //document.getElementById(divId).style.display = element.value == 1 ? 'block' : 'none';

  });
  $(".button-search").click(function(){
    if (searchHidden) {
      searchHidden = false;
      $(".search-bar").slideDown("slow");
    } else {
      searchHidden = true;
      $(".search-bar").slideUp("slow");
    }
  });
  //This is the function for opening the side menu
  $(".button-menu").click(function(){
    document.getElementById("sidenav").style.width = "15vw";
  });
  //This is the function for closing the side menu
  $(".button-close-side-menu").click(function(){
    document.getElementById("sidenav").style.width = "0";
  });
  $(document).ready(function(){
    $(document).bind('keydown', function(e) {
      if (e.which == 27) {
          document.getElementById("sidenav").style.width = "0";
          $(".search-bar").slideUp("slow");
      }
    });
  });
  $(window).click(function() {
    if ($(".sidenav").css("width")!="0px") {
      document.getElementById("sidenav").style.width = "0";
    }
    if (!searchHidden) {
      searchHidden = true;
      $(".search-bar").slideUp("slow");
    }
  });
  $(".sidenav").click(function(event){
    event.stopPropagation();
  });
  $(".search-bar").click(function(event){
    event.stopPropagation();
  });
  $(".button-search").click(function(event){
    event.stopPropagation();
  });
});
