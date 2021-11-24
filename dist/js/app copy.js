$(document).ready(function () {


  var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, "").length === 11
      ? "(00) 00000-0000"
      : "(00) 0000-00009";
  },
    spOptions = {
      onKeyPress: function (val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
    };

  $(".js_fone").mask(SPMaskBehavior, spOptions);
  $(".js_cpf").mask("000.000.000-00", { reverse: true });
  $(".js_cep").mask("00000-000", { reverse: true });
  $(".js_data").mask("00/00/0000", { reverse: true });
  $(".js_num").mask("000000000000000000000", { reverse: true });

  //    $("#tabela").dataTable();
  /*
  $(".js_altSenha").click(function() {
    var senhaAtual = $("#passAtual").val();
    var np = $("#strNovaSenha").val();
    $("#js_resultAltSenha").load(
      "../escolinhas/pages/altSenha.php?passatual=" + senhaAtual + "&np=" + np
    );
    //        $('#nmCicadeSelect').load('../site/paginas/cidades.php?estado=' + estado);
  });

  $("#tabela").DataTable({
    dom: "Bfrtip",
    pageLength: 100,
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    buttons: [
      "excel",
      "pdf",
      "print"
      //            'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    language: {
      search: "Pesquise na tabela: ",
      processing: "Processando",
      lengthMenu: "Mostrar itens _MENU_",
      info: "Mostrando do  _START_ ao _END_ de _TOTAL_ registros",
      infoEmpty: "Registro não encontrado ",
      infoFiltered: "(_MAX_ registros no tatal)",
      infoPostFix: "",
      loadingRecords: "Chargement en cours...",
      zeroRecords: "Nenhum registro encontrado ",
      emptyTable: "Sem Restros na tabela",
      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
      pageLength: 100,
      paginate: {
        first: "Primeiro",
        previous: "Anterior",
        next: "Próximo",
        last: "último"
      }
    }
  });
  */
  /**
   * teste
   */

  //fix menu overflow under the responsive table
  // hide menu on click... (This is a must because when we open a menu )
  $(document).click(function (event) {
    //hide all our dropdowns
    $(".dropdown-menu[data-parent]").hide();
  });
  $(document).on(
    "click",
    '.table-responsive [data-toggle="dropdown"]',
    function () {
      // if the button is inside a modal
      if ($("body").hasClass("modal-open")) {
        throw new Error(
          "This solution is not working inside a responsive table inside a modal, you need to find out a way to calculate the modal Z-index and add it to the element"
        );
        return true;
      }

      $buttonGroup = $(this).parent();
      if (!$buttonGroup.attr("data-attachedUl")) {
        var ts = +new Date();
        $ul = $(this).siblings("ul");
        $ul.attr("data-parent", ts);
        $buttonGroup.attr("data-attachedUl", ts);
        $(window).resize(function () {
          $ul.css("display", "none").data("top");
        });
      } else {
        $ul = $("[data-parent=" + $buttonGroup.attr("data-attachedUl") + "]");
      }
      if (!$buttonGroup.hasClass("open")) {
        $ul.css("display", "none");
        return;
      }
      dropDownFixPosition($(this).parent(), $ul);
      function dropDownFixPosition(button, dropdown) {
        var dropDownTop = button.offset().top + button.outerHeight();
        dropdown.css("top", dropDownTop + "px");
        dropdown.css("left", button.offset().left + "px");
        dropdown.css("position", "absolute");

        dropdown.css("width", dropdown.width());
        dropdown.css("heigt", dropdown.height());
        dropdown.css("display", "block");
        dropdown.appendTo("body");
      }
    }
  );
});
