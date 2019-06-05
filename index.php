<html>
        <!-- import style.css -->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <!-- import bootstrap.css -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <!-- import index.css -->
        <link rel="stylesheet" href="css/index.css">
        <!-- import jquery.js -->
        <script type="text/javascript" src="javascript/jquery.min.js"></script>
        <!-- import global.js -->
        <script src="javascript/global.js">
</script>


        <head>
            <title>Mental Health Care Center</title>
            <link rel="shortcut icon" href="images/Logo.jpg" />
        </head>

        <body>
            <!-- navbar(bootstrap 4) -->
            <?php
				include 'NavgationBar.php';
			?>
            <!-- popup dim background -->
            <div class="dim d-none"></div>
            <!-- end of nav bar -->
            <!-- banner section -->
            <section id="main_page">
                <section class="banner">
                    <div class="container">
                        <div class="row banner_center">
                            <div id="main_banner" class="row">
                                <!-- left content -->
                                <div id="banner_content" class="col-6 p-3">
                                    <h2>Mental Health Care Center</h2>
                                    <p class="px-5"><h4>Elderly depression</h4>
                                                Depression is one of the
                                                commonest psychiatric disorders
                                                in old age and yet it is
                                                frequently underdetected and
                                                under-treated. The fact that
                                                loss is common in this
                                                particular stage of lift often
                                                leads to the notion that the
                                                presence of depressive symptoms
                                                is somehow understandable and
                                                “normal” in old age. This often
                                                results in delay in treatment.
                                                Depression in elderly people is
                                                a highly treatable illness and
                                                its prognosis is at least as
                                                good as depression presenting in
                                                younger age groups. If you
                                                notice that the unhappy feelings
                                                last longer than a week or two,
                                                and they start to interfere with
                                                your lives, you need to be
                                                careful and to seek help as soon
                                                as possible.
                                            </p>
                                            <a href="QandA.php" class="btn blue button">Learn More</a>
                                        </div>
                                        <!-- right from -->
                                        <div class="col-6 p-5">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Result div of success login-->
                            <div id="boxs" class="divbox">
                                <h1>Login success!</h1>
                                <p class="close" id="link"><a
                                        href="userpage.html">Go</a></p>
                            </div>
                            <!--Result div of fail login-->
                            <div id="boxf" class="divbox">
                                <h1>Login Failed!</h1>
                                <input type="button" value="Retry" class="close"
                                    onclick="retry()">
                            </div>
                            <!--Result div of fail login-->
                            <div id="boxm" class="divbox">
                                <h1 id="message"></h1>
                                <input type="button" value="Retry" class="close"
                                    onclick="retry()">
                            </div>
                        </section>

                    </section>
                    <footer class="nav-down py-3">
                        Copyright © 2019 Polyu SPEED IW 2019 Group D. All rights
                        reserved.
                    </footer>
                </body>

            </html>