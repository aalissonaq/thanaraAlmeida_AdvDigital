<?php

echo
"                      <a href=\"?page=verCliente&id={$dados['idPassoaPessoa']}\"
                      class=\"btn btn-tool text-primary\"
                      target=\"\"
                      title=\"Visializar Dados\"
                      rel=\"noopener noreferrer\">
                        <i class=\"mdi mdi-file-eye-outline fa fa-2x\"></i>
                      </a>

                      <a
                      href=\"?page=edtCliente&idEdit={$dados['idPassoaPessoa']}\"
                      class=\"btn btn-tool text-primary\"
                      target=\"\"
                      title=\"Editar Dados\"
                      rel=\"noopener noreferrer\" >
                        <i class=\"mdi mdi-account-edit-outline fa fa-2x\"></i>
                      </a>

                      <button
                      data-toggle=\"modal\"
                      data-target=\"#modal-edtFoto\"
                      data-id=\"{$dados['idPessoaCliente']}\"
                      onclick=\"setaDadosModal({$dados['idPessoaCliente']})\"
                      class=\"btn btn-tool text-primary\"
                      target=\"\"
                      title=\"Trocar Foto\"
                      rel=\"noopener noreferrer\" >
                        <i class=\"mdi mdi-camera-flip-outline fa fa-2x\"></i>
                      </button>

                      <a
                      href=\"?page=processos&id={$dados['idPassoaPessoa']}\"
                      class=\"btn btn-tool text-primary\"
                      target=\"\"
                      title=\"Processos do Cliente\"
                      rel=\"noopener noreferrer\">
                        <i class=\"mdi mdi-scale-balance fa fa-2x\"></i>
                      </a>

                ";
