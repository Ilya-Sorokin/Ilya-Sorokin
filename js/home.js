$(function () {
  /* ______________________________________  Код для  "EDIT_HOME" ________________________________________ */

  // ОБЪЯВИМ НЕОБХОДИМЫЕ ПЕРЕМЕННЫЕ
  // ТЕКУЩЕЕ ЗНЧН; СТАРОЕ ЗНАЧН; ID СТРОКИ ГДЕ; field - имя редактируемого поля
  var oldVal, newVal, id, field;
  var urlPage = "edit_home.php";
  var table = "home";

  // ПРИСВОИМ ПЕРЕМЕННЫМ ЗНАЧЕНИЯ ПРИ ФОКУСЕ НА ЭЛ. С КЛ. edit
  $(".edit").focus(function () {
    oldVal = $(this).text();
    id = $(this).data("id");
    field = $(this).data("name");
  });

  // при keypress "enter" НА ЭЛ. С КЛ. edit: AJAX запрос + нужно отключить перенос строк при enter на эл div с классом edit из таб
  $(".edit").keypress(function (e) {
    if (e.which == 13) {
      newVal = $(this).text();
      if (newVal != oldVal) {
        $.ajax({
          url: urlPage,
          type: "POST",
          data: { new_val: newVal, id: id, field: field, table: table },
          beforeSend: function () {
            $("#loader").fadeIn();
          },
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
          complete: function () {
            $("#loader").delay(500).fadeOut();
          },
        });
      }
      return false;
    }
  });

  //------------------------------------------------------------------------ДОБАВЛЕНИЕ, УДАЛЕНИЕ И ИЗМЕНЕНИЕ (+)

  $(".btns").click(function () {
    if ($(this).data("add")) {
      $("#AddModal").modal("show");
    } else {
      if (id) {
        //------------------------------------------------------------------------ ПОЛУЧЕНИЕ СТРОКИ В МОД.ОКНО ИЗМЕНЕНИЯ
        if ($(this).attr("data-update")) {
          var strToupdate = "strToupdate";

          $.ajax({
            url: urlPage,
            type: "POST",
            data: { strToupdate: strToupdate, id: id, table: table },

            success: function (res) {
              // получаем в результат res -> массив JSON и парсим(преобраз)
              tab_str = JSON.parse(res);

              // присваиваем элементам формы на мод.окне значения JSON массива
              document.getElementById("Up_section").value = tab_str.section;
              document.getElementById("Up_street").value = tab_str.street;
              document.getElementById("Up_house").value = tab_str.house;
              document.getElementById("Up_flat").value = tab_str.flat;
              document.getElementById("Up_year").value = tab_str.year;
              document.getElementById("Up_floor").value = tab_str.floor;
              document.getElementById("Up_area").value = tab_str.area;

              // открываем нужное мод.окно
              $("#ModalTypet").modal("show");
            },

            error: function () {
              alert("Error!");
            },
          });
        }

        //------------------------------------------------------------------------УДАЛЕНИЕ
        else if ($(this).attr("data-remove")) {
          var del = "delite";

          $.ajax({
            url: urlPage,
            type: "POST",
            data: { del: del, id: id, table: table },
            beforeSend: function () {
              $("#loader").fadeIn();
            },
            success: function (res) {
              $("#mes-edit")
                .text(res)
                .delay(500)
                .fadeIn(1000, function () {
                  $("#mes-edit").delay(1000).fadeOut();
                });

              $("[data-td_id=" + id + "]").remove();
              $("[id=" + id + "]").remove(); // ИМБА!: Нахождение элемента по регуляркам!!!
            },
            error: function () {
              alert("Error!");
            },
            complete: function () {
              $("#loader").delay(500).fadeOut();
            },
          });
        }
        //------------------------------------------------------------------------ДОБАВЛЕНИЕ
      }
      //------------------------------------------------------------------------ЗАЩИТА ОТ НЕ ВЫБРАННОЙ СТРОКИ
      else {
        $("#mes-edit")
          .text("Выберите строку для редактирования")
          .css({
            display: "inline",
            color: "orange",
          })
          .fadeOut(3000);
      }
    }
  });

  //------------------------------------------------------------------------------------------ИЗМЕНЕНИЕ-2
  $("#subUpForm").click(function () {
    $("#UpForm").submit();
  });
  $("#UpForm").submit(function (e) {
    e.preventDefault();

    //ПОЛУЧАЕМ ДАННЫЕ
    var Up_section = $("#Up_section").val();
    var Up_street = $("#Up_street").val();
    var Up_house = $("#Up_house").val();
    var Up_flat = $("#Up_flat").val();
    var Up_year = $("#Up_year").val();
    var Up_floor = $("#Up_floor").val();
    var Up_area = $("#Up_area").val();
    var Up_login = $("#Up_login").val();

    //ПОЛУЧИМ ID собственника-пользователя НА КОТОРЫЙ ССЫЛАЕТСЯ ТАБЛИЦА ПО СВЯЗИ ИЗ КОНТЕНТА ВЫБРАННОГО ЭЛЕМЕНТА В СПИСКЕ МОД.ОКНА (ХИТРОСТЬ)
    var Up_login = Up_login.split("|");
    Up_login = Up_login[0].trim();

    let formData = new FormData();

    //Заносим данные в formData, в том числе и обработаный логин собственника
    formData.append("Up_section", Up_section);
    formData.append("Up_street", Up_street);
    formData.append("Up_house", Up_house);
    formData.append("Up_flat", Up_flat);
    formData.append("Up_year", Up_year);
    formData.append("Up_floor", Up_floor);
    formData.append("Up_area", Up_area);
    formData.append("Up_login", Up_login);
    formData.append("table", table);
    formData.append("id", id);

    $.ajax({
      type: "POST",
      url: urlPage,
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      success: function (res) {
        $("#ModalTypet").modal("hide");
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
  //------------------------------------------------------------------------ДОБАВЛЕНИЕ ФОРМА ОТПРАВКИ

  $("#subAddForm").click(function () {
    $("#AddForm").submit();
  });
  $("#AddForm").submit(function (e) {
    e.preventDefault();

    var Add_section = $("#Add_section").val();
    var Add_street = $("#Add_street").val();
    var Add_house = $("#Add_house").val();
    var Add_flat = $("#Add_flat").val();
    var Add_login = $("#Add_login").val();
    var Add_year = $("#Add_year").val();
    var Add_floor = $("#Add_floor").val();
    var Add_area = $("#Add_area").val();

    //ПОЛУЧИМ ID СОБСТВЕННИКА-USER НА КОТОРЫЙ ССЫЛАЕТСЯ ТАБЛИЦА ПО СВЯЗИ ИЗ КОНТЕНТА ВЫБРАННОГО ЭЛЕМЕНТА В СПИСКЕ МОД.ОКНА (ХИТРОСТЬ)
    var Add_login = Add_login.split("|");
    Add_login = Add_login[0].trim();

    let formData = new FormData();

    //Заносим данные в formData, в том числе ОТРЕДАКТИРОВАННЫЙ LOGIN
    formData.append("Add_section", Add_section);
    formData.append("Add_street", Add_street);
    formData.append("Add_house", Add_house);
    formData.append("Add_flat", Add_flat);
    formData.append("Add_login", Add_login);
    formData.append("Add_year", Add_year);
    formData.append("Add_floor", Add_floor);
    formData.append("Add_area", Add_area);
    formData.append("table", table);

    $.ajax({
      type: "POST",
      url: urlPage,
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      success: function (res) {
        $("#AddModal").modal("hide");
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


});
