$(function () {
  /* ______________________________________  Код для  "EDIT_PERSONAL" ________________________________________ */

  // ОБЪЯВИМ НЕОБХОДИМЫЕ ПЕРЕМЕННЫЕ
  // ТЕКУЩЕЕ ЗНЧН; СТАРОЕ ЗНАЧН; ID СТРОКИ ГДЕ; field - имя редактируемого поля
  var oldVal, newVal, id, field;
  var urlPage = "edit_orders.php";
  var table = "orders";

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

  /* -----------------------------------------------------------------------Для INPUT DATE------------------------------------------------*/
  // 1) Получим старое значение при клике
  $(".date").click(function (e) {
    oldVal = $(this).prop("value");
    console.log(oldVal);
  });
  // 2) Получим новое значение при полном изменении
  $(".date").change(function (e) {
    field = $(this).data("name");
    newVal = $(this).prop("value");
    // 3) Если старое и новое значение отличаются, тогда запрос AJAX
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
                document.getElementById("Up_phone").value = tab_str.phone;
                document.getElementById("Up_date").value = tab_str.date;
                document.getElementById("Up_date2").value = tab_str.date2;

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

  //------------------------------------------------------------------------UPDATE-2 !!!!!!!!!!!!!!!!!!
  //Обработка кнопки запуска отправки
  $("#subUpForm").click(function () {
    $("#UpForm").submit();
  });
  //Обработка данных формы и отправка
  $("#UpForm").submit(function (e) {
    e.preventDefault();

    var Up_phone = $("#Up_phone").val();
    var Up_home = $("#Up_home").val();
    var Up_typet = $("#Up_typet").val();
    var Up_date = $("#Up_date").val();
    var Up_employee = $("#Up_employee").val();
    var Up_date2 = $("#Up_date2").val();

    //ПОЛУЧИМ ID СОТРУДНИКА НА КОТОРЫЙ ССЫЛАЕТСЯ ТАБЛИЦА ПО СВЯЗИ ИЗ КОНТЕНТА ВЫБРАННОГО ЭЛЕМЕНТА В СПИСКЕ МОД.ОКНА
    var Up_home = Up_home.split("|");
    Up_home = Up_home[0].trim();

    //ПОЛУЧИМ ID СОТРУДНИКА 
    var Up_typet = Up_typet.split("|");
    Up_typet = Up_typet[0].trim();

    //ПОЛУЧИМ ID СОТРУДНИКА 
    var Up_employee = Up_employee.split("|");
    Up_employee = Up_employee[0].trim();

    let formData = new FormData();

    //Заносим данные в formData, в том числе и изображение
    formData.append("Up_phone", Up_phone);
    formData.append("Up_home", Up_home);
    formData.append("Up_typet", Up_typet);
    formData.append("Up_date", Up_date);
    formData.append("Up_employee", Up_employee);
    formData.append("Up_date2", Up_date2);
    formData.append("id", id);
    formData.append("table", table);

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

    var Add_phone = $("#Add_phone").val();
    var Add_home = $("#Add_home").val();
    var Add_typet = $("#Add_typet").val();
    var Add_date = $("#Add_date").val();
    var Add_employee = $("#Add_employee").val();
    var Add_date2 = $("#Add_date2").val();

    //НАСТРАИВАЕМ ДАННЫЕ
    //ПОЛУЧИМ ID ДОМА НА КОТОРЫЙ ССЫЛАЕТСЯ ТАБЛИЦА ПО СВЯЗИ ИЗ КОНТЕНТА ВЫБРАННОГО ЭЛЕМЕНТА В СПИСКЕ МОД.ОКНА (ХИТРОСТЬ)
    var Add_home = Add_home.split("|");
    Add_home = Add_home[0].trim();
    //ПОЛУЧИМ ID услуги
    var Add_typet = Add_typet.split("|");
    Add_typet = Add_typet[0].trim();
    //ПОЛУЧИМ ID сотрудника
    var Add_employee = Add_employee.split("|");
    Add_employee = Add_employee[0].trim();

    let formData = new FormData();

    //Заносим данные в formData
    formData.append("Add_phone", Add_phone);
    formData.append("Add_home", Add_home);
    formData.append("Add_typet", Add_typet);
    formData.append("Add_date", Add_date);
    formData.append("Add_employee", Add_employee);
    formData.append("Add_date2", Add_date2);
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

    //--------------------------------------------------------------------------------------
    // var Add_surname = $("#Add_surname").val();
    // var Add_first_name = $("#Add_first_name").val();
    // var Add_last_name = $("#Add_last_name").val();
    // var Add_vacant = $("#Add_vacant").val();
    // var Add_education = $("#Add_education").val();
    // var Add_experience = $("#Add_experience").val();

    // var Add_telephone = $("#Add_telephone").val();

    // let formData = new FormData();

    // //Заносим данные в formData, в том числе и изображение
    // formData.append("image", $("#Add_file")[0].files[0]);
    // formData.append("Add_surname", Add_surname);
    // formData.append("Add_first_name", Add_first_name);
    // formData.append("Add_last_name", Add_last_name);
    // formData.append("Add_vacant", Add_vacant);
    // formData.append("Add_education", Add_education);
    // formData.append("Add_experience", Add_experience);
    // formData.append("Add_telephone", Add_telephone);
    // formData.append("table", table);

    // $.ajax({
    //   type: "POST",
    //   url: urlPage,
    //   cache: false,
    //   contentType: false,
    //   processData: false,
    //   data: formData,
    //   success: function (res) {
    //     $("#AddModal").modal("hide");
    //     $("#mes-edit")
    //       .text(res)
    //       .delay(500)
    //       .fadeIn(1000, function () {
    //         $("#mes-edit").delay(1000).fadeOut();
    //       });
    //   },
    //   error: function () {
    //     alert("Error!");
    //   },
    // });

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
