@extends('layout.app')

@section('title')
    About AquApp
@endsection

@section('styles')
    <style>
        /*https://www.bootply.com/533U4Zo7Uq*/
        #scrollspy{
            margin-top: 50px;
        }
        /* hide sidebar sub menus by default */
        #sidebar.nav .nav {
            display: none;
            font-size:12px;
        }

        /* show sub menu when parent is active */
        #sidebar.nav>.active>ul {
            display: block;
        }

        /*.navbar-bright a, #masthead a, #masthead .lead {*/
            /*color:#aaaacc;*/
        /*}*/

        .navbar-bright li > a:hover {
            background-color:#000033;
        }

        .affix-top,.affix{
            position: static;
        }

        @media (min-width: 979px) {
            #sidebar.affix-top {
                position: static;
                margin-top:30px;
                width:228px;
            }

            #sidebar.affix {
                position: fixed;
                top:70px;
                width:228px;
            }
        }

        #sidebar li.active {
            border:0 #007EE5 solid;
            border-right-width:3px;
        }

        @media (max-width: 767px) {
            #leftCol{
                margin-bottom: 50px;
            }
        }

        .nav-stacked{
            /*text-align: center;*/
        }

        .nav-stacked>li>a{
            font-weight:bold;
        }

        .subsection a{
            font-size: 128%;
            color: #2e3436;
            font-weight: lighter;
        }

        .section-divisor{
            height: 6px;
            background: url(http://ibrahimjabbari.com/english/images/hr-11.png) repeat-x 0 0;
            border: 0;
            margin: 30px 0;
        }

        h3{
            margin-bottom: 0;
        }

        h2{
            /*margin-bottom: 10px;*/
        }

        .fa{
            color: #007EE5;
        }

        p{
            text-align: justify;
        }

    </style>
@endsection

@section('content')
    <div class="container" id="scrollspy">
        <div class="row">
            <div class="col-md-3" id="leftCol">
                <ul class="nav nav-stacked" id="sidebar">
                    <li>
                        <a href="#aquapp">Aquapp 2.0</a>
                        <ul class="nav">
                            <li class="subsection"><a href="#">Project</a></li>
                            <li class="subsection"><a href="#">Features</a></li>
                            <li class="subsection"><a href="#">How it works?</a></li>
                            <li class="subsection"><a href="#">Web Technologies</a></li>
                        </ul>
                    </li>
                    <li><a href="#faqs">FAQs</a></li>
                    <li><a href="#team">Team</a></li>
                    <li><a href="#terms">Terms & Conditions</a></li>
                    <li><a href="#contact">Contact</a></li>
                    {{--<li><a href="#sec4">API v1.0</a></li>--}}
                </ul>
            </div>

            <div class="container">
                <div class="col-md-9">
                    <h1 id="aquapp">Aquapp 2.0</h1>
                    <h2>Project</h2>
                    <p>
                        At Bootply we like to build simple Bootstrap templates that utilize the code Bootstap CSS without a lot of customization. Sure you can
                        find a lot of Bootstrap themes and inspiration, but these templates tend to be heavy on customization.
                    </p>

                    <h2>Features</h2>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <h3>
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-calendar-check-o"></i>
                            </span>
                                Real Data
                            </h3>
                            <p>
                                {{--Los datos disponibles en la plataforma son recolectados por estudiantes de pregrado de la UTB a través de una sonda multi-parámetrica. Los--}}
                                {{--monitoreos son realizados una vez por semana, y se espera realizar la recolección de datos remotamente en una segunda etapa del proyecto.--}}
                                Data is collected by UTB undergraduate students through a multi-parameter probe. Monitoring is performed once a week, and data collection is
                                expected to be remotely in a second stage of the project.
                            </p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <h3>
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-filter"></i>
                            </span>
                                Filtering
                            </h3>
                            <p>
                                Available data can be filtered by picking a station type, date range, station, and parameter using the form on the left side of the screen.
                            </p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <h3>
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-download"></i>
                            </span>
                                Download
                            </h3>
                            <p>
                                After filtering data and getting exactly what you need, it can be downloaded as a Comma Separated Values (CSV) file, or get a representation
                                as a graph which you can download in different file formats as well.
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <h3>
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-clock-o"></i>
                            </span>
                                Availble
                            </h3>
                            <p>
                                {{--A diferencia de otras instituciones con planes de monitoreo sobre cuerpos de agua del sistema lagunar de Cartagena y que restringen el acceso--}}
                                {{--a los datos tomados, Aquapp brinda información disponible para toda la comunidad.--}}
                                Unlike other institutions with monitoring plans on water bodies of the internal creeks and lakes system of Cartagena that restrict access to the data taken,
                                Aquapp provides information available for the entire community.

                            </p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <h3>
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-paint-brush"></i>
                            </span>
                                Cool
                            </h3>
                            <p>
                                To guarantee a great experience, we developed a well-built website up-to-date, with worthwhile content and an improved user interface
                                good navigation for quick and easy travel throughout the entire website.

                            </p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <h3>
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-desktop"></i>
                            </span>
                                Cross Browser
                            </h3>
                            <p>
                                We built this compatible with all modern browsers. You are allow to use it in Chrome, Firefox, Safari and Opera, feel free to prove it yourself.
                            </p>
                        </div>
                    </div>

                    <h2>How it works?</h2>

                    {{--Available formats are a graph or a Comma Separated Values (CSV) file that can be viewed in Excel or any other spreadsheet program.--}}
                    {{--After selecting a data type, date range, station, and parameter, click the circle next to the word “Graph”, then click the blue "Get Data" button.--}}
                    {{--A few moments later a graph will appear in a pop up window--}}

                    {{--StordeAllow data filtering mechanism according to PM and parameter to be measured in a given time range--}}

                    {{--Use the form on the left side of the screen to select a date range. The stations will automatically filter on the map and under the--}}
                    {{--Step #3 station drop down box to reflect only stations with available data.--}}

                    {{--Now you can determine the data availability of a station and the basics of how to filter stations by date. Return to the menu to learn more.--}}
                    {{----> After--}}
                    {{--of a station and the basics of how to filter stations by date.--}}
                    <p>
                        At Bootply we like to build simple Bootstrap templates that utilize the code Bootstap CSS without a lot of customization. Sure you can
                        find a lot of Bootstrap themes and inspiration, but these templates tend to be heavy on customization.
                    </p>

                    <h2>Web Technologies</h2>
                    <p>Developed with the best Web Design Technologies</p>
                    <div class="row">
                        <div class="col-xs-2"><img class="img-responsive" data-toggle="tooltip" data-placement="bottom" title="HTML5" src="/images/web-technologies/html5.png" width="60"></div>
                        <div class="col-xs-2"><img class="img-responsive" data-toggle="tooltip" data-placement="bottom" title="CSS3" src="/images/web-technologies/css3.png" width="60"></div>
                        <div class="col-xs-2"><img class="img-responsive" data-toggle="tooltip" data-placement="bottom" title="JavaScript" src="/images/web-technologies/js.png" width="57"></div>
                        <div class="col-xs-2"><img class="img-responsive" data-toggle="tooltip" data-placement="bottom" title="Jquery" src="/images/web-technologies/jquery.png" width="60"></div>
                        <div class="col-xs-2"><img class="img-responsive" data-toggle="tooltip" data-placement="bottom" title="Bootstrap 3" src="/images/web-technologies/bootstrap.png" width="70"></div>
                        <div class="col-xs-2"><img class="img-responsive" data-toggle="tooltip" data-placement="bottom" title="Laravel" src="/images/web-technologies/laravel.png" width="65"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-2"><img class="img-responsive" data-toggle="tooltip" data-placement="bottom" title="Highcharts" src="/images/web-technologies/highcharts.png" width="60"></div>
                        <div class="col-xs-3"><img class="img-responsive" data-toggle="tooltip" data-placement="bottom" title="Leafletjs" src="/images/web-technologies/leafletjs.png" width="160" style="margin-top: 14px"></div>
                        <div class="col-xs-2"><img class="img-responsive" data-toggle="tooltip" data-placement="bottom" title="Git" src="/images/web-technologies/git.png" width="90" style="margin-top: 18px"></div>
                    </div>

                    <hr class="section-divisor">

                    <h1 id="faqs">FAQs</h1>
                    <p>
                        Rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
                        dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut.
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3>Hello.</h3></div>
                                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.
                                    Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis
                                    dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan.
                                    Aliquam in felis sit amet augue.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3>Hello.</h3></div>
                                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.
                                    Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis
                                    dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan.
                                    Aliquam in felis sit amet augue.
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="section-divisor">

                    <h1 id="team">Team</h1>
                    <p>
                        Rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
                        dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia cor magni dolores
                        eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                        sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
                        Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut!
                    </p>
                    <div class="row">
                        <div class="col-md-4"><img src="//placehold.it/300x300" class="img-responsive"></div>
                        <div class="col-md-4"><img src="//placehold.it/300x300" class="img-responsive"></div>
                        <div class="col-md-4"><img src="//placehold.it/300x300" class="img-responsive"></div>
                    </div>

                    <hr class="section-divisor">

                    <h1 id="terms">Terms & Conditions</h1>
                    <p>
                        Images are responsive sed @mdo but sum are more fun peratis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                        totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
                        dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia cor magni dolores
                        eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                        sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
                        Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut
                    </p>

                    <hr class="section-divisor">

                    <h1 id="contact">Contact</h1>
                    <p>
                        Rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
                        dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia cor magni dolores
                        eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                        sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
                        Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut!
                    </p>
                    <div class="row">
                        <div class="col-md-4"><img src="//placehold.it/300x300" class="img-responsive"></div>
                        <div class="col-md-4"><img src="//placehold.it/300x300" class="img-responsive"></div>
                        <div class="col-md-4"><img src="//placehold.it/300x300" class="img-responsive"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            // Scrollspy
            $('#sidebar').affix({
                offset: {
                    top: 245
                }
            });

            var $body   = $(document.body);
            var navHeight = $('.navbar').outerHeight(true) + 10;

            $body.scrollspy({
                target: '#leftCol',
                offset: navHeight
            });

            // Tooltip
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection