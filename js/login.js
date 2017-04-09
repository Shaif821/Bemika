window.addEventListener("load", function(){



    //  var logo = document.getElementById("logo");
      var loginError = document.getElementById("loginError");

    //  logo.style.transition = "transform 0.5s linear 1s";
      //logo.style.transform = "rotate(46deg)";

      /*$(function(){

           $(loginError).animate({

               zIndex: 2,
               opacity: 1,
               right: 30,


           },{

                duration: 4200,
                easing: "easeInOutBack",

           })

      })*/


      var fcc = document.querySelectorAll("#passRecovery p");

      for (var i = 0; i < fcc.length; i++) {

          var fccArr = fcc[i];

          fccArr.addEventListener("click", function(e){

              var id = e.target.id;
              //alert(id);
              var forms = document.querySelector("."+id);
              //alert(forms.className);

              $(function(){

                  $(forms).animate({

                      bottom: 450,


                  },{

                      duration: 700,
                      easing: "easeOutBack",

                  })

              })

          })

      }


      var icon_cross = document.querySelectorAll(".icon-cross");

      for (var i = 0; i < icon_cross.length; i++) {

          var icon_crossArr = icon_cross[i];

          icon_crossArr.addEventListener("click", function(e){

              var parent = e.target.parentNode;

              $(function(){

                  $(parent).animate({

                     bottom: 0,

                  },{

                      duration:  700,
                      easing: "easeInOutBack",

                  })

              })

          })

      }


      var loginForm = document.getElementById("loginForm");
      var guestLoginForm = document.getElementById("guestLoginForm");
      //var modes = document.getElementById("modes");

      function LoginModes()
      {

          modes.addEventListener("click", function(e){

                if(e.target.textContent == "Login as guest user")
                {

                    e.target.innerHTML = "Login as admin";

                    loginForm.style.transform = "perspective(600px) rotateY(-180deg)";
                    loginForm.style.transition = "transform 1.0s linear 0s";

                    guestLoginForm.style.transform = "perspective(600px) rotateY(0deg)";
                    guestLoginForm.style.transition = "transform 1.0s linear 0s";


                }else if(e.target.textContent == "Login as admin")
                {

                   e.target.innerHTML = "Login as guest user";

                    loginForm.style.transform = "perspective(600px) rotateY(0deg)";
                    loginForm.style.transition = "transform 1.0s linear 0s";

                    guestLoginForm.style.transform = "perspective(600px) rotateY(180deg)";
                    guestLoginForm.style.transition = "transform 1.0s linear 0s";


                }


          })

      }
    //  LoginModes();




})
