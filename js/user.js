$(function () {
  // ОБЪЯВИМ НЕОБХОДИМЫЕ ПЕРЕМЕННЫЕ
  // ТЕКУЩЕЕ ЗНЧН; СТАРОЕ ЗНАЧН; ID СТРОКИ ГДЕ; field - имя редактируемого поля
  var oldVal, newVal, id, field;
  var urlPage = "edit_user.php";
  var table = "user";

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

  //-------------------------------------------------------------Для элемента CHECKED AJAX ЗАПРОС UPDATE

  $(".chk").click(function () {
    id = $(this).data("id");
    field = $(this).data("name");

    //ЕСЛИ click по выкл, то пишет вкл. Если по вкл -> выкл (alert("Включен") |или/else| alert("Выключен"); )
    if ($(this).is(":checked")) {
      $(this).attr("checked", "checked");
      oldVal = 0;
      newVal = 1;
    } else {
      $(this).removeAttr("checked");
      oldVal = 1;
      newVal = 0;
    }

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
              $("#Up_photo").attr("src", tab_str.avatar);
              document.getElementById("Up_first_name").value =
                tab_str.first_name;
              document.getElementById("Up_surname").value = tab_str.surname;
              document.getElementById("Up_last_name").value = tab_str.last_name;
              document.getElementById("Up_login").value = tab_str.login;
              document.getElementById("Up_Password").value = tab_str.password;
              document.getElementById("Up_email").value = tab_str.email;
              document.getElementById("Up_telephone").value = tab_str.telephone;

              // присвоение в checkbox
              if (tab_str.status == 1) {
                $("#Up_status").attr("checked", "checked");
              } else {
                $("#Up_status").removeAttr("checked");
              }

              // ПРИСВАИВАЕМ ПАРОЛЬ ПЕРЕМЕННОЙ, ДЛЯ СРАВНЕНИЯ МЕНЯЛСЯ ЛИ ПАРОЛЬ, ДЛЯ ОПРЕДЕЛЕНИЯ ХЕШИРОВАТЬ ИЛИ НЕТ ПОЛУЧЕННЫЙ
              Pass = tab_str.password;

              // открываем нужное мод.окно
              $("#UpdateTypet").modal("show");
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

  //------------------------------------------------------------------------UPDATE-2 !!!!!!!!!!!!!!!!!!
  //Обработка кнопки запуска отправки
  $("#subUpForm").click(function () {
    $("#UpForm").submit();
  });
  //Обработка данных формы и отправка
  $("#UpForm").submit(function (e) {
    e.preventDefault();

    if ($("#Up_file")[0].files[0] == undefined) {
      $("#Up_message")
        .text("Выберите фотографию сотрудника")
        .css({
          display: "inline",
          color: "Red",
        })
        .fadeOut(5000);
      return false;
    }

    //ПОЛУЧАЕМ ДАННЫЕ
    var Up_surname = $("#Up_surname").val();
    var Up_first_name = $("#Up_first_name").val();
    var Up_last_name = $("#Up_last_name").val();
    var Up_login = $("#Up_login").val();
    var Up_Password = $("#Up_Password").val();
    var Up_email = $("#Up_email").val();
    var Up_telephone = $("#Up_telephone").val();

    //НАСТРАИВАЕМ ДАННЫЕ
    if ($("#Up_status").is(":checked")) {
      var Up_status = 1;
    } else {
      var Up_status = 0;
    }

    // ПРИСВАИВАЕМ ПЕРЕМЕННОЙ 0. если пароль полученный и пароль старый равны, тогда не нужно будет lib_db хешировать полученный пароль
    // ps: Pass переменная создается ajax запросе получения выбраной строки в модольное окн
    if (Pass === $("#Up_Password").val()) {
      Pass = 0;
    } else {
      Pass = 1;
    }

    //Создаем объект куда данные поместим, этот объект с будет отправлен запросом ajax
    let formData = new FormData();

    //Заносим данные в formData, в том числе и изображение
    formData.append("imageUp", $("#Up_file")[0].files[0]);
    formData.append("Up_surname", Up_surname);
    formData.append("Up_first_name", Up_first_name);
    formData.append("Up_last_name", Up_last_name);
    formData.append("Up_login", Up_login);
    formData.append("Up_Password", Up_Password);
    formData.append("Up_email", Up_email);
    formData.append("Up_telephone", Up_telephone);
    formData.append("Up_status", Up_status);
    formData.append("id", id);
    //Доп.данные
    formData.append("table", table);
    formData.append("Pass", Pass);

    $.ajax({
      type: "POST",
      url: urlPage,
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      success: function (res) {
        $("#UpdateTypet").modal("hide");
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
  /* ________________________________ОБРАБОТКА ФОРМЫ ДОБАВЛЕНИЯ НОВОЙ СТРОКИ ______________________*/

  $("#subAddForm").click(function () {
    $("#AddForm").submit();
  });
  $("#AddForm").submit(function (e) {
    e.preventDefault();

    //Получим/создадим данные
    urlPage = "edit_user.php";
    table = "user";

    var Add_surname = $("#Add_surname").val();
    var Add_first_name = $("#Add_first_name").val();
    var Add_last_name = $("#Add_last_name").val();
    var Add_login = $("#Add_login").val();
    var Add_email = $("#Add_email").val();
    var Add_Password = $("#Add_Password").val();
    var Add_telephone = $("#Add_telephone").val();
    var Add_status = $("#Add_status").val();

    //Настроем данные
    if ($("#Add_status").is(":checked")) {
      Add_status = 1;
    } else {
      Add_status = 0;
    }

    //Создадим объект в который занесем данные
    let formData = new FormData();

    //Заносим данные в formData, в том числе и изображение
    formData.append("image", $("#Add_file")[0].files[0]);
    formData.append("Add_surname", Add_surname);
    formData.append("Add_first_name", Add_first_name);
    formData.append("Add_last_name", Add_last_name);
    formData.append("Add_login", Add_login);
    formData.append("Add_email", Add_email);
    formData.append("Add_Password", Add_Password);
    formData.append("Add_telephone", Add_telephone);
    formData.append("Add_status", Add_status);
    formData.append("table", table);

    //Отправим запрос
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

  /* _________________________________ОТОБРАЖЕНИЕ ФОТОГРАФИИ В БЛОКЕ DIV ПРИ ВЫБОРЕ В INPUT FILE ______________________*/

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $("#Add_photo").attr("src", e.target.result);
        img = document.getElementById("outputNone").innerHTML =
          '<img name="Add_photo2" id="Add_photo2" data-name="Add_photo2" class="edit img-fluid responsive image mx-auto d-block img-thumbnail" style=" width: 100% 9; max-height: 100px;" src="' +
          e.target.result +
          '" alt="Фото статьи">';
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#Add_file").change(function () {
    readURL(this);
  });

  //-------Автозагрузка фотографии для МОДУЛЬНОГО ОКНА ИЗМЕНЕНИЯ
  function readURL_Up(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $("#Up_photo").attr("src", e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#Up_file").change(function () {
    readURL_Up(this);
  });

  //------------------------------------------------------------------------ВЫДЕЛЕНИЕ СТРОКИ ПРИ ВЫБОРЕ
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
