<?php
/**
 * Created by PhpStorm.
 * User: zuston
 * Date: 16/4/15
 * Time: 上午12:21
 */
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content='text/html'; charset='utf-8' />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>[<?php echo $userModel->user_name;?>]图书借阅</title>

    <!-- Bootstrap Core CSS -->
    <link href="view/static/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="view/static/css/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="view/static/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="view/static/css/fakeLoader.css" rel="stylesheet">
    <link href="view/static/css/pace-theme-minimal.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="view/static/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="view/static/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">登录用户<<?php echo  $userModel->user_name;?>></a>
        </div>
        <!-- /.navbar-header -->


        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="搜索书籍" id='searchInput'>
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li id='notify_li'><a>提示信息</a></li>
                    <li>
                        <a href="/hotbook"><i class="fa fa-dashboard fa-fw"></i>热门书籍</a>
                    </li>
                    <li>
                        <a href="/returnbook"><i class="fa fa-table fa-fw"></i>还书统计</a>
                    </li>
                    <li>
                        <a href="/rankbook"><i class="fa fa-table fa-fw"></i>借阅排行榜</a>
                    </li>
                    <li>
                        <a href="/main"><i class="fa fa-bar-chart-o fa-fw"></i>个人首页<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/userbookcount">个人借阅统计</a>
                            </li>
                            <li>
                                <a href="/main">个人信息设置</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">热门书籍推荐</h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <?php foreach($hotbookModels as $hotbookModel){ ?>
            <div class="col-sm-6 col-md-2">
                <div class="row" style="border:0px solid white;margin-bottom: 15px">
                    <div id='fakeLoder' class="col-md-7" style="border: 0px solid black">
                        <img src="https://img1.doubanio.com/lpic/s10<?php echo rand(10000,99999);?>.jpg" class="img-rounded" alt="Cinque Terre" width="112" height="147">
                    </div>
                    <div class="col-md-5" style="border: 0px solid black;margin-left:0px;">
                        <h5><a class="text-info"><?php echo $hotbookModel->belong_to->book_name;?></a></h5>
                        <h6><small>作者:</small><a class="text-success"><?php echo $hotbookModel->belong_to->book_author;?></a></h6>
                        <h6><small>心理/学术/数学</small></h6>
                    </div>



<!--                    <div class="col-md-8" style="border:0px solid white;height: 25px;margin-top:-5px;">-->
<!--                        <p class="text-danger" style="margin-left: 10px;">作者:</p><span>--><?php //echo $hotbookModel->belong_to->book_author;?><!--</span>-->
<!--                    </div>-->
<!--                    <div class="col-md-4" style="margin-top: -5px;">-->
<!--                        <button type="button" class="btn --><?php //$flag=rand(0,1);echo $flag?'btn-success':'btn-info';?><!-- btn-xs" style="float: right;">--><?php //echo $flag?'有存量':'无剩余';?><!--</button>-->
<!--                    </div>-->
                </div>
            </div>
            <?php }?>
        </div>
    </div>

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="view/static/js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="view/static/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="view/static/js/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="view/static/js/jquery.dataTables.min.js"></script>
<script src="view/static/js/dataTables.bootstrap.min.js"></script>
<script src="view/static/js/dataTables.responsive.js"></script>
<script src="view/static/js/fakeLoader.min.js"></script>
<script src="view/static/js/pace.min.js"></script>


<!-- Custom Theme JavaScript -->
<script src="view/static/js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
        $('#searchInput').keyup(function(){
            var value = $('#searchInput').val();
            
        });
        $('#notify_li').hide();
    });
</script>

</body>

</html>
