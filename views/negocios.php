<button id="addUser" data-toggle="tooltip"  data-placement="left" title="Abrir Formulário" onclick="abreForm()" class="btn btn-round btn-primary btn-lg"><i class="fa fa-plus"></i></button>
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Négocios</li>
    </ul>
</div>
<section class="forms" style="display: block;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-close">
                        <div class="dropdown">
                            <button type="button" id="closeCard5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                            <div aria-labelledby="closeCard5" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item " onclick="fechaForm();"> <i class="fa fa-times"></i>Fechar</a>
                                <!--<a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a>-->
                            </div>
                        </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Inserindo Négocios</h3>

                    </div>

                    <div class="card-body">
                        <form id="form-insert-business" class="form-horizontal" action="negocios/insere" method="POST">
                            <div class="row">
                                <!--<label class="col-sm-6 form-control-label text-bold">Dados Obrigatórios </label>-->
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <input id="nome" type="text" name="nome" required class="input-material " maxlength="50" minlength="4">
                                        <label for="nome" class="label-material">Nome</label>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
                                        <select id="fase" name="fase"   class="selectpicker form-control  show-tick" data-live-search="true" title="Fase do négocio" >
                                            <option id="novo">Novo</option>
                                            <option id="visita">Visita</option>
                                            <option id="proposta">Proposta Apresentada</option>
                                            <option id="trial">Trial</option>
                                            <option id="negociacao">Em Négociação</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="form-group-material">
                                        <input id="valor" type="text" name="valor"  class="input-material" data-thousands="." data-decimal="," data-prefix="R$ " value="R$ 0,00"  >
                                        <label for="valor" class="label-material">Valor </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                   <div class="form-group-material">
                                        <input id="dataPrevisao" type="text" name="dataPrevisao"  class="input-material dataFormato" maxlength="100"  >
                                        <label for="dataPrevisao" class="label-material">Data Prevista </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
                                        <select id="contato" name="contato"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione um contato" >

                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
                                        <select id="status" name="status"   class="selectpicker form-control  show-tick" data-live-search="true" title="Status" >
                                            <option id="Aberto">Aberto</option>
                                            <option id="Ganhou">Ganhou</option>
                                            <option id="Perdido">Perdido</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
                                        <select id="empresa" name="empresa"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione uma empresa" >
                                        </select>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-0 ">
                                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['ID']; ?>" />
                                    <button type="submit" class="btn btn-secondary">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Inserir</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="edit" style="display: none;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Editando Empresa</h3>
                    </div>
                    <div class="card-body">
                        <form id="form-edit-company" class="form-horizontal" action="empresas/edita" method="POST">
                            <div class="row">
                                <!--<label class="col-sm-6 form-control-label text-bold">Dados Obrigatórios </label>-->
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <input id="nomeEdit" type="text" name="nomeEdit" required class="input-material " maxlength="50" minlength="4">
                                        <label for="nomeEdit" class="label-material">Nome Completo</label>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
                                        <select id="contatoEdit" name="contatoEdit"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione um contato" >

                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group-material">
                                        <input id="cargoEdit" type="text" name="cargoEdit"  class="input-material" maxlength="100"  >
                                        <label for="cargoEdit" class="label-material">Cargo </label>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group-material">
                                        <select id="tipoCellEdit" name="tipoCellEdit"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione um tipo" >
                                            <option value="" ></option>
                                            <option value="Celular" >Celular</option>
                                            <option value="Comercial" >Comercial</option>
                                            <option value="Residencial" >Residencial</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <input id="telefoneEdit" type="text" name="telefoneEdit"  class="input-material telFormato " disabled="disabled" maxlength="32" minlength="4">
                                        <label for="telefoneEdit" class="label-material">Telefone        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2" style="color: white;">
                                    <a class="btn btn-md btn-primary" data-toggle="tooltip"  data-placement="left" title="Adicionar Telefone" id="addTellEdit" onclick="addTelEdit(0);"><i class="fa fa-plus"></i></a>
                                    <a class="btn btn-md btn-secondary disabled" data-toggle="tooltip"  data-placement="left" title="Remover Telefone" id="remTellEdit" onclick="removeTelEdit(0);"><i class="fa fa-minus"></i></a>
                                </div>
                                <div class="col-sm-6 tell2Edit">
                                    <div class="form-group-material">
                                        <select id="tipoCell2Edit" name="tipoCell2Edit"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione um tipo" >
                                            <option value="" ></option>
                                            <option value="Celular" >Celular</option>
                                            <option value="Comercial" >Comercial</option>
                                            <option value="Residencial" >Residencial</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-6 tell2Edit">
                                    <div class="form-group-material">
                                        <input id="telefone2Edit" type="text" name="telefone2Edit"  class="input-material telFormato"  disabled="disabled" maxlength="32" minlength="4">
                                        <label for="telefone2Edit" class="label-material">Telefone        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 tell3Edit">
                                    <div class="form-group-material">
                                        <select id="tipoCell3Edit" name="tipoCell3Edit"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione um tipo" >
                                            <option value="" ></option>
                                            <option value="Celular" >Celular</option>
                                            <option value="Comercial" >Comercial</option>
                                            <option value="Residencial" >Residencial</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-6 tell3Edit">
                                    <div class="form-group-material">
                                        <input id="telefone3Edit" type="text" name="telefone3Edit"  class="input-material telFormato" disabled="disabled"  maxlength="32" minlength="4">
                                        <label for="telefone3Edit" class="label-material">Telefone        </label>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group-material">
                                        <input id="emailEdit" type="email" name="emailEdit"  class="input-material" maxlength="32" minlength="4" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Digite um e-mail válido">
                                        <label for="emailEdit" class="label-material">E-mail</label>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <input id="cnpjEdit" type="text" name="cnpjEdit"  class="input-material cpfFormato" maxlength="100"  >
                                        <label for="cnpjEdit" class="label-material">CNPJ </label>
                                    </div>
                                </div>
                                <!--                                <div class="col-sm-4">
                                                                    <div class="form-group-material">
                                                                        <input id="dataEdit" type="text" name="dataEdit"  class="input-material dataFormato" maxlength="100"  >
                                                                        <label for="dataEdit" class="label-material">Data de Nascimento </label>
                                                                    </div>
                                                                </div>-->
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <input id="siteEdit" type="text" name="siteEdit"  class="input-material" maxlength="100"  >
                                        <label for="siteEdit" class="label-material">Site </label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <input id="enderecoEdit" type="text" name="enderecoEdit"  class="input-material" maxlength="100"  >
                                        <label for="enderecoEdit" class="label-material">Endereço </label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <!--<input id="data" type="text" name="data"  class="input-material dataFormato" maxlength="100"  >-->
                                        <label for="obsEdit" class="label-material">Observação </label>
                                        <textarea id="observacaoEdit" name="observacaoEdit" class="form-control" maxlength="150" placeholder="Insira alguma observação" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-0 ">
                                    <input type="hidden" name="id_user_edit" value="<?php echo $_SESSION['ID']; ?>" />
                                    <input type="hidden" id="id_empresa" name="id_empresa" value="" />
                                    <button type="submit" class="btn btn-secondary">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Inserir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tables">   
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-close">
                        <!--                      <div class="dropdown">
                                                <button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                                                <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                                              </div>-->
                    </div>
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4 ">Tabela de Usuários do Sistema</h3>
                    </div>
                    <div class="card-body divTabela">
                        <table class="tabela table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Razão</th>
                                    <th>Telefone*</th>
                                    <th>E-mail</th>
                                    <th>Contatos</th>
                                    <th>Funcões</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<div class="modal fade" id="modalEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" >
                <h4 class="modal-title"  id="exampleModalLabel">Empresa</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="client card">
                                <div class="card-close">
                                    <div class="dropdown">
                                        <button type="button" id="closeCard2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                                        <div aria-labelledby="closeCard2" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <div class="client-avatar"><i class="fa fa-building fa-5x" aria-hidden="true"></i>
                                    <!--<div class="client-avatar"><img src="assets/images/fonetalk_logo.png" alt="..." class="img-fluid rounded-circle">-->
                                        <div class="status bg-green"></div>
                                    </div>
                                    <div class="client-title">
                                        <h3 id="nome_cliente">No Name</h3><span id="cargo_cliente">Sem Cargo</span><button class="btn btn-outline-danger  btn-sm" id="desativaCliente">Desativar</button>
                                    </div>
                                    <div class="client-info">
                                        <div class="row">
                                            <div class="col-4"><strong id="contNotas">0</strong><br><small>Notas</small></div>
                                            <div class="col-4"><strong>0</strong><br><small>Ativida.</small></div>
                                            <div class="col-4"><strong id="contEdit">0</strong><br><small>Edições</small></div>
                                        </div>
                                    </div>
                                    <div class="small">
                                        <i class="fa fa-phone fa-1x" aria-hidden="true"></i><span id="mostraTipoTelefonePrincipal"></span> <span id="mostraTelefonePrincipal"></span> 
                                    </div>
                                </div>
                            </div>
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header">
                                        <a class="card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Dados Adicionais
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="collapse show">
                                        <div class="card-body">
                                            <strong>CNPJ : </strong><span id="mostraCNPJ"></span><br/>
                                            <strong>Endereço :</strong><span id="mostraEndereco"></span><br/>
                                            <!--<strong>Origem :</strong><span id="mostraOrigem"></span><br/>-->
                                            <!--<strong>Nascimento:</strong> <span id="mostraDataNascimento"></span><br/>-->
                                            <strong>Contato:</strong> <span id="mostraContato"></span><br/>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            Négocios
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="collapse">
                                        <div class="card-body">
                                            Sem Négocios
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseExtra">
                                            Dados extras
                                        </a>
                                    </div>
                                    <div id="collapseExtra" class="collapse">
                                        <div class="card-body">
                                            <strong>Telefones Adicionais:</strong><br/>
                                            <strong id="mostrarTipoTell2"></strong>: <span id="mostrarTell2"></span><br/>
                                            <strong id="mostrarTipoTell3"></strong>: <span id="mostrarTell3"></span><br/>
                                            <hr/>
                                            <strong>Observação:</strong><br/>
                                            <span id="mostrarObs"></span><br/>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            Arquivos
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="collapse">
                                        <div class="card-body">
                                            Sem Arquivos
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-7 col-md-offset-5">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Notas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Atividade</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#references" role="tab" data-toggle="tab">Editar</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="profile">
                                    <br/>
                                    <div class="line"></div>
                                    <textarea id="nova_nota" class="form-control" placeholder="Insira uma nota"></textarea>
                                    <br/>
                                    <div class="line"></div>
                                    <div class="btn-group">
                                        <button id="btnEnviarNota" class="btn btn-primary">Enviar</button>
                                    </div>
                                    <hr/>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="buzz">
                                    <br/>
                                    <form id="form-insert-activity" class="form-horizontal" action="contatos/atividade" method="POST">
                                        <div class="col-sm-12">
                                            <div class="form-group-material">
                                                <select id="tipoAtividade" name="tipoAtividade" required="required"  class=" form-control  show-tick" data-live-search="true" title="Selecione um tipo" >
                                                    <option value="" ></option>
                                                    <option value="email" >E-mail</option>
                                                    <option value="feedback" >Feedback</option>
                                                    <option value="ligacao" >Ligação</option>
                                                    <option value="reuniao" >Reunião</option>
                                                    <option value="visita" >Visita</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12">
                                            
                                            <div class="form-group-material">
                                                <!--<label for="assunto">Assunto</label>-->
                                                <input id="assunto" placeholder="Assunto (obrigatório)" type="text" name="assunto" required="required" class="" maxlength="100"  >
                                                <!--<label for="assunto" class="label-material">Assunto </label>-->
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group-material">
                                                <input id="dataAgenda" placeholder="Data" type="text" name="data"  class="input-material dataFormato" maxlength="100"  >
                                                <!--<label for="dataAgenda" class="label-material">Data</label>-->
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group-material">
                                                <label for="assunto">Hora</label>
                                                <input id="horaAgenda" value="08:00" type="time" name="horaAgenda"  class="input-material" maxlength="100"  >
                                                <!--<label for="horaAgenda" class="label-material">Hora </label>-->
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group-material">
                                                <select id="tipoNegocios" name="tipoNegocios"   class="form-control  show-tick" data-live-search="true" title="Selecione um tipo" >
                                                    <option value="" ></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group-material">
                                                <!--<input id="data" type="text" name="data"  class="input-material dataFormato" maxlength="100"  >-->
                                                <label for="obsTipo" class="label-material">Observação </label>
                                                <textarea id="obsTipo" name="obsTipo" class="form-control" maxlength="150" placeholder="Insira alguma observação" ></textarea>
                                            </div>
                                        </div>
                                        <div class="line"></div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 offset-sm-0 ">
                                                <input type="hidden" name="id_client" value="" />
                                                <input type="hidden" name="id_user" value="<?php echo $_SESSION['ID']; ?>" />
                                                <button type="reset" class="btn btn-secondary">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Agendar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="references">ccc</div>
                            </div>
                            <div id="writeNotes">

                            </div>
                            <!--<div id="writeDateCreate">-->
                            <div class="card border border-info bg-info" style="color: #FFFFFF;" >
                                <h3 class="card-header border border-info bg-info">
                                    Contato Criado
                                </h3>
                                <div class="card-body">
                                    <!--<h4 class="card-title">Inserida ás 12/09/2011 13:49:21</h4>-->
                                    <p class="card-text">Cliente inserido no sistema: <span id="dateCreate"></span></p>
                                </div>
                                <div class="card-footer">
                                    por: <span id="userCreate"></span>
                                </div>
                            </div>
                            
                        </div>
                        <!--<div class="container-fluid">-->
                        <div class="col-lg-12">

                        </div>
                        <!--</div>-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>