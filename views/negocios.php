<button id="addUser" data-toggle="tooltip"  data-placement="left" title="Abrir Formulário" onclick="abreForm()" class="btn btn-round btn-primary btn-lg"><i class="fa fa-plus"></i></button>
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Négocios</li>
    </ul>
</div>
<section class="forms" style="display: none;">
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
                                        <input id="valor" type="text" required name="valor"  class="input-material" data-thousands="." data-decimal="," data-prefix="R$ " value="R$ 0,00"  >
                                        <label for="valor" class="label-material">Valor </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                   <div class="form-group-material">
                                        <input id="dataPrevisao" required type="text" name="dataPrevisao"  class="input-material dataFormato" maxlength="100"  >
                                        <label for="dataPrevisao" class="label-material">Data Prevista </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
<!--                                        <select id="contato" name="contato"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione um contato" >
                                        </select>-->
                                        <input id="contato" type="text" name="contato"  class="input-material" autocomplete="off" maxlength="100"  >
                                        <input id="idBuscaContato" type="hidden" name="idBuscaContato"   >
                                        <label for="contato" class="label-material">Contato </label>
                                        <div id="respostaContato" >
                                            <ul>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
                                        <select id="status" name="status" required  class="selectpicker form-control  show-tick" data-live-search="true" title="Status" >
                                            <option id="Aberto">Aberto</option>
                                            <option id="Ganhou">Ganhou</option>
                                            <option id="Perdido">Perdido</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
<!--                                        <select id="empresa" name="empresa"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione uma empresa" >
                                        </select>-->
                                        <input id="empresa" type="text" name="empresa"  class="input-material" autocomplete="off" maxlength="100"  >
                                        <input id="idBuscaEmpresa" type="hidden" name="idBuscaEmpresa"   >
                                        <label for="contato" class="label-material">Empresa </label>
                                        <div id="respostaEmpresa" >
                                            <ul>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-0 ">
                                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['ID']; ?>" />
                                    <a href="#" onclick="fechaForm();" class="btn btn-secondary">Cancelar</a>
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
                        <h3 class="h4">Editando Negocio</h3>
                    </div>
                    <div class="card-body">
                        <form id="form-edit-business" class="form-horizontal" action="negocios/edita" method="POST">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <input id="nomeEdit" type="text" name="nomeEdit" required class="input-material " maxlength="50" minlength="4">
                                        <label for="nomeEdit" class="label-material">Nome</label>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
                                        <select id="faseEdit" name="faseEdit"   class="selectpicker form-control  show-tick" data-live-search="true" title="Fase do négocio" >
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
                                        <input id="valorEdit" type="text" name="valorEdit" required  class="input-material" data-thousands="." data-decimal="," data-prefix="R$ " value="R$ 0,00"  >
                                        <label for="valorEdit" class="label-material">Valor </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                   <div class="form-group-material">
                                        <input id="dataPrevisaoEdit" required type="text" name="dataPrevisaoEdit"  class="input-material dataFormato" maxlength="100"  >
                                        <label for="dataPrevisaoEdit" class="label-material">Data Prevista </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
                                        <select id="contatoEdit" name="contatoEdit"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione um contato" >

                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
                                        <select id="statusEdit" name="statusEdit" required  class="selectpicker form-control  show-tick" data-live-search="true" title="Status" >
                                            <option id="Aberto">Aberto</option>
                                            <option id="Ganhou">Ganhou</option>
                                            <option id="Perdido">Perdido</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
                                        <select id="empresaEdit" name="empresaEdit"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione uma empresa" >
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-0 ">
                                    <input type="hidden" name="id_user_edit" value="<?php echo $_SESSION['ID']; ?>" />
                                    <input type="hidden" id="id_negocio" name="id_negocio" value="" />
                                    <button type="submit" class="btn btn-secondary">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Editar</button>
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
                                    <th>Nome</th>
                                    <th>Valor</th>
                                    <th>Empresa</th>
                                    <th>Contato</th>
                                    <th>Usuario</th>
                                    <th>Funções</th>
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
<div class="modal fade" id="modalNegocios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" >
                <h4 class="modal-title"  id="exampleModalLabel">Négocios</h4>
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
                                    <div class="client-avatar"><i class="fa fa-money fa-5x" aria-hidden="true"></i>
                                    <!--<div class="client-avatar"><img src="assets/images/fonetalk_logo.png" alt="..." class="img-fluid rounded-circle">-->
                                        <!--<div class="status bg-green"></div>-->
                                    </div>
                                    <div class="client-title">
                                        <h3 id="nome_negocio">No Name</h3><span id="mostraStatus">Sem Cargo</span><button disabled class="btn btn-outline-danger  btn-sm" id="desativaCliente">Desativar</button>
                                    </div>
<!--                                    <div class="client-info">
                                        <div class="row">
                                            <div class="col-4"><strong id="contNotas">0</strong><br><small>Notas</small></div>
                                            <div class="col-4"><strong>0</strong><br><small>Ativida.</small></div>
                                            <div class="col-4"><strong id="contEdit">0</strong><br><small>Edições</small></div>
                                        </div>
                                    </div>-->
                                    <div class="small">
                                        <i class="fa fa-money fa-1x" aria-hidden="true"></i> <span id="mostraValor"></span> 
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
                                            <strong>Fase : </strong><span id="mostraFase"></span><br/>
                                            <strong>Previsão :</strong><span id="mostraPrevisao"></span><br/>
                                            <!--<strong>Status :</strong><span id="mostraStatus"></span><br/>-->
                                            <strong>Empresa:</strong> <span id="mostraEmpresa"></span><br/>
                                            <strong>Contato:</strong> <span id="mostraContato"></span><br/>
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
                                        <div  id="mostraArquivos" class="card-body">
                                            Sem Arquivos
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-7 col-md-offset-5">
                            <ul class="nav nav-tabs" role="tablist">
<!--                                <li class="nav-item">
                                    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Notas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Atividade</a>
                                </li>-->
                                <li class="nav-item">
                                    <a class="nav-link" href="#references" role="tab" data-toggle="tab">Arquivos</a>
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
                                <div role="tabpanel" class="tab-pane fade" id="references">
                                    <br/>
                                    <div class="alert-file alert ">
<!--                                        <strong>Success!</strong> Indicates a successful or positive action.-->
                                    </div> 
                                    <form class="form-insert-file-business" method="POST" action="arquivos/anexar" enctype="multipart/form-data">
                                        <label class="label label-default label-material"><strong>Insira um arquivo de até 4 MB </strong></label>
                                        <input type="file" name="arquivo" class="form-control btn btn-primary" /><br/><br/>
                                        <input type="hidden" name="tipo" value="negocios" />
                                        <input type="hidden" name="id" id="id_negocio_arquivo" />
                                        <button type="submit" id="btn_send_form" class="btn btn-primary"> Enviar</button>
                                    </form>
                                    <hr/>
                                </div>
                            </div>
                            <div id="writeNotes">

                            </div>
                            <!--<div id="writeDateCreate">-->
                            <div class="card border border-info bg-info" style="color: #FFFFFF;" >
                                <h3 class="card-header border border-info bg-info">
                                    Negocio Criado
                                </h3>
                                <div class="card-body">
                                    <h4 class="card-title">Negocio inserido no sistema: <span id="dateCreate"></span></h4>
                                    <p class="card-text">Status Inicial: <span id="statusCreate"></span></p>
                                    <p class="card-text">Fase Inicial: <span id="faseCreate"></span></p>
                                    <p class="card-text">Valor Original: <span id="valorCreate"></span></p>
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