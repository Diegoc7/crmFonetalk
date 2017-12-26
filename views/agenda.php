<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="index.php">Contatos</a></li>
        <li class="breadcrumb-item active">Contato</li>
    </ul>
</div>
<section class="forms" style="display: block;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Agenda</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="createEventModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Adicionando Evento</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <label class="control-label" for="inputPatient">Evento:</label>
                    <div class="field desc">
                        <input class="form-control" id="title" name="title" placeholder="Event" type="text" value="">
                    </div>
                </div>

                <input type="hidden" id="startTime"/>
                <input type="hidden" id="endTime"/>



                <div class="control-group">
                    <label class="control-label" for="when">Quando:</label>
                    <div class="controls controls-row" id="when" style="margin-top:5px;">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="submitButton">Salvar</button>
            </div>
        </div>

    </div>
</div>


<div id="calendarModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalhes do Evento</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="modalBody" class="modal-body">
                <h4 id="modalTitle" class="modal-title"></h4>
                <div id="modalWhen" style="margin-top:5px;"></div>
            </div>
            <input type="hidden" id="eventID"/>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button type="submit" class="btn btn-danger" id="deleteButton">Deletar</button>
            </div>
        </div>
    </div>
</div>