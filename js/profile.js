$(function () {
  var urlPage = "profile.php";

  //-----------------------------------------------------------ВКЛЮЧЕНИЕ INPUT ДЛЯ ИЗМЕНЕНИЯ

  $("#editBtn").click(function () {
    $("#saveBtn").removeClass("d-none");
    $("#editBtn").addClass("d-none");
    $(".inputId").removeAttr("readonly");
  });

  $("#saveBtn").click(function () {
    $("#myForm").submit();
    $("#editBtn").removeClass("d-none");
    $("#saveBtn").addClass("d-none");
    $(".inputId").attr("readonly", "true");
  });

  //--------------------------------------ВЫБОР СОБСВЕННОСТИ ДЛЯ ПОКАЗА СТАТИСТИКИ ПЛАТЕЖЕЙ ( TO-DO  )

  $("#Story_electroOrders").click(function () {
    var Story_home = $("#Story_home").val();

    //ПОЛУЧИМ ID СОТРУДНИКА НА КОТОРЫЙ ССЫЛАЕТСЯ ТАБЛИЦА ПО СВЯЗИ ИЗ КОНТЕНТА ВЫБРАННОГО ЭЛЕМЕНТА В СПИСКЕ МОД.ОКНА (ХИТРОСТЬ)
    var Story_home = Story_home.split("|");
    Story_home = Story_home[0].trim();

    let formData = new FormData();

    //Заносим данные в formData
    formData.append("Story_home", Story_home);

    $.ajax({
      type: "POST",
      url: urlPage,
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      success: function (res) {
        $("#mes-edit")
          .text(res)
          .delay(500)
          .fadeIn(1000, function () {
            $("#mes-edit").delay(1000).fadeOut();
          });
      },
      error: function () {
        alert("Error!");
      },
    });
  });

  /* ________________________________________________________________ВНЕСЕНИЕ ПОКАЗАНИЙ ПОЛЬЗОВАТЕЛЕМ */
  $("#Btn_electro").click(function () {
    var Т1 = $("#Т1").val();
    var Т2 = $("#Т2").val();
    var Т3 = $("#Т3").val();
    var User_home = $("#User_home").val();

    //ПОЛУЧИМ ID СОТРУДНИКА НА КОТОРЫЙ ССЫЛАЕТСЯ ТАБЛИЦА ПО СВЯЗИ ИЗ КОНТЕНТА ВЫБРАННОГО ЭЛЕМЕНТА В СПИСКЕ МОД.ОКНА (ХИТРОСТЬ)
    var User_home = User_home.split("|");
    User_home = User_home[0].trim();

    if (Т1 == "") {
      Т1 = 0;
    }

    if (Т2 == "") {
      Т2 = 0;
    }

    if (Т3 == "") {
      Т3 = 0;
    }

    urlPage = "profile.php";
    let formData = new FormData();

    //Заносим данные в formData
    formData.append("Т1", Т1);
    formData.append("Т2", Т2);
    formData.append("Т3", Т3);
    formData.append("User_home", User_home);

    $.ajax({
      type: "POST",
      url: urlPage,
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      success: function (res) {
        alert(res);
      },
      error: function () {
        alert("Error!");
      },
    });
  });

  //--------------------------------------

  $("#Btn_order").click(function () {
    var User_typet = $("#User_typet").val();
    var User_home = $("#User_home").val();
    var User_phone = $("#User_phone").val();

    //ПОЛУЧИМ ID СОТРУДНИКА НА КОТОРЫЙ ССЫЛАЕТСЯ ТАБЛИЦА ПО СВЯЗИ ИЗ КОНТЕНТА ВЫБРАННОГО ЭЛЕМЕНТА В СПИСКЕ МОД.ОКНА (ХИТРОСТЬ)
    var User_typet = User_typet.split("|");
    User_typet = User_typet[0].trim();

    //ПОЛУЧИМ ID СОТРУДНИКА НА КОТОРЫЙ ССЫЛАЕТСЯ ТАБЛИЦА ПО СВЯЗИ ИЗ КОНТЕНТА ВЫБРАННОГО ЭЛЕМЕНТА В СПИСКЕ МОД.ОКНА (ХИТРОСТЬ)
    var User_home = User_home.split("|");
    User_home = User_home[0].trim();

    urlPage = "profile.php";
    let formData = new FormData();

    //Заносим данные в formData
    formData.append("User_typet", User_typet);
    formData.append("User_home", User_home);
    formData.append("User_phone", User_phone);

    $.ajax({
      type: "POST",
      url: urlPage,
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      success: function (res) {
        alert(res);
      },
      error: function () {
        alert("Error!");
      },
    });
  });

  //-----------------------------------------------------------ИЗМЕНЕНИЕ ДАННЫХ ПОЛЬЗОВАТЕЛЯ

  $("#myForm").submit(function (e) {
    e.preventDefault();

    var id = $("#Up_ID").val();
    var Up_surname = $("#Up_surname").val();
    var Up_first_name = $("#Up_first_name").val();
    var Up_last_name = $("#Up_last_name").val();
    var Up_email = $("#Up_email").val();
    var Up_telephone = $("#Up_telephone").val();
    var Up_user = "user";

    let formData = new FormData();

    //Заносим данные в formData
    formData.append("Up_surname", Up_surname);
    formData.append("Up_first_name", Up_first_name);
    formData.append("Up_last_name", Up_last_name);
    formData.append("Up_telephone", Up_telephone);
    formData.append("Up_email", Up_email);
    formData.append("id", id);
    formData.append("Up_user", Up_user);

    $.ajax({
      type: "POST",
      url: urlPage,
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      success: function (res) {
        $("#mes-edit")
          .text(res)
          .delay(500)
          .fadeIn(1000, function () {
            $("#mes-edit").delay(1000).fadeOut();
          });
      },
      error: function () {
        alert("Error!");
      },
    });

    return false;
  });

  //------------------------------------------------------------------------поисковая система
  function createExpr(arr) {
    var index = 0;
    var expr = [":containsiAND('" + arr[0] + "')"];
    for (var i = 1; i < arr.length; i++) {
      if (arr[i] === "AND") {
        expr[index] += ":containsiAND('" + arr[i + 1] + "')";
        i++;
      } else if (arr[i] === "OR") {
        index++;
        expr[index] = ":containsiOR('" + arr[i + 1] + "')";
        i++;
      }
    }
    return expr;
  }
  $(document).ready(function () {
    $(".searchKey").keyup(function () {
      var searchTerm = $(".searchKey").val().replace(/["']/g, "");
      var arr = searchTerm.split(/(AND|OR)/);
      var exprs = createExpr(arr);
      var searchSplit = searchTerm
        .replace(/AND/g, "'):containsiAND('")
        .replace(/OR/g, "'):containsiOR('");

      $.extend($.expr[":"], {
        containsiAND: function (element, i, match, array) {
          return (
            (element.textContent || element.innerText || "")
              .toLowerCase()
              .indexOf((match[3] || "").toLowerCase()) >= 0
          );
        },
      });

      $(".results tbody tr").attr("visible", "false");
      for (var expr in exprs) {
        $(".results tbody tr" + exprs[expr]).each(function (e) {
          $(this).attr("visible", "true");
        });
      }

      var searchCount = $('.results tbody tr[visible="true"]').length;

      $(".searchCount").text("найдено " + searchCount + " похожей информации");
      if (searchCount == "0") {
        $(".no-result").show();
      } else {
        $(".no-result").hide();
      }
      if ($(".searchKey").val().length == 0) {
        $(".searchCount").hide();
      } else {
        $(".searchCount").show();
      }
    });
  });

  //------------------------------------------------------------------------ВЫДЕЛЕНИЕ СТРОКИ ПРИ КЛИКЕ

  $(".tr").click(function () {
    id = $(this).attr("id");
    $(".tr").removeClass("border_tr");
    $(this).addClass("border_tr");

    // $(".edit").addClass("bg-white");
  });

  //------------------------------------------------------------------------поисковая система
  function createExpr(arr) {
    var index = 0;
    var expr = [":containsiAND('" + arr[0] + "')"];
    for (var i = 1; i < arr.length; i++) {
      if (arr[i] === "AND") {
        expr[index] += ":containsiAND('" + arr[i + 1] + "')";
        i++;
      } else if (arr[i] === "OR") {
        index++;
        expr[index] = ":containsiOR('" + arr[i + 1] + "')";
        i++;
      }
    }
    return expr;
  }
  $(document).ready(function () {
    $(".searchKey").keyup(function () {
      var searchTerm = $(".searchKey").val().replace(/["']/g, "");
      var arr = searchTerm.split(/(AND|OR)/);
      var exprs = createExpr(arr);
      var searchSplit = searchTerm
        .replace(/AND/g, "'):containsiAND('")
        .replace(/OR/g, "'):containsiOR('");

      $.extend($.expr[":"], {
        containsiAND: function (element, i, match, array) {
          return (
            (element.textContent || element.innerText || "")
              .toLowerCase()
              .indexOf((match[3] || "").toLowerCase()) >= 0
          );
        },
      });

      $(".results tbody tr").attr("visible", "false");
      for (var expr in exprs) {
        $(".results tbody tr" + exprs[expr]).each(function (e) {
          $(this).attr("visible", "true");
        });
      }

      var searchCount = $('.results tbody tr[visible="true"]').length;

      $(".searchCount").text("найдено " + searchCount + " похожей информации");
      if (searchCount == "0") {
        $(".no-result").show();
      } else {
        $(".no-result").hide();
      }
      if ($(".searchKey").val().length == 0) {
        $(".searchCount").hide();
      } else {
        $(".searchCount").show();
      }
    });
  });

  /* СМЕНА АВАТАРКИ ПОЛЬЗОВАТЕЛЯ */
  $(".imgProfile").mouseover(function () {
    $(".editAva").removeClass("d-none");
  });
  $(".imgProfile").mouseout(function () {
    $(".editAva").addClass("d-none");
  });
  $(".imgProfile").click(function () {
    $(".changeAva").click();
  });
  $(".changeAva").change(function () {
    
    let formData = new FormData();
    //Заносим данные в formData, в том числе и изображение
    formData.append("avaProfile", $(".changeAva")[0].files[0]);

    $.ajax({
      type: "POST",
      url: urlPage,
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      success: function (res) {
        $(".imgProfile").attr("src", res);
      },
      error: function () {
        alert("Error!");
      },
    });
  });
});
