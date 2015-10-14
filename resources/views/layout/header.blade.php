<?php
session_start();

$_SESSION["URI"] = $_SERVER["REQUEST_URI"];

//$permissions = getPermissions(null, null, null);
//print_r($permissions);

//do I need util.php?
//include_once("settings.php");
(!isset($dir)) ? $dir = null : $dir = null;
$entityId = (isset($_SESSION["entityId"])) ? $_SESSION['entityId'] : null;
$accessLevel = (isset($_SESSION["accessLevel"])) ? $_SESSION["accessLevel"] : null;
//$entityId = 1;

//$userId = (isset($_SESSION["id"])) ?  $_SESSION['id'] : null;
//for each company add to dropdown in menu

$URL = $_SERVER["PHP_SELF"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SafetyBeat</title>
    <link rel="icon" type="image/png" href="http://dashboard.safetybeat.com.au/img/safetybeat_heart.png">

    <link href="http://dashboard.safetybeat.com.au/include/jquery-ui-1.11.1/jquery-ui.css" rel="stylesheet" type="text/css">
    <!--<link href="css/custom-bootstrap.css" rel="stylesheet" type="text/css">-->
    <link href="http://dashboard.safetybeat.com.au/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="http://dashboard.safetybeat.com.au/css/datepicker3.css" rel="stylesheet" type="text/css">

    <link href="http://dashboard.safetybeat.com.au/css/typeahead.css" rel="stylesheet" type="text/css">

    <link href="http://dashboard.safetybeat.com.au/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet" type="text/css">
    <link href="http://dashboard.safetybeat.com.au/css/plugins/timeline.css" rel="stylesheet" type="text/css">
    <link href="http://dashboard.safetybeat.com.au/css/sb-admin-2.css" rel="stylesheet" type="text/css">
    <link href="http://dashboard.safetybeat.com.au/css/plugins/morris.css" rel="stylesheet" type="text/css">
    <link href="http://dashboard.safetybeat.com.au/css/plugins/jasny-bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="http://dashboard.safetybeat.com.au/css/plugins/jcrop/jquery.Jcrop.css" rel="stylesheet" type="text/css">
    <!--<link href="css/plugins/notifcenter.css" ?>" rel="stylesheet" type="text/css">-->
    <link href="http://dashboard.safetybeat.com.au/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="http://dashboard.safetybeat.com.au/css/mainStyle.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="http://dashboard.safetybeat.com.au/js/jquery-1.11.1.js"></script>
    <script type="text/javascript">
        //don't show content until doc is ready
        $("html").addClass("hidden");
        $(document).ready(function(){
            $("html").removeClass("hidden");
        });

        //put createMapObj here because I reference it out of doc.ready
        /**
         * Creates an empty map obj
         */
        function createMapObj(map)
        {
            var m = (map) ? map : null;
            return {
                map: m,
                markers: Array(),
                overlays: Array(),
                siteMarkers: Array(),
                userMarkers: Array(),
                infoWindow: null,
                userClusters: null,
                siteClusters: null,
                openInfo: null
            };
        }

    </script>
</head>
<body>
<?php //print_r($_SESSION); die;?>
<script type="text/javascript">
    //var id = <?php //echo $_SESSION["id"] ?>;
    var entityId = "<?php echo $entityId ?>";
    var currUrl =  "<?php echo $URL ?>";
    $(document).ready(function(){

        //Add global loading cursor on ajax requests
        $(document).ajaxStart(function(){
            //console.log("Ajax");
            $("html").addClass("busy");
        }).ajaxStop(function(){
            //console.log("stop ajax");
            $("html").removeClass("busy");
        });


        //set the communities dropdown on the navbar
        //when company link is selected ->
        //set the company session to this company
        //Go to their home/dash
        //show the dash/admin links
        populateCommunitiesNav(id, entityId);



        $("li a").removeClass("active");

        //do this properly. Now takes $_SERVER[PHP_SELF]
        //remove the .php?param=blah
        pageName = currUrl.replace(/\/(.*)\.php.*/gi, "$1");
        //find a data-link and set this as active
        $("[data-links*='"+pageName+"']").addClass("active");

        //setupNotificationcenter();


        //$.notificationcenter.alert("hey there", "alert", true, function(notif){ console.log(notif); }, 60*60, true);

    });

</script>
<!--<div class="navbar navbar-custom navbar-fixed-top" role="navigation">-->

<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <!-- FIX THE COLOURS FOR THE MOBILE .SIDEBAR-->
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo "http://dashboard.safetybeat.com.au/dash.php" ?>"><img class="" src="<?php echo "http://dashboard.safetybeat.com.au/img/safetybeat_heart_sm.png" ?>" alt="SafetyBeat">&nbsp;SafetyBeat</a>
            <!--<a class="navbar-brand" href="main.php">SafetyBeat</a>				-->
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li id="tenantDropdown" class="dropdown">
                <!--<a id="selectedLink" href="#" class="dropdown-toggle" data-toggle="dropdown">No Company Selected <span class="caret"></span></a>-->
                <a id="selectedLink" href="http://dashboard.safetybeat.com.au/community/" class="dropdown-toggle" data-toggle=" dropdown">Entity Settings</a>
                <ul class="dropdown-menu" role="menu">
                </ul>
            </li>
            <!--<li id="notificationcentericon"><a href="#"><span class="glyphicon glyphicon-globe"></span>&nbsp;</a></li>-->
            <!--<li><a onclick="logout()">Logout</a></li>-->
        </ul>
        <!--<form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="search">
        </form>-->
        <div class="sidebar navbar-default" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <?php
                        $html = "";
                        $html .= "
                            <li><h4>&nbsp;Dashboard</h4></li>
                            <li><a href='http://dashboard.safetybeat.com.au/dash' data-links='dash,dashboard'><span class='glyphicon glyphicon-dashboard'></span>&nbsp;Dashboard</a></li>
                            <li><a href='http://dashboard.safetybeat.com.au/myTeam/' data-links='myTeam'><span class='glyphicon glyphicon-tower'></span>&nbsp;My Team</a></li>
                            <li><a href='http://dashboard.safetybeat.com.au/map/' data-links='map'><span class='glyphicon glyphicon-map-marker'></span>&nbsp;Map</a></li>
                            <li><a href='http://dashboard.safetybeat.com.au/checkin-reports/' data-links='activityTable'><i class='fa fa-bar-chart'></i>&nbsp;Check In Reports</a></li>
                        ";
                        //	}
                        //	if($dir == "admin")
                        //	if($entityId != null)
                        //	{
                        $html .= "
                        <li><h4>&nbsp;Admin</h4></li>
                        <li><a href='http://dashboard.safetybeat.com.au/users/' data-links='userControl,userView,userEdit'><span class=' glyphicon glyphicon-list-alt'></span>&nbsp;Member Center</a></li>
                        <li><a href='http://dashboard.safetybeat.com.au/sites/' data-links='siteControl,siteView,siteEdit'><span class='glyphicon glyphicon-home'></span>&nbsp;Site Center</a></li>
                        <li><a href='http://dashboard.safetybeat.com.au/questions/' data-links='questionControl,questions'><span class='glyphicon glyphicon-check'></span>&nbsp;Question Center</a></li>
                        <li><a href='http://dashboard.safetybeat.com.au/permissions/' data-links='permissionsControl,groupMembers,groupPermissions'><span class='glyphicon glyphicon-eye-open'></span>&nbsp;Permissions Center</a></li>
                        ";

                        //	}

                        $html .="
                                <li><h4>&nbsp;Special</h4></li>
                                <li><a href='http://dashboard.safetybeat.com.au/pronto/' data-links='prontoData'><i class='fa fa-pie-chart fa-fw'></i>&nbsp;Pronto</a></li>
                            ";


                        $html .="
                                <li><h4>&nbsp;Reports</h4></li>
                                <li><a href='/action/' data-links='prontoData'><i class='fa fa-pie-chart fa-fw'></i>&nbsp;Action</a></li>
                            ";




                        $html .= "
                <li><h4>&nbsp;Settings</h4></li>
                <li><a href='http://dashboard.safetybeat.com.au/entity/' data-links='communityControl'><span class='glyphicon glyphicon-globe'></span>&nbsp;Entity Control</a></li>
                <li><a href='http://dashboard.safetybeat.com.au/profile/' data-links='profile'><span class='glyphicon glyphicon-user'></span>&nbsp;Profile</a></li>
                <li><a href='http://dashboard.safetybeat.com.au/help/' data-links='help'><span class='glyphicon glyphicon-book'></span>&nbsp;Help</a></li>
                <li><a href='http://dashboard.safetybeat.com.au/contact/' data-links='contact'><span class='glyphicon glyphicon-earphone'></span>&nbsp;Contact</a></li>
                <li><a href='mailto:developer@safetybeat.com' data-uv-trigger id='feedback'><span class='glyphicon glyphicon-envelope'></span>&nbsp;Feedback</a></li>
                <li>&nbsp;</li>
                <li><a href='#' onclick='logout();'><span class='glyphicon glyphicon-off'></span>&nbsp;Logout</a></li>
            ";
                        echo $html;
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div id="page-wrapper">