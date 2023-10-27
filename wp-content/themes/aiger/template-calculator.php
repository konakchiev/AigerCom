<?php
/*
Template name: Calculator
 */
get_header();

?>



    <section class="about--section faq--section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img src="/wp-content/uploads/2023/02/SmallLogo-1-1.png" alt="">
                    <h2><?php echo the_field('slider_title'); ?></h2>
                    <p>
                        <?php echo the_field('slider_description'); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>


<section class="calc--section">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><?php echo the_field('main_title'); ?></h2>
                <p><?php echo the_field('main_description_1'); ?></p>
                <p>
                    <?php echo the_field('main_description_2'); ?>
                </p>
                <p class="mb-5"><?php echo the_field('main_description_3'); ?>

                </p>
                <div class="fusion-text fusion-text-2">
                    <script type="text/javascript">sc_rates = {
                            "systemlabel": "VoIP enabled broadband",
                            "linescaption": "Number of lines:",
                            "linesmin": 3,
                            "linesmax": 10,
                            "linesinitial": 3,
                            "linesstep": 1,
                            "linesinfo": 0,
                            "lineslabel": "Monthly line rental",
                            "handsetcaption": "Handsets:",
                            "handsetmin": 4,
                            "handsetmax": 20,
                            "handsetinitial": 4,
                            "handsetstep": 1,
                            "handsetinfo": 0,
                            "handsetlabelfree": "Inclusive VoIP desktop featurephones",
                            "handsetlabeladditional": "Additional VoIP desktop featurephones",
                            "minutescaption": "Inclusive minutes:",
                            "minutesmin": 1000,
                            "minutesmax": 6000,
                            "minutesinitial": 1000,
                            "minutesstep": 1000,
                            "minutesinfo": "Slide to select the amount of inclusive UK minutes you require",
                            "minuteslabel": "Inclusive UK minutes",
                            "mobilecaption": "Mobile phone extensions:",
                            "mobilemin": 0,
                            "mobilemax": 10,
                            "mobileinitial": 0,
                            "mobilestep": 1,
                            "mobileinfo": 0,
                            "mobilelabel": "Mobile phone extensions",
                            "installationlabel": "VoIP PBX installation",
                            "maintenancelabel": "Maintenance",
                            "maintenancecost": 1,
                            "maintenanceinfo": 0,
                            "totallabel": "Total monthly cost",
                            "subtotallabel": "Full feature VoIP PBX monthly cost",
                            "networklabel": "Network Services",
                            "directdialmin": false,
                            "directdialmax": false,
                            "directdialinitial": false,
                            "directdialstep": false,
                            "directdialinfo": false,
                            "system-title": false,
                            "minuteslabelfree": false,
                            "minuteslabeladditional": false,
                            "directdiallabel": false,
                            "rates": [{
                                "term": 0,
                                "pbxcost": "0",
                                "pbxinstallation": "0",
                                "lines": "2",
                                "handsets": "4",
                                "mobile": "0",
                                "minutes": "1000",
                                "costs": "",
                                "systemcost": "20",
                                "handsetcost": "10",
                                "mobilecost": "1.5",
                                "minutescost": "0.01",
                                "directdial": "0",
                                "directcost": "1.5"
                            }, {
                                "term": 1,
                                "pbxcost": "0",
                                "pbxinstallation": "10",
                                "lines": "3",
                                "handsets": "4",
                                "mobile": "0",
                                "minutes": "1000",
                                "costs": "",
                                "systemcost": "20",
                                "handsetcost": "10",
                                "mobilecost": "1.5",
                                "minutescost": "0.01",
                                "directdial": "0",
                                "directcost": "1.5"
                            }, {
                                "term": 2,
                                "pbxcost": "0",
                                "pbxinstallation": "0",
                                "lines": "4",
                                "handsets": "6",
                                "mobile": "0",
                                "minutes": "1000",
                                "costs": "",
                                "systemcost": "20",
                                "handsetcost": "10",
                                "mobilecost": "1.5",
                                "minutescost": "0.01",
                                "directdial": "0",
                                "directcost": "1.5"
                            }, {
                                "term": 3,
                                "pbxcost": "0",
                                "pbxinstallation": "0",
                                "lines": "5",
                                "handsets": "7",
                                "mobile": "0",
                                "minutes": "1000",
                                "costs": "",
                                "systemcost": "20",
                                "handsetcost": "10",
                                "mobilecost": "1.5",
                                "minutescost": "0.01",
                                "directdial": "0",
                                "directcost": "1.5"
                            }, {
                                "term": 4,
                                "pbxcost": "0",
                                "pbxinstallation": "0",
                                "lines": "6",
                                "handsets": "8",
                                "mobile": "0",
                                "minutes": "2000",
                                "costs": "",
                                "systemcost": "20",
                                "handsetcost": "10",
                                "mobilecost": "1.5",
                                "minutescost": "0.01",
                                "directdial": "0",
                                "directcost": "1.5"
                            }, {
                                "term": 5,
                                "pbxcost": "0",
                                "pbxinstallation": "0",
                                "lines": "7",
                                "handsets": "9",
                                "mobile": "0",
                                "minutes": "2000",
                                "costs": "",
                                "systemcost": "20",
                                "handsetcost": "10",
                                "mobilecost": "1.5",
                                "minutescost": "0.01",
                                "directdial": "0",
                                "directcost": "1.5"
                            }, {
                                "term": 6,
                                "pbxcost": "0",
                                "pbxinstallation": "0",
                                "lines": "8",
                                "handsets": "10",
                                "mobile": "0",
                                "minutes": "2000",
                                "costs": "",
                                "systemcost": "20",
                                "handsetcost": "10",
                                "mobilecost": "1.5",
                                "minutescost": "0.01",
                                "directdial": "0",
                                "directcost": "1.5"
                            }, {
                                "term": 7,
                                "pbxcost": "0",
                                "pbxinstallation": "0",
                                "lines": "9",
                                "handsets": "11",
                                "mobile": "0",
                                "minutes": "2000",
                                "costs": "",
                                "systemcost": "20",
                                "handsetcost": "10",
                                "mobilecost": "1.5",
                                "minutescost": "0.01",
                                "directdial": "0",
                                "directcost": "1.5"
                            }, {
                                "term": 8,
                                "pbxcost": "0",
                                "pbxinstallation": "0",
                                "lines": "10",
                                "handsets": "12",
                                "mobile": "0",
                                "minutes": "2000",
                                "costs": "",
                                "systemcost": "20",
                                "handsetcost": "10",
                                "mobilecost": "1.5",
                                "minutescost": "0.01",
                                "directdial": "0",
                                "directcost": "1.5"
                            }],
                            "plugin_url": "http:\/\/cluster2.website-staging.uk\/centrex5.com\/wp-content\/plugins\/vocaltel\/"
                        };
                        console.log(sc_rates);</script>
                    <form action="/thank-you" class="qis_form" method="POST" id="qis_form">
                        <div class="qis_sliders">
                            <div class="range qis-slider-lines">
                                <div class="qis_slider_output">
                                    Number of lines: <output>3 </output>
                                    <span class="qis_tooltip_toggle">
                           <a href="javascript:void(0);">?</a>
                           <div class="qis_tooltip_body">
                              <?php echo the_field('lines_question_mark'); ?>
                              <div class="close"></div>
                           </div>
                        </span>
                                </div>
                                <input type="range" class="vocaltel_lines" id="lines" name="lines" min="3" max="10" value="3" step="1" data-qis="" style="position: absolute; width: 1px; height: 1px; overflow: hidden; opacity: 0;">

                                <div class="qis-slideroutput">
                                    <span class="qis-sliderleft">3</span>
                                    <span class="qis-sliderright">10</span>
                                </div>
                            </div>
                            <div class="range qis-slider-handset">
                                <div class="qis_slider_output">
                                    Handsets: <output>4 (4 Free)</output>
                                    <span class="qis_tooltip_toggle">
                           <a href="javascript:void(0);">?</a>
                           <div class="qis_tooltip_body">
                            <?php echo the_field('handsets_question_mark'); ?>
                              <div class="close"></div>
                           </div>
                        </span>
                                </div>
                                <input type="range" class="vocaltel_handset" id="handsets" name="handsets" min="4" max="20" value="4" step="1" data-qis="" free="6" style="position: absolute; width: 1px; height: 1px; overflow: hidden; opacity: 0;">

                                <div class="qis-slideroutput">
                                    <span class="qis-sliderleft">4</span>
                                    <span class="qis-sliderright">20</span>
                                </div>
                            </div>
                            <div class="range qis-slider-minutes">
                                <div class="qis_slider_output">
                                    Inclusive minutes: <output>1000 Free</output>
                                    <span class="qis_tooltip_toggle">
                           <a href="javascript:void(0);">?</a>
                           <div class="qis_tooltip_body">
                              <?php echo the_field('inclusive_minutes_question_mark'); ?>
                              <div class="close"></div>
                           </div>
                        </span>
                                </div>
                                <input type="range" class="volcatel_minutes" id="incminutes" name="minutes" min="1000" max="6000" value="1000" step="1000" data-qis="" free="1000" style="position: absolute; width: 1px; height: 1px; overflow: hidden; opacity: 0;">

                                <div class="qis-slideroutput">
                                    <span class="qis-sliderleft">1000</span>
                                    <span class="qis-sliderright">6000</span>
                                </div>
                            </div>
                        </div>
                        <div class="qis_slider_output" style="color:#40b2df;">
                            <input type="radio" name="maintenanceoption" value="standard" checked="checked"><span style="color:#87bd66;">Standard maintenance</span>&nbsp;&nbsp;&nbsp;<input type="radio" name="maintenanceoption" value="enhanced">Enhanced maintenance
                            <span class="qis_tooltip_toggle">
                     <a href="javascript:void(0);">?</a>
                     <div class="qis_tooltip_body">
                        <?php echo the_field('maintenance_question_mark'); ?>
                        <div class="close"></div>
                     </div>
                  </span>
                        </div>
                        <hr>
                        <div class="qis_outputs">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr class="free qis_pbxcost">
                                    <td>Full feature <span class="qis_lines_total">3</span> lines <span class="qis_handsets_total">4</span> extension VoIP PBX</td>
                                    <td class="align_right number">1</td>
                                    <td id="fullfeature" class="align_right cost">Free</td>
                                </tr>
                                <tr class="free qis_handsets">
                                    <td>Inclusive VoIP desktop feature phones</td>
                                    <td class="align_right number">4</td>
                                    <td id="inclusivevoip" class="align_right cost">Free</td>
                                </tr>
                                <tr class="notfree qis_additional_handsets">
                                    <td>Additional VoIP desktop feature phones</td>
                                    <td class="align_right number">0</td>
                                    <td id="addvoip" class="align_right cost">£0</td>
                                </tr>
                                <tr class="notfree qis_additional_minutes">
                                    <td>Inclusive UK minutes</td>
                                    <td class="align_right number">1000</td>
                                    <td id="inclusive" class="align_right cost">£0</td>
                                </tr>
                                <tr class="free qis_maintenance">
                                    <td>Maintenance</td>
                                    <td class="align_right number"></td>
                                    <td id="maintenance" class="align_right cost">Free</td>
                                </tr>
                                <tr class="notfree qis_lines">
                                    <td>Monthly line rental</td>
                                    <td class="align_right number">3</td>
                                    <td id="monthlyrental" class="align_right cost">£60</td>
                                </tr>
                                <tr class="dark qis_sub_totals">
                                    <td><b>Total monthly cost</b></td>
                                    <td class="align_right number"></td>
                                    <td id="total_month" class="align_right cost">£0</td>
                                </tr>
                                <tr class="dark qis_totals">
                                    <td><b>Total monthly cost</b></td>
                                    <td class="align_right number"></td>
                                    <td id="total_cost" class="align_right cost">£60</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="email_area">
                            <p>Send to your email address:</p>
                            <p><input type="text" class="youremail" id="yourmail" name="youremail" placeholder="e.g. john@mail.com" value=""></p>
                            <input type="hidden" name="anything" value="2023-02-27 07:46:23">
                            <input type="hidden" name="inputmonth" value="" id="inputMonth">
                            <input type="hidden" name="inputtotal" value="" id="inputTotal">
                            <input type="hidden" name="inputmrental" value="" id="inputMRental">
                            <input type="hidden" name="inputmaintenance" value="" id="inputMaintenance">
                            <input type="hidden" name="inputuk" value="" id="inputUK">
                            <input type="hidden" name="inputadd" value="" id="inputAdd">
                            <input type="hidden" name="inputvoip" value="" id="inputvoip">
                            <input type="hidden" name="inputfeature" value="" id="inputfeature">

                            <div class="validator">Enter the word YES in the box: <input type="text" style="width:3em" name="validator" value=""></div>
                            <p><input type="submit" value="Submit" class="button-56" id="sendMail" name="qissubmit"></p>
                            <div id="alert">

                            </div>
                            <div id="alert-danger">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="/wp-content/themes/webix/assets/js/ajax.js"></script>
<?php
get_footer();
?>