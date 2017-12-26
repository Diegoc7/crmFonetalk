<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <div class="row bg-white has-shadow">
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
               
                <div class="item d-flex align-items-center">
                    <div class="icon bg-warning"><i class="icon-user"></i></div>
                    <div class="title"><span>Clientes</span>
                        <div class="progress">
                            <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="{#val.value}" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-warning"></div>
                        </div>
                    </div>
                    <div class="number" ><strong id="numeroCliente">25</strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="fa fa-money"></i></div>
                    <div class="title"><span >Perdidas</span>
                        <div class="progress">
                            <div role="progressbar" id="barNegociacoesPerdidas" style="width: 0%; height: 4px;" aria-valuenow="{#val.value}" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                        </div>
                    </div>
                    <div class="number"><strong id="negociacoesPerdidas">0</strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="fa fa-money"></i></div>
                    <div class="title"><span>Aceitas</span>
                        <div class="progress">
                            <div role="progressbar" id="barNegociacoesGanhas" style="width: 40%; height: 4px;" aria-valuenow="{#val.value}" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                        </div>
                    </div>
                    <div class="number"><strong id="negociacoesGanhas">0</strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-blue"><i class="fa fa-money"></i></div>
                    <div class="title"><span>Abertas</span>
                        <div class="progress">
                            <div role="progressbar" id="barNegociacoesAtuais" style="width: 50%; height: 4px;" aria-valuenow="{#val.value}" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-blue"></div>
                        </div>
                    </div>
                    <div class="number"><strong id="negociacoesAtuais">0</strong></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Dashboard Header Section    -->
<section class="dashboard-header">
    <div class="container-fluid">
        <div class="row">
            <!-- Statistics -->
            <div class="statistics col-lg-3 col-12">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-red"><i class="fa fa-phone"></i></div>
                    <div class="text"><strong>34</strong><br><small>Ligar</small></div>
                </div>
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-calendar-o"></i></div>
                    <div class="text"><strong>15</strong><br><small>Agendamentos</small></div>
                </div>
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i></div>
                    <div class="text"><strong>2</strong><br><small>Visitas</small></div>
                </div>
            </div>
            <!-- Line Chart            -->
            <div class="chart col-lg-6 col-12">
                <div class="line-chart bg-white d-flex align-items-center justify-content-center has-shadow">
                    <canvas id="lineCahrt"></canvas>
                </div>
            </div>
            <div class="chart col-lg-3 col-12">
                <!-- Bar Chart   -->
                <!--                                    <div class="bar-chart has-shadow bg-white">
                                                        <div class="title"><strong class="text-violet">95%</strong><br><small>Current Server Uptime</small></div>
                                                        <canvas id="barChartHome"></canvas>
                                                    </div>-->
                <!-- Numbers-->
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-danger"><i class="fa fa-line-chart"></i></div>
                    <div class="text"><strong id="porcPerda">39.9%</strong><br><small>Perdas</small></div>
                </div>
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-line-chart"></i></div>
                    <div class="text"><strong id="porcGanho">39.9%</strong><br><small>Ganhos</small></div>
                </div>
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-blue"><i class="fa fa-line-chart"></i></div>
                    <div class="text"><strong id="porcAberta">39.9%</strong><br><small>Abertos</small></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Projects Section-->
<section class="projects no-padding-top">
    <div class="container-fluid">
        <!-- Project-->
        <div class="project">
            <div class="row bg-white has-shadow">
                <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                        <div class="image has-shadow"><img src="assets/img/project-1.jpg" alt="..." class="img-fluid"></div>
                        <div class="text">
                            <h3 class="h4">Ligar</h3><small>Lorem Ipsum Dolor</small>
                        </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down">Hoje as 14:24 PM</span></div>
                </div>
                <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i>12:00 PM </div>
                    <div class="comments"><i class="fa fa-comment-o"></i>20</div>
                    <div class="project-progress">
                        <div class="progress">
                            <div role="progressbar" style="width: 45%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project-->
        <div class="project">
            <div class="row bg-white has-shadow">
                <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                        <div class="image has-shadow"><img src="assets/img/project-2.jpg" alt="..." class="img-fluid"></div>
                        <div class="text">
                            <h3 class="h4">Visita</h3><small>Lorem Ipsum Dolor</small>
                        </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down">Hoje as 14:24 PM</span></div>
                </div>
                <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i>12:00 PM </div>
                    <div class="comments"><i class="fa fa-comment-o"></i>20</div>
                    <div class="project-progress">
                        <div class="progress">
                            <div role="progressbar" style="width: 60%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project-->

        <!-- Project-->

    </div>
</section>
<!-- Client Section-->
<section class="client no-padding-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="work-amount card">
                    
                    <div class="card-body">
                        <h3>Distribuição</h3><small>Lorem ipsum dolor sit amet.</small>
                        <!--<div class=" text-center" >-->
                        <div class="chart text-center">
                            <div class="text"><strong>90</strong><br><span>Total</span></div>
                            <canvas id="pizza"></canvas>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="chart col-lg-6 col-12">
                <div class="line-chart bg-white d-flex align-items-center justify-content-center has-shadow">
                    <canvas id="pizza"></canvas>
                </div>
            </div>-->
        </div>

    </div>
</section>
<!-- Feeds Section-->
<!-- Updates Section                                                -->

<!-- Page Footer-->