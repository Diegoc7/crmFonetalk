<button id="addUser" data-toggle="tooltip"  data-placement="left" title="Abrir Formulário" onclick="abreForm()" class="btn btn-round btn-primary btn-lg"><i class="fa fa-plus"></i></button>
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Atividades</li>
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
                        <h3 class="h4">Inserindo Atividades</h3>

                    </div>

                    <div class="card-body">
                        <form id="form-insert-activity" class="form-horizontal" action="atividades/insere" method="POST">
                            <div class="row">
                                <!--<label class="col-sm-6 form-control-label text-bold">Dados Obrigatórios </label>-->
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        
                                        <select id="tipo" name="tipo"   class="selectpicker form-control  show-tick" data-live-search="true" title="tipo de atividade" required="required" >
                                            <option id="E-mail">E-mail</option>
                                            <option id="Feedback">Feedback</option>
                                            <option id="Ligação">Ligação</option>
                                            <option id="Reunião">Reunião</option>
                                            <option id="Visita">Visita</option>
                                        </select>
                                        
                                    </div>

                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group-material">
                                        <input id="assunto" type="text" name="assunto" required class="input-material " maxlength="50" minlength="4">
                                        <label for="assunto" class="label-material">Assunto</label>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
                                        <select id="negocio" name="negocio"  required  class="selectpicker form-control  show-tick" data-live-search="true" title="négocio" >
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                   <div class="form-group-material">
                                        <input id="dataAgendamento" type="text" required name="dataAgendamento"  class="input-material dataFormato" maxlength="100"  >
                                        <label for="dataAgendamento" class="label-material">Data Agendamento </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="form-group-material">
                                         <input id="hora" type="time" name="hora" required  class="input-material"   >
                                        <label for="hora" class="label-material">Hora </label>
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
                                        <select id="empresa" name="empresa"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione uma empresa" >
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <!--<input id="data" type="text" name="data"  class="input-material dataFormato" maxlength="100"  >-->
                                        <label for="obs" class="label-material">Observação </label>
                                        <textarea id="observacao" name="observacao" class="form-control" maxlength="150" placeholder="Insira alguma observação" ></textarea>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-0 ">
                                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['ID']; ?>" />
                                    <a href="#" onclick="fechaForm();" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Agendar</button>
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
                        <h3 class="h4">Editando Atividades</h3>
                    </div>
                    <div class="card-body">
                        <form id="form-edit-activity" class="form-horizontal" action="atividades/edita" method="POST">
                            <div class="row">
                                <!--<label class="col-sm-6 form-control-label text-bold">Dados Obrigatórios </label>-->
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        
                                        <select id="tipoEdit" name="tipoEdit"   class="selectpicker form-control  show-tick" data-live-search="true" title="tipo de atividade" required="required" >
                                            <option id="E-mail">E-mail</option>
                                            <option id="Feedback">Feedback</option>
                                            <option id="Ligação">Ligação</option>
                                            <option id="Reunião">Reunião</option>
                                            <option id="Visita">Visita</option>
                                        </select>
                                        
                                    </div>

                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group-material">
                                        <input id="assuntoEdit" type="text" name="assuntoEdit" required class="input-material " maxlength="50" minlength="4">
                                        <label for="assuntoEdit" class="label-material">Assunto</label>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
                                        <select id="negocioEdit" name="negocioEdit"  required  class="selectpicker form-control  show-tick" data-live-search="true" title="négocio" >
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                   <div class="form-group-material">
                                        <input id="dataAgendamentoEdit" type="text" required name="dataAgendamentoEdit"  class="input-material dataFormato" maxlength="100"  >
                                        <label for="dataAgendamentoEdit" class="label-material">Data Agendamento </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     <div class="form-group-material">
                                         <input id="horaEdit" type="time" name="horaEdit" required  class="input-material"   >
                                        <label for="horaEdit" class="label-material">Hora </label>
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
                                        <select id="empresaEdit" name="empresaEdit"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione uma empresa" >
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <!--<input id="data" type="text" name="data"  class="input-material dataFormato" maxlength="100"  >-->
                                        <label for="obs" class="label-material">Observação </label>
                                        <textarea id="observacaoEdit" name="observacaoEdit" class="form-control" maxlength="150" placeholder="Insira alguma observação" ></textarea>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-0 ">
                                    <input type="hidden" name="id_user_edit" value="<?php echo $_SESSION['ID']; ?>" />
                                    <input type="hidden" id="id_atividade" name="id_atividade" value="" />
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
                        <h3 class="h4 ">Tabela de Atividades</h3>
                    </div>
                    <div class="card-body divTabela">
                        <table class="tabela table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Assunto</th>
                                    <th>Data</th>
                                    <th>Hora</th>
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
<div class="modal fade" id="modalAtividades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" >
                <h4 class="modal-title"  id="exampleModalLabel">Atividade</h4>
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
                                    <div class="client-avatar"><i class="fa fa-lightbulb-o fa-5x" aria-hidden="true"></i>
                                    <!--<div class="client-avatar"><img src="assets/images/fonetalk_logo.png" alt="..." class="img-fluid rounded-circle">-->
                                        <!--<div class="status bg-green"></div>-->
                                    </div>
                                    <div class="client-title">
                                        <h3 id="mostraAssunto">No Name</h3><span id="mostraTipo">Sem Tipo</span><button id="btnDelAtividade"  class="btnDelAtividade btn btn-outline-danger  btn-sm" >Deletar</button>
                                    </div>
<!--                                    <div class="client-info">
                                        <div class="row">
                                            <div class="col-4"><strong id="contNotas">0</strong><br><small>Notas</small></div>
                                            <div class="col-4"><strong>0</strong><br><small>Ativida.</small></div>
                                            <div class="col-4"><strong id="contEdit">0</strong><br><small>Edições</small></div>
                                        </div>
                                    </div>-->
                                    <div class="small">
                                        <i class="fa fa-money fa-1x" aria-hidden="true"></i> <span id="mostraNegocio"></span> 
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
                                            <!--<strong>Usuário : </strong><span id="mostraUsuario"></span><br/>-->
                                            <!--<strong>Contato :</strong><span id="mostraContato"></span><br/>-->
                                            <strong>Empresa:</strong> <span id="mostraEmpresa"></span><br/>
                                            <strong>Contato:</strong> <span id="mostraContato"></span><br/>
                                            <strong>Observação:</strong> <span id="mostraObservacao"></span><br/>
                                        </div>
                                    </div>
                                </div>
<!--                                <div class="card">
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
                                </div>-->

                            </div>
                        </div>
                        <div class="col-md-7 col-md-offset-5">
<!--                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link " href="#profile" role="tab" data-toggle="tab">Notas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Atividade</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#references" role="tab" data-toggle="tab">Editar</a>
                                </li>
                            </ul>-->

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade  " id="profile">
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
                            <div  class="cardAtividade card border" style="color: #FFFFFF;" >
                                <h3 class="cardAtividade card-header border ">
                                    Atividade
                                </h3>
                                <div class="card-body">
                                    <h4 class="card-title">Negocio inserido no sistema: <span id="dateCreate"></span></h4>
                                    <p class="card-text">Data Agendada: <span id="dataAtividadeAgendamento"></span></p>
                                    <p class="card-text">Hora Agendada: <span id="horaAtividadeAgendamento"></span></p>
                                    <!--<p class="card-text">Status: <span id="valorCreate"></span></p>-->
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