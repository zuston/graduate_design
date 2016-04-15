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

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $user_id?>的图书借阅</title>

    <!-- Bootstrap Core CSS -->
    <link href="view/static/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="view/static/css/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="view/static/css/dataTables.bootstrap.css" rel="stylesheet">


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
            <a class="navbar-brand" href="/">登录用户<<?php echo  $user_id;?>></a>
        </div>
        <!-- /.navbar-header -->


        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="搜索书籍">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
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
            <div class="col-sm-6 col-md-2">
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" class="thumbnail">
                            <img src="view/static/pic/kittens.jpg"
                                 alt="通用的占位符缩略图">
                        </a>
                    </div>
                    <div class="col-md-12">
                        <span style="margin-left: 10px;">我爱着我的世界</span>
                    </div>
                    <div class="col-md-8">
                        <a>作者:</a><span>zuston</span>
                    </div>
                    <div class="col-md-4"><a>借阅</a></div>
                </div>
            </div>
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

<!-- Custom Theme JavaScript -->
<script src="view/static/js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>

</body>

</html>
