$(function () {

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })

  //Initialize Select2 Elements
  $('.select2').select2()

  $("input").iCheck({
    checkboxClass: "icheckbox_square-blue",
    radioClass: "iradio_square-blue",
    increaseArea: "20%" /* optional */
  });
});

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
$(".js_cpf").mask("000.000.000-00", {
  reverse: true
});
$('.js_dinheiro').mask('#.##0,00', {
  reverse: true
});
$(".js_cnpj").mask("00.000.000/0000-00", {
  reverse: true
});
$(".js_cep").mask("00000-000", {
  reverse: true
});
$(".js_data").mask("00/00/0000", {
  reverse: true
});
$(".js_num").mask("000000000000000000000", {
  reverse: true
});
$(".js_numCNJ").mask("0000000-00.0000.0.00.0000", {
  reverse: true
});

// CPF_CNPJ
var options = {
  onKeyPress: function (cpf, ev, el, op) {
    var masks = ["000.000.000-000", "00.000.000/0000-00"];
    $(".cpfOuCnpj").mask(cpf.length > 14 ? masks[1] : masks[0], op);
  }
};

$(".cpfOuCnpj").length > 11
  ? $(".cpfOuCnpj").mask("00.000.000/0000-00#", options)
  : $(".cpfOuCnpj").mask("000.000.000-00#", options);

// DATATABLE
$(".table").DataTable({
  responsive: true,
  bLengthChange: true,
  pageLength: 10,
  bInfo: true,
  bFilter: true,
  bSort: false,
  language: {
    url:
      "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
  }
});
$(".tableP").DataTable({
  responsive: true,
  bLengthChange: true,
  pageLength: 4,
  bInfo: true,
  bFilter: true,
  bSort: true,
  language: {
    url:
      "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
  }
});


$(function () {
  // Summernote
  $('.js_textareaEdt').summernote({
    height: 200,
    lang: 'pt-BR', // default: 'en-US'
    //placeholder: 'Hello bootstrap 4',
    // tabsize: 3,
  });
})

$(function () {
  $('.js_edtNoToolBar').summernote({
    height: 200,
    toolbar: false,
  });
})

function Idade() {
  hoje = new Date();
  dtn = $('#dtNascPessoa').val();
  nascimento = new Date(dtn);
  var diferencaAnos = hoje.getFullYear() - nascimento.getFullYear();
  if (new Date(hoje.getFullYear(), hoje.getMonth(), hoje.getDate()) <
    new Date(hoje.getFullYear(), nascimento.getMonth(), nascimento.getDate()))
    diferencaAnos--;

  if (diferencaAnos < 18) {
    document.getElementById('nmResponsavel').required = 'required';
  } else {
    document.getElementById('nmResponsavel').removeAttribute('required');
  }

}

function isRequiredPaymentVoucher(valor) {

  var dtpagaemnto = valor

  //Verifica se campo daat de pagameto possui valor.
  if (dtpagaemnto != "") {
    document.getElementById('strComprovanteDespesa').required = 'required';
  }
}
