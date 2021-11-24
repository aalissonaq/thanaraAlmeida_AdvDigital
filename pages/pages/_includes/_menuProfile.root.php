<?php

echo

// <a href=\"?page=verCliente&id={$dados['idPassoaPessoa']}\"class=\"btn btn-tool \"target=\"\"title=\"Visializar Dados\"rel=\"noopener noreferrer\">
//     <i class=\"mdi mdi-file-eye-outline mdi-24px fa fa-fw\"></i>
//   </a>

"

<a href=\"?page=listarClientes\"
                      class=\"btn btn-tool \"
                      target=\"\"
                      title=\"Voltar\"
                      rel=\"noopener noreferrer\">
                        <i class=\"mdi mdi-arrow-left-circle-outline mdi-24px fa fa-fw\"></i>
                      </a>
                      <a
                      href=\"#settings\"
                      class=\"btn btn-tool \"
                      target=\"\"
                      data-toggle=\"tab\"
                      title=\"Editar Dados\"
                      rel=\"noopener noreferrer\" >
                        <i class=\"mdi mdi-account-edit-outline mdi-24px fa fa-fw\"></i>
                      </a>


                      <button

                      data-toggle=\"modal\"
                      data-target=\"#modal-edtFoto\"
                      data-id=\"<?= @$id ?>\"
                      onclick=\"setaDadosModal(<?= @$id ?> )\"
                      class=\"btn btn-tool \"
                      target=\"\"
                      title=\"Trocar Foto\"
                      rel=\"noopener noreferrer\" >
                        <i class=\"mdi mdi-camera-flip-outline mdi-24px fa fa-fw\"></i>
                      </button>




                ";

                // <a
                // href=\"?page=processos&id={$dados['idPassoaPessoa']}\"
                // class=\"btn btn-tool text-primary\"
                // target=\"\"
                // title=\"Processos do Cliente\"
                // rel=\"noopener noreferrer\">
                //   <i class=\"mdi mdi-scale-balance mdi-24px fa fa-fw\"></i>
                // </a>

                // <button
                //       data-toggle=\"modal\"
                //       data-target=\"#modal-edtFoto\"
                //       data-id=\"{@$dados['idPessoaCliente']}\"
                //       onclick=\"setaDadosModal({$dados['idPessoaCliente']})\"
                //       class=\"btn btn-tool \"
                //       target=\"\"
                //       title=\"Trocar Foto\"
                //       rel=\"noopener noreferrer\" >
                //         <i class=\"mdi mdi-camera-flip-outline mdi-24px fa fa-fw\"></i>
                //       </button>
