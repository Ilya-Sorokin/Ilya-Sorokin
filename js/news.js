$(function () {
  /* ______________________________________  Код для  "EDIT_PERSONAL" ________________________________________ */

  // ОБЪЯВИМ НЕОБХОДИМЫЕ ПЕРЕМЕННЫЕ
  // ТЕКУЩЕЕ ЗНЧН; СТАРОЕ ЗНАЧН; ID СТРОКИ ГДЕ; field - имя редактируемого поля
  var oldVal, newVal, id, field;
  var urlPage = "edit_news.php";
  var table = "news";

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
              $("#Up_photo").attr("src", tab_str.img);

              document.getElementById("Up_header").value = tab_str.header;
              document.getElementById("Up_text").value = tab_str.text;
              document.getElementById("Up_content").value = tab_str.content;
              document.getElementById("Up_date").value = tab_str.period;
              // document.getElementById("Up_file").value; В INPUT FILE НЕЛЬЗЯ УСТ.ФАЙЛ(никак!)

              if (tab_str.status == 1) {
                $("#Up_status").attr("checked", "checked");
              } else {
                $("#Up_status").removeAttr("checked");
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

  // function readURL(input) {
  //   if (input.files && input.files[0]) {
  //     var reader = new FileReader();

  //     reader.onload = function (e) {
  //       $("#Add_photo").attr("src", e.target.result);
  //       img = document.getElementById("outputNone").innerHTML =
  //         '<img name="Add_photo2" id="Add_photo2" data-name="Add_photo2" class="edit img-fluid responsive image mx-auto d-block img-thumbnail" style=" width: 100% 9; max-height: 100px;" src="' +
  //         e.target.result +
  //         '" alt="Фото статьи">';
  //     };

  //     reader.readAsDataURL(input.files[0]);
  //   }
  // }

  // $("#Add_file").change(function () {
  //   readURL(this);
  // });

  //------------------------------------------------------------------------------------------ИЗМЕНЕНИЕ-2
  $("#subUpForm").click(function () {
    $("#UpForm").submit();
  });
  $("#UpForm").submit(function (e) {
    e.preventDefault();

    var Up_header = $("#Up_header").val();
    var Up_text = $("#Up_text").val();
    var Up_content = $("#Up_content").val();
    var Up_date = $("#Up_date").val();
    var Up_surname = $("#Up_surname").val();
    var Up_status = $("#Up_status").val();

    //ПОЛУЧИМ ID СОТРУДНИКА НА КОТОРЫЙ ССЫЛАЕТСЯ ТАБЛИЦА ПО СВЯЗИ ИЗ КОНТЕНТА ВЫБРАННОГО ЭЛЕМЕНТА В СПИСКЕ МОД.ОКНА (ХИТРОСТЬ)
    var Up_surname = Up_surname.split("|");
    Up_surname = Up_surname[0].trim();

    //Преобразуем checkbox
    if ($("#Up_status").is(":checked")) {
      Up_status = 1;
    } else {
      Up_status = 0;
    }

    let formData = new FormData();

    //Заносим данные в formData, в том числе и изображение
    formData.append("imageUp", $("#Up_file")[0].files[0]);
    formData.append("Up_header", Up_header);
    formData.append("Up_text", Up_text);
    formData.append("Up_content", Up_content);
    formData.append("Up_date", Up_date);
    formData.append("Up_surname", Up_surname);
    formData.append("Up_status", Up_status);
    formData.append("table", table);
    formData.append("id", id);

    if ($("#Up_file")[0].files[0] != undefined) {
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
    } else {
      $("#Up_message")
        .text("Выберите изображение статьи")
        .delay(500)
        .fadeIn(1000, function () {
          $("#Up_message").delay(1000).fadeOut();
        });
    }

    return false;
  });

  //------------------------------------------------------------------------------------------ДОБАВЛЕНИЕ
  $("#subAddForm").click(function () {
    $("#AddForm").submit();
  });
  $("#AddForm").submit(function (e) {
    e.preventDefault();

    var Add_header = $("#Add_header").val();
    var Add_text = $("#Add_text").val();
    var Add_content = $("#Add_content").val();
    var Add_date = $("#Add_date").val();
    var Add_surname = $("#Add_surname").val();
    var Add_status = $("#Add_status").val();

    //ПОЛУЧИМ ID СОТРУДНИКА НА КОТОРЫЙ ССЫЛАЕТСЯ ТАБЛИЦА ПО СВЯЗИ ИЗ КОНТЕНТА ВЫБРАННОГО ЭЛЕМЕНТА В СПИСКЕ МОД.ОКНА (ХИТРОСТЬ)
    var Add_surname = Add_surname.split("|");
    Add_surname = Add_surname[0].trim();

    //Преобразуем checkbox
    if ($("#Add_status").is(":checked")) {
      Add_status = 1;
    } else {
      Add_status = 0;
    }

    let formData = new FormData();

    //Заносим данные в formData, в том числе и изображение
    formData.append("image", $("#Add_file")[0].files[0]);
    formData.append("Add_header", Add_header);
    formData.append("Add_text", Add_text);
    formData.append("Add_content", Add_content);
    formData.append("Add_date", Add_date);
    formData.append("Add_surname", Add_surname);
    formData.append("Add_status", Add_status);
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

  //-----------------------------------------------------------------------Автозагрузка фотографии в блок при выборе input file
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
