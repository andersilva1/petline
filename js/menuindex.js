$(document).ready(function() {
    $("#sidebarCollapse").on("click", function() {
      $("#sidebar").toggleClass("active");
      $(this).toggleClass("active");
    });
  });

  //Inicio seção noticias
    /* Demo purposes only */
    $(".hover").mouseleave(
      function () {
        $(this).removeClass("hover");
      }
    );

  //Fim seção noticias