<button id="addUser" data-toggle="tooltip"  data-placement="left" title="Abrir Formulário" onclick="abreForm()" class="btn btn-round btn-primary btn-lg"><i class="fa fa-plus"></i></button>
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Contatos</li>
    </ul>
</div>
<section class="forms" style="display: block;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Inserindo Contato</h3>
                    </div>
                    <div class="card-body">
                        <form id="form-insert-contact" class="form-horizontal" action="contatos/insere" method="POST">
                            <div class="row">
                                <!--<label class="col-sm-6 form-control-label text-bold">Dados Obrigatórios </label>-->
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <input id="nome" type="text" name="nome" required class="input-material " maxlength="50" minlength="4">
                                        <label for="nome" class="label-material">Nome Completo</label>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group-material">
                                        <!--<label for="empresa" class="label-material">Empresa</label>-->
                                        <select id="empresa" name="empresa"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione uma empresa" >

                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group-material">
                                        <input id="cargo" type="text" name="cargo"  class="input-material" maxlength="100"  >
                                        <label for="cargo" class="label-material">Cargo </label>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group-material">
                                        <select id="tipoCell" name="tipoCell"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione um tipo" >
                                            <option value="" ></option>
                                            <option value="Celular" >Celular</option>
                                            <option value="Comercial" >Comercial</option>
                                            <option value="Residencial" >Residencial</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <input id="telefone" type="text" name="telefone"  class="input-material telFormato " disabled="disabled" maxlength="32" minlength="4">
                                        <label for="telefone" class="label-material">Telefone        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2" style="color: white;">
                                    <a class="btn btn-md btn-primary" data-toggle="tooltip"  data-placement="left" title="Adicionar Telefone" id="addTell" onclick="addTel(0);"><i class="fa fa-plus"></i></a>
                                    <a class="btn btn-md btn-secondary disabled" data-toggle="tooltip"  data-placement="left" title="Remover Telefone" id="remTell" onclick="removeTel(0);"><i class="fa fa-minus"></i></a>
                                </div>
                                <div class="col-sm-6 tell2">
                                    <div class="form-group-material">
                                        <select id="tipoCell2" name="tipoCell2"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione um tipo" >
                                            <option value="" ></option>
                                            <option value="Celular" >Celular</option>
                                            <option value="Comercial" >Comercial</option>
                                            <option value="Residencial" >Residencial</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-6 tell2">
                                    <div class="form-group-material">
                                        <input id="telefone2" type="text" name="telefone2"  class="input-material telFormato"  disabled="disabled" maxlength="32" minlength="4">
                                        <label for="telefone2" class="label-material">Telefone        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 tell3">
                                    <div class="form-group-material">
                                        <select id="tipoCell3" name="tipoCell3"   class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione um tipo" >
                                            <option value="" ></option>
                                            <option value="Celular" >Celular</option>
                                            <option value="Comercial" >Comercial</option>
                                            <option value="Residencial" >Residencial</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-6 tell3">
                                    <div class="form-group-material">
                                        <input id="telefone3" type="text" name="telefone3"  class="input-material telFormato" disabled="disabled"  maxlength="32" minlength="4">
                                        <label for="telefone3" class="label-material">Telefone        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <input id="email" type="email" name="email"  class="input-material" maxlength="32" minlength="4" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Digite um e-mail válido">
                                        <label for="email" class="label-material">E-mail</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <select id="origem" name="origem" class="selectpicker form-control  show-tick" data-live-search="true" title="Selecione a origem" >
                                        <option value="" ></option>
                                        <option value="Chat" >Chat</option>
                                        <option value="Email" >E-mail</option>
                                        <option value="Facebook" >Facebook</option>
                                        <option value="Fachada" >Fachada</option>
                                        <option value="Google" >Google</option>
                                        <option value="Indicação" >Indicação</option>
                                        <option value="Instagram" >Instagram</option>
                                        <option value="excliente" >Já foi cliente</option>
                                        <option value="LinkedIn" >LinkedIn</option>
                                        <option value="Panfleto" >Panfleto</option>
                                        <option value="Rádio" >Rádio</option>
                                        <option value="Site" >Site</option>
                                        <option value="telefoneAtivo" >Telefone Ativo</option>
                                        <option value="telefonePassivo" >Telefone Passivo</option>
                                        <option value="Tv" >Tv</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <input id="cpf" type="text" name="cpf"  class="input-material cpfFormato" maxlength="100"  >
                                        <label for="cpf" class="label-material">CPF </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group-material">
                                        <input id="data" type="text" name="data"  class="input-material dataFormato" maxlength="100"  >
                                        <label for="data" class="label-material">Data de Nascimento </label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <input id="endereco" type="text" name="endereco"  class="input-material" maxlength="100"  >
                                        <label for="endereco" class="label-material">Endereço </label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group-material">
                                        <!--<input id="data" type="text" name="data"  class="input-material dataFormato" maxlength="100"  >-->
                                        <label for="obs" class="label-material">Observação </label>
                                        <textarea id="obs" class="form-control" maxlength="150" placeholder="Insira alguma observação" ></textarea>
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
