$(function () {
  /* ______________________________________  Код для  "EDIT_TYPET" ________________________________________ */

  // ОБЪЯВИМ НЕОБХОДИМЫЕ ПЕРЕМЕННЫЕ
  // ТЕКУЩЕЕ ЗНЧН; СТАРОЕ ЗНАЧН; ID СТРОКИ ГДЕ; field - имя редактируемого поля
  var oldVal, newVal, id, field;
  var urlPage = "edit_typet.php";
  var table = "typet";

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
              document.getElementById("Up_id_typet").value = tab_str.id;
              document.getElementById("Up_type").value = tab_str.type;
              // присвоение в checkbox
              if (tab_str.status == 1) {
                document.getElementById("Up_status").checked = true;
              } else {
                document.getElementById("Up_status").checked = false;
              }
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
  //------------------------------------------------------------------------UPDATE-2
  //Обработка кнопки запуска отправки
  $("#subUpForm").click(function () {
    $("#UpForm").submit();
  });
  //Обработка данных формы и отправка
  $("#UpForm").submit(function (e) {
    event.preventDefault();

    var Up_status; // Текущее значение checkbox в базе данных
    var Up_check; // Значение checkbox в форме
    var Up_type; // Значение типа услуги в форме
    var update = "update"; // Тип запроса

    Up_type = document.getElementById("Up_type").value;
    Old_Up_type = document.getElementById("Up_type").value;

    // Обработка типа услуги для проверки
    Up_type = Up_type.trim();
    var pattern = /[А-Яа-яA-Za-z0-9.,_-]/;
    valid = pattern.test(Up_type);

    //ДЛЯ СРАВНЕНИЯ НА РАЗЛИЧИЕ УСТАНАВЛИВАЕМ ЗАНЧЕНИЯ
    //ДЛЯ tab_str.status(ИЗ БД) И Up_check(ИЗ ФОРМЫ)
    if (tab_str.status == 1) {
      Up_status = true;
    } else {
      Up_status = false;
    }
    if ($("#Up_status").is(":checked")) {
      document.getElementById("Up_status").checked = true;
      Up_check = true;
    } else {
      document.getElementById("Up_status").checked = false;
      Up_check = false;
    }
    Old_Up_check = Up_check;

    // Получаем true или false в зависимости от изменения значения с того что был, и соответсвует ли значение полученное требованиям
    //если все валидно, то отправляем запрос, иначе блок else отменит отправку
    if ((Up_check != Up_status || tab_str.type !== Up_type) && valid) {
      //Присвоение 1/0 т.к в БД хранится значение типа tinyint(1)
      if (Up_check == true) {
        Up_check = 1;
      } else {
        Up_check = 0;
      }

      // $("#Up_message").text(Up_check);
      //$("#Up_message").text(Up_check);

      $.ajax({
        url: urlPage,
        type: "POST",
        data: {
          update: update,
          Up_type: Up_type,
          Up_check: Up_check,
          id: id,
          table: table,
        },
        success: function (res) {
          $("#ModalTypet").modal("hide");
          $("#mes-edit")
            .text(res)
            .delay(500)
            .fadeIn(1000, function () {
              $("#mes-edit").delay(1000).fadeOut();
            });
          // "ВНОСИМ ДАННЫЕ В ТАБЛИЦУ НА СТРАНИЦЕ БЕЗ ПЕРЕЗАГРУЗКИ"
          //1) находим эл.строки
          list = $("tr").find("[data-id=" + id + "]");
          // 2) присваеваем текущим эл. строки нов значения, что изменены в БД
          list[1].innerHTML = Up_type;
          if (Up_check == 1) {
            list[2].checked = true;
          } else {
            list[2].checked = false;
          }
        },
        error: function () {
          alert("Error!");
        },
      });
    } else {
      $("#Up_message")
        .text("ЗНАЧЕНИЯ НЕ ПОМЕНЯЛИСЬ")
        .css({
          display: "inline",
          color: "Red",
        })
        .fadeOut(5000);
      return false;
    }
    return false;
  });

  //------------------------------------------------------------------------ДОБАВЛЕНИЕ ФОРМА ОТПРАВКИ

  $("#subAddForm").click(function () {
    $("#AddForm").submit();
  });
  $("#AddForm").submit(function (e) {
    event.preventDefault();

    var Add_status; // Значение checkbox в форме
    var Add_type; // Значение типа услуги в форме
    var Add = "Add"; // Тип запроса

    Add_status = document.getElementById("Add_status").value;
    Add_type = document.getElementById("Add_type").value;

    // Обработка типа услуги для проверки
    Add_type = Add_type.trim();
    var pattern = /[А-Яа-яA-Za-z0-9.,_-]/;
    valid = pattern.test(Add_type);

    if (valid) {
      //Преобразуем checkbox
      if ($("#Add_status").is(":checked")) {
        Add_status = 1;
      } else {
        Add_status = 0;
      }

      $.ajax({
        url: urlPage,
        type: "POST",
        data: {
          Add: Add,
          Add_type: Add_type,
          Add_status: Add_status,
          id: id,
          table: table,
        },
        success: function (res) {
          $("#AddModal").modal("hide");
          $("#mes-edit")
            .text("Была вставлена строка с ID: " + res)
            .delay(500)
            .fadeIn(1000, function () {
              $("#mes-edit").delay(1000).fadeOut();
            });

          //id строки
          var id_last = res;

          // TO-DO: созданную временную строку нельзя редактировать ВООБЩЕ (КАК ИСПРАВИТЬ?)
          // Отображаем временно добавленную строку до перезагрузки (ОБМАН!)
          if (Add_status == 1) {
            Add_status = "checked = true";
          } else {
            Add_status = "";
          }
          $("table").append(function () {
            return $(
              '<tr class="zero"><td class="text-center"><div>' +
                id_last +
                "</div></td><td><div>" +
                Add_type +
                '</div></td><td class="text-center"><form><input type="checkbox" ' +
                Add_status +
                "></form></td></tr>"
            );
          });
        },
        error: function () {
          alert("Error!");
        },
      });
    } else {
      $("#Add_message")
        .text("ДАННЫЕ НЕ ВАЛИДНЫ!")
        .css({
          display: "inline",
          color: "Red",
        })
        .fadeOut(5000);
      return false;
    }
    return false;
  });
  //------------------------------------------------------------------------ВЫДЕЛЕНИЕ СТРОКИ ПРИ КЛИКЕ
  $(".tr").click(function () {
    id = $(this).attr("id");
    $(".tr").removeClass("border_tr");
    $(this).addClass("border_tr");

    // $(".edit").addClass("bg-white");
  });

});
