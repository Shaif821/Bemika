window.addEventListener("load", function(){

    var addUserFormCaller = document.getElementById("addUserFormCaller");
    var addUserForm = document.getElementById("addUserForm");
    var addUserFormBack = document.getElementById("addUserFormBack");

    var displayExplain = document.getElementById("displayExplain");
    var newUserData = document.querySelectorAll(".newUserData");
    var categoryValue = document.getElementById("categoryValue");
    var rightsButt = document.querySelectorAll(".rightsButt");

    addUserFormCaller.addEventListener("click", function(){

         $(function(){

             $(addUserForm).animate({

                bottom: -80,

             },{

                 duration: 700,
                 easing: "easeOutBack",

             })

         })

    })


    addUserFormBack.addEventListener("click", function(){

      displayExplain.innerHTML = "explaining";

      for (var i = 0; i < newUserData.length; i++) {

          var newUserDataArr = newUserData[i];
          newUserDataArr.value = "";

      }

      categoryValue.value = "";

         $(function(){

             $(addUserForm).animate({

                bottom: 590,

             },{

                 duration: 700,
                 easing: "easeInOutBack",

             })

         })

    })



    function explaining(eventsType, ids, explain)
    {

        ids.addEventListener(eventsType, function(){

           displayExplain.innerHTML = explain;

        })

    }

    explaining("focus", newUserData[0], "Gives a name");
    explaining("focus", newUserData[1], "Gives an email");
    explaining("focus", newUserData[2], "Choose a catagory");
    explaining("focus", categoryValue, "Add a catagory");
    explaining("mouseover", rightsButt[0], "Activate update right");
    explaining("mouseover", rightsButt[1], "Activate delete right");
    explaining("mouseover", rightsButt[2], "Activate upload right");
    explaining("mouseover", rightsButt[3], "Activate permission right");





    var cancelUsersOption = document.getElementById("cancelUsersOption");
    var usersOption = document.getElementById("usersOption");
    var superUser = document.getElementById("superUser");

    cancelUsersOption.addEventListener("click", function(){

        /*superUser.style.marginTop = "25px";*/
        $(function(){

            $(usersOption).animate({

                bottom: 750,


            },{

               duration: 700,
               easing: "easeInOutBack",

            })

        })

    })



    var deleteUsers = document.getElementById("deleteCont");
    var deleteCheck = document.getElementById("deleteCheck");
    var deleteCheckCloser = document.querySelector("#deleteCheck span");
    var deleteCheck_error = document.getElementById("deleteCheck_error");
    var deletePassVal = document.getElementById("deletePass");
    var delete_user = document.getElementById("delete_user");

    var active_inactive_user = document.getElementById("de_activate_user");

    deleteUsers.addEventListener("click", function(){

      delete_user.style.display = "block";
      active_inactive_user.style.display = "none";

      delete_user.value = "Delete";
      //deleteCheck.style.position = "fixed";

          $(deleteCheck).animate({

             top: 455,
             position: "fixed",
             right: 300,
             marginBottom: 70,

          },{

             duration: 700,
             easing: "easeOutBack",

          })

    })


    deleteCheckCloser.addEventListener("click", function(){

          $(deleteCheck).animate({

             top: -400,

          },{

             duration: 700,
             easing: "easeInOutBack",

          })

          deleteCheck_error.innerHTML = "are you sure you want to delete this user? Gives the password to delete it";
          deletePassVal.value = "";
          //deleteCheck.style.position = "relative";

    })






    var rightsUsers = document.getElementById("rightsCont");
    var userRights = document.getElementById("userRights");
    var userRightsCloser = document.querySelector("#userRights span");

     userRights.style.position = "fixed";
    rightsUsers.addEventListener("click", function(){

          $(userRights).animate({

             top: 75,
             left: 900,

          },{

             duration: 700,
             easing: "easeOutBack",

          })

    })



    userRightsCloser.addEventListener("click", function(){

          $(userRights).animate({

             top: -500,

          },{

             duration: 700,
             easing: "easeInOutBack",

          })

    })


    var userHistoryCloser = document.getElementById("userHistoryCloser");
    var historyCont = document.getElementById("historyCont");
    var guestAllData = document.getElementById("guestAllData");
    var recoverUsername = document.getElementById("recoverUsername");
    var recoverPassword = document.getElementById("recoverPassword");
    var recoverUsername_Password = document.querySelector(".recoverUsername_Password");
    var checkRestore = document.getElementById("checkRestore");//formulaire contenant l input du mot de passe du super utilisateur

    guestAllData.style.position = "fixed";

    historyCont.addEventListener("click", function(){

          $(function(){

             $(guestAllData).animate({

                bottom: 520,
                left: 400,

             },{

                duration: 700,
                easing: "easeOutBack",

             })

          })

    })


    userHistoryCloser.addEventListener("click", function(){

        recoverUsername.innerHTML = "";
        recoverPassword.innerHTML = "";
        recoverUsername_Password.innerHTML = "";
        checkRestore.style.display = "none";

        $(function(){

           $(guestAllData).animate({

              bottom: 1200,

           },{

              duration: 700,
              easing: "easeInOutBack",

           })

        })

    })



})
