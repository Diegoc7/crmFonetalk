<button id="addUser" data-toggle="tooltip"  data-placement="left" title="Abrir Formulário" onclick="abreForm()" class="btn btn-round btn-primary btn-lg"><i class="fa fa-plus"></i></button>
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Usuário</li>
    </ul>
</div>
<!-- Forms Section-->
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
                        <h3 class="h4">Inserindo Usuário</h3>
                    </div>
                    <div class="card-body">
                        <form id="form-insert-user" class="form-horizontal" action="usuarios/insere" method="POST">
                            <div class="row">
                                <label class="col-sm-3 form-control-label text-bold">Dados Obrigatórios</label>
                                <div class="col-sm-9">
                                    <div class="form-group-material">
                                        <input id="nome" type="text" name="nome" required class="input-material" maxlength="50" minlength="4">
                                        <label for="nome" class="label-material">Nome Completo</label>
                                    </div>
                                    <div class="form-group-material">
                                        <input id="login" type="text" name="login" required class="input-material" maxlength="20" minlength="4">
                                        <label for="login" class="label-material">Login único</label>
                                    </div>
                                    <div class="form-group-material">
                                        <input id="email" type="email" name="email" required class="input-material" maxlength="100" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Digite um e-mail válido">
                                        <label for="email" class="label-material">E-mail </label>
                                    </div>
                                    <div class="form-group-material">
                                        <input id="senha" type="password" name="senha" required class="input-material" maxlength="32" minlength="4">
                                        <label for="senha" class="label-material">Senha        </label>
                                    </div>
                                    <div class="form-group-material">
                                        <input id="repitaSenha" type="password" name="repitaSenha" required class="input-material" maxlength="32" minlength="4">
                                        <label for="repitaSenha" class="label-material">Repita a senha        </label>
                                    </div>
                                    <div class="form-group-material">
                                        <select id="tipo" name="tipo" required  class="selectpicker form-control  show-tick" title="nenhum selecionado" >
                                            <option value="1" selected>Adminstrador</option>
                                            <option value="2">Operador</option>
                                            <option value="3">Vendedor</option>
                                        </select>
                                    </div>
<!--                                    <label class="text-info"><strong>datas:</strong></label>
                                    <div class="input-group input-daterange " id="datepicker">
                                        <input type="text" class="input-sm form-control" maxlength="10" minlength="10" placeholder="Ex.: 01/01/2011" name="data_inicio" id="data_inicio" />
                                        <span style="background-color: white; border-color: white;" class="input-group-addon"> <label class="text-primary">Até</label></span>
                                        <input type="text" class="input-sm form-control" placeholder="Ex.: 02/01/2011" name="data_fim"  id="data_fim" />
                                    </div>-->
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-3 ">
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
                            <th>Nome</th>
                            <th>Login</th>
                            <th>E-mail</th>
                            <th>Tipo</th>
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

