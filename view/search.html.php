<?php
/**
 * Created by PhpStorm.
 * User: zuston
 * Date: 16/4/15
 * Time: 上午12:21
 */
$user_academy_map = array(
    0 => '',
    1 => '计算机',
    2 => '外国语',
    3 => '文',
    4 => '法政',
    5 => '科文',
    6 => '历史旅游',
    7 => '教育',
    8 => '美术',
    9 => '城环',
    10 => '音乐',
);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo '';?>的图书借阅</title>

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
            <a class="navbar-brand" href="/">登录用户<<?php echo  '';?>></a>
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
                <h1 class="page-header">搜索页面</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    关键字:
                </div>
                <!-- /.panel-heading -->
                <div class="col-md-12">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>书号</th>
                                    <th>书名</th>
                                    <th>作者</th>
                                    <th>图书馆存量</th>
                                    <th>可借数</th>
                                    <th>推荐指数</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="success">
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr class="danger">
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr class="success">
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr class="success">
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <ul class="pagination" style="float: right;">
                                <li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="#">Previous</a></li>
                                <li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="#">1</a></li>
                                <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">2</a></li>
                                <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">3</a></li>
                                <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">4</a></li>
                                <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">5</a></li>
                                <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">6</a></li>
                                <li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="#">Next</a></li>
                            </ul>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                <!-- /.panel-body -->
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
