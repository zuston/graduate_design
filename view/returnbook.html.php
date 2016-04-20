<?php
/**
 * Created by PhpStorm.
 * User: zuston
 * Date: 16/4/15
 * Time: 上午12:21
 */
$totalMoney = 0;
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $userModel->user_name;?>的图书借阅</title>

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
            <a class="navbar-brand" href="/">登录用户<<?php echo  $userModel->user_name;?>></a>
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
                <h1 class="page-header">还书统计</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        已到期未还
                    </div>
                    <div class="panel-body">

                            <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>书号</th>
                                            <th>书名</th>
                                            <th>借书日</th>
                                            <th>应还日期</th>
                                            <th>应补金额</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($unreturnModels as $unreturnModel){?>
                                        <tr>
                                            <td><?php echo $unreturnModel->belong_to->book_code;?></td>
                                            <td><?php echo $unreturnModel->belong_to->book_name;?></td>
                                            <td><?php echo $unreturnModel->ubr_create_at;?></td>
                                            <td><?php echo $unreturnModel->ubr_due_at;?></td>
                                            <td><?php $time = strtotime(date('Y-m-d 00:00:00'))-strtotime($unreturnModel->ubr_due_at);
                                                $count = $time/86400;
                                                $money = 0.20;
                                                $totalMoney += $money*$count;
                                                echo $money*$count;
                                                ?></td>
                                        </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>

                    </div>
                    <div class="panel-footer">
                        总计未还<a class="text-danger"><?php echo count($unreturnModels);?></a>本,应补交<a class="text-danger"><?php echo $totalMoney;?></a>元
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        借阅中
                    </div>
                    <div class="panel-body">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>书号</th>
                                <th>书名</th>
                                <th>借书日</th>
                                <th>应还日期</th>
                                <th>续借</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($rendingModels as $rendingModel){?>
                                <tr>
                                    <td><?php echo $rendingModel->belong_to->book_code;?></td>
                                    <td><?php echo $rendingModel->belong_to->book_name;?></td>
                                    <td><?php echo $rendingModel->ubr_create_at;?></td>
                                    <td><?php echo $rendingModel->ubr_due_at;?></td>
                                    <td>
                                        <?php if($rendingModel->ubr_absorted==1){?>
                                        <button class="btn btn-outline btn-success btn-xs" type="button" data-toggle="modal" data-target="#myModal">续借登记</button>
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">延期申请</h4>
                                                        </div>
                                                        <?php $flag = ((strtotime($rendingModel->ubr_due_at)-strtotime('now')-3*86400)<0)?true:false;if($flag){?>
                                                            <div class="modal-body">
                                                                <p>借于:</p><p class="text-info"><?php echo $rendingModel->ubr_create_at;?></p>
                                                                <p>应还于:</p><p class="text-info"><?php echo $rendingModel->ubr_due_at;?></p>
                                                                <p>
                                                                    <label>延长借阅时间:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                                                    <label class="radio-inline">
                                                                        <input type="radio" name="optionsRadiosInline" id="<?php echo $rendingModel->ubr_id;?>" value="1" checked>一周
                                                                    </label>
                                                                    <label class="radio-inline">
                                                                        <input type="radio" name="optionsRadiosInline" id="<?php echo $rendingModel->ubr_id;?>" value="2">二周
                                                                    </label>
                                                                    <label class="radio-inline">
                                                                        <input type="radio" name="optionsRadiosInline" id="<?php echo $rendingModel->ubr_id;?>" value="3">一个月
                                                                    </label>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary" id="addReturnTime">申请提交</button>
                                                            </div>
                                                        <?php }else{?>
                                                            <div class="modal-body">
                                                                <p>请在到期前三天进行延期申请</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        <?php }?>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        <?php }?>
                                        <?php if($rendingModel->ubr_absorted!=1){?>
                                            <button class="btn btn-outline btn-danger btn-xs" type="button" disabled>续借过<?php echo ($rendingModel->ubr_absorted-1);?>次</button>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php }?>


                            </tbody>
                        </table>

                    </div>
                    <div class="panel-footer">
                        总计借阅中<a class="text-danger"><?php echo count($rendingModels);?></a>本
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        借阅过
                    </div>
                    <div class="panel-body">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>书号</th>
                                <th>书名</th>
                                <th>借书日</th>
                                <th>应还日期</th>
                                <th>是否逾期</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($rentModels as $rentModel){?>
                                <tr>
                                    <td><?php echo $rentModel->belong_to->book_code;?></td>
                                    <td><?php echo $rentModel->belong_to->book_name;?></td>
                                    <td><?php echo $rentModel->ubr_create_at;?></td>
                                    <td><?php echo $rentModel->ubr_due_at;?></td>
                                    <td><span class="glyphicon glyphicon-<?php echo (strtotime($rentModel->ubr_create_at)%2)?'move':'ok';?>"></span></td>
                                </tr>
                            <?php }?>

                            </tbody>
                        </table>

                    </div>
                    <div class="panel-footer">
                        总计未还<a class="text-danger"><?php echo count($rentModels);?></a>本
                    </div>
                </div>
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

        $('#addReturnTime').click(function(){
            var time = $('input:radio[name="optionsRadiosInline"]:checked').val();
            var ubr_id = $('input:radio[name="optionsRadiosInline"]:checked').attr('id');
            $.post("/modify/updateReturnBook", {time:time,ubr_id:ubr_id},
                function(data){
                    alert(data);
                });
        });
    });
</script>

</body>

</html>
