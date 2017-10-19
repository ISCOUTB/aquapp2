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
            margin-bottom: 6px;
        }

        .fa{
            color: #007EE5;
        }

        p{
            text-align: justify;
        }
        .margin-0{
            margin-bottom: 0;
        }

    </style>
@endsection

@section('content')
    <div class="container" id="scrollspy">
        <div class="row">
            <div class="col-md-3" id="leftCol">
                <ul class="nav nav-stacked" id="sidebar">
                    <li>
                        <a href="#aquapp">AquApp 2.0</a>
                        <ul class="nav">
                            <li class="subsection"><a href="#">@lang('Project')</a></li>
                            <li class="subsection"><a href="#">@lang('Features')</a></li>
                            <li class="subsection"><a href="#">@lang('How it works?')</a></li>
                            <li class="subsection"><a href="#">@lang('Web Technologies')</a></li>
                        </ul>
                    </li>
                    <li><a href="#faqs">@lang('FAQs')</a></li>
                    <li><a href="#team">@lang('Team')</a></li>
                    <li><a href="#terms">@lang('Terms & Conditions')</a></li>
                    <li><a href="#contact">@lang('Contact')</a></li>
                    {{--<li><a href="#sec4">API v1.0</a></li>--}}
                </ul>
            </div>

            <div class="container">
                <div class="col-md-9">
                    <h1 id="aquapp">AquApp 2.0</h1>
                    <h2>@lang('Project')</h2>
                    <p>
                        At Bootply we like to build simple Bootstrap templates that utilize the code Bootstap CSS without a lot of customization. Sure you can
                        find a lot of Bootstrap themes and inspiration, but these templates tend to be heavy on customization.
                    </p>

                    <h2>@lang('Features')</h2>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <h3>
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-calendar-check-o"></i>
                            </span>
                                @lang('Real Data')
                            </h3>
                            <p>
                                @lang('Data is collected by UTB undergraduate students through a multi-parameter probe. Monitoring is performed once a week, and data collection is expected to be remotely in a second stage of the project')
                            </p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <h3>
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-filter"></i>
                            </span>
                                @lang('Filtering')
                            </h3>
                            <p>
                                @lang('Available data can be filtered by picking a station type, date range, station, and parameter using the form on the left side of the screen')
                            </p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <h3>
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-download"></i>
                            </span>
                                @lang('Download')
                            </h3>
                            <p>
                                @lang('After filtering data, it can be downloaded as a Comma Separated Values (CSV) file, or get a representation as a graph which you can download in different file formats as well')
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <h3>
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-clock-o"></i>
                            </span>
                                @lang('No restriction')
                            </h3>
                            <p>
                                @lang('Unlike other institutions with monitoring plans on water bodies of the internal creeks and lakes system of Cartagena that restrict access to the data taken, Aquapp provides information available for the entire community')
                            </p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <h3>
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-paint-brush"></i>
                            </span>
                                @lang('Cool')
                            </h3>
                            <p>
                                @lang('To guarantee a great experience, we developed a well-built website up-to-date, with worthwhile content and an improved user interface with good navigation for quick and easy travel throughout the entire website')
                            </p>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <h3>
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-desktop"></i>
                            </span>
                                @lang('Cross Browser')
                            </h3>
                            <p>
                                @lang('We built this compatible with all modern browsers. You are allow to use it in Chrome, Firefox, Safari and Opera, feel free to prove it yourself')
                            </p>
                        </div>
                    </div>

                    <h2>@lang('How it works?')</h2>

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

                    <h2>@lang('Web Technologies')</h2>
                    <p>@lang('Developed with the best Web Design Technologies')</p>
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

                    <h1 id="faqs">@lang('FAQs')</h1>
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

                    <h1 id="team">@lang('Team')</h1>
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

                    <h1 id="terms">@lang('Terms & Conditions')</h1>
                    <h3>@lang('Information')</h3>

                    <p>
                        @lang('AquApp 2.0 is a platform supporting a program for monitoring water quality of Cartagena de Indias internal creeks and lakes system.')
                        Copyright © 2017 - @lang('All rights reserved'). <a target="_blank" href="http://www.unitecnologica.edu.co/">Universidad Tecnológica de Bolívar</a>
                    </p>

                    <p>
                        @lang('This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.')
                    </p>

                    <p>
                        @lang('This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.')
                    </p>

                    <p>
                        @lang('You should have received a copy of the GNU Affero General Public License along with this program.  If not, see') <a href="http://www.gnu.org/licenses/">http://www.gnu.org/licenses</a>
                    </p>

                    <h3>@lang('License') </h3>
                    <h4 class="margin-0">GNU AFFERO GENERAL PUBLIC LICENSE</h4>
                    <p class="margin-0">@lang('Version 3, 19 November 2007')</p>
                    <p>
                        Copyright © 2007 Free Software Foundation, Inc. <a href="http://fsf.org/">http://fsf.org/</a>
                        @lang('Everyone is permitted to copy and distribute verbatim copies of this license document, but changing it is not allowed.')
                    </p>

                    <h4>@lang('Preamble')</h4>
                    <p>
                        @lang('The GNU Affero General Public License is a free, copyleft license for software and other kinds of works, specifically designed to ensure cooperation with community in the case of network server software.')
                    </p>

                    <p>
                        @lang('The licenses for most software and other practical works are designed to take away your freedom to share and change the works. By contrast, our General Public Licenses are intended to guarantee your freedom to share and change all versions of a program--to make sure it remains free software for all its users.')
                    </p>

                    <p>
                        <strong><a class="pull-right" href="http://www.gnu.org/licenses/agpl-3.0.en.html" target="_blank">... @lang('Read more here')</a></strong>
                    </p>
                    <br>

                    <hr class="section-divisor">

                    <h1 id="contact">@lang('Contact')</h1>
                    <p>@lang('You are free to drop us some lines by adding a comment on our project Wiki. Besides, esta wiki (on GitHub) will help you get in-depth information the project.')</p>
                    <strong><a href="https://github.com/IngenieriaDeSistemasUTB/aquapp2/wiki/_new" target="_blank">@lang('Join the conversation')</a></strong>

                    <hr class="section-divisor">
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