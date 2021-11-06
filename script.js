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
  //This function allows users to close menus using the ESC key
  $(document).ready(function(){
    $(document).bind('keydown', function(e) {
      if (e.which == 27) {
          document.getElementById("sidenav").style.width = "0";
          $(".search-bar").slideUp("slow");
      }
    });
  });
  //This function opens and closes the search bar
  $(window).click(function() {
    if ($(".sidenav").css("width")!="0px") {
      document.getElementById("sidenav").style.width = "0";
    }
    if (!searchHidden) {
      searchHidden = true;
      $(".search-bar").slideUp("slow");
    }
  });
  //These functions stop the search and side bars from disappearing when the other is clicked
  $(".sidenav").click(function(event){
    event.stopPropagation();
  });
  $(".search-bar").click(function(event){
    event.stopPropagation();
  });
  $(".button-search").click(function(event){
    event.stopPropagation();
  });
  //This function redirects to a php logout page
  $("#logout-button").click(function(){
    window.location.replace("logout.php");
  });
  //This function makes a log out button appear when hovering over the profile button
  $(".button-profile").mouseover(function(){
    $(".logout-dropdown").show();
  }).mouseout(function() {
    setTimeout(function() {
      $(".logout-dropdown").hide();
    }, 1000);
  });
  //This function triggers adding an item to a list
  $('.addToList').click(function(event){
    let url = "add_to_list.php?media_id="+event.target.id.substring(1);
    window.location.replace(url);
  });
});

