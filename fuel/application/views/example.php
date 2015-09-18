<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Leadership</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link href="" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo $base_url?>assets/Qassets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $base_url?>assets/Qassets/bootstrap-table/src/bootstrap-table.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="<?php echo $base_url?>assets/Qassets/bootstrap-table/src/bootstrap-table.js"></script>
        
        <style type="text/css">
          ul::-webkit-scrollbar-track{background-color:#f2f2f2;}
          ul::-webkit-scrollbar-track-piece{background-color:#f2f2f2;}
          .row{margin-right: 0;}
          .tooltip-inner {
              max-width: 350px;
              /* If max-width does not work, try using width instead */
              width: 250px; 
              text-align:left;
              padding: 8px 15px;
          }
          .accordion{margin-bottom:20px;}
          .accordion-group{margin-bottom:2px;border:1px solid #e5e5e5;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;}
          .accordion-heading{border-bottom:0;}
          .accordion-heading .accordion-toggle{display:block;padding:8px 15px;}
          .accordion-toggle{cursor:pointer;}
          .accordion-inner{padding:9px 15px;border-top:1px solid #e5e5e5;}
          .menu .accordion-heading {  position: relative; }
          .menu .accordion-heading .edit {
              position: absolute;
              top: 8px;
              right: 30px; 
          }
          .menu .area { border-left: 4px solid #f38787; }
          .menu .equipamento { border-left: 4px solid #65c465; }
          .menu .ponto { border-left: 4px solid #98b3fa; }
          .menu .collapse.in { overflow: visible; }

          .navbar-nav > li.active{border-bottom: 4px solid #3b7bea;}
          .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {color: #3b7bea;}
          p.UserInfo{
            margin: 0; 
            padding: 10px;
            color: #7F7777;
          }
          p.UserInfoBtn{
            background-color: #eee;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-right: 10px;
            padding-left: 10px; 
            margin: 0;
            border-top: 1px solid #ccc;
            text-align: right;
          }
          .navbar-brand{
            padding: 0px;
            padding-right: 5px;
            padding-top: 3px;
          }
          .navbar-brand img{
            width: 208px;
          }
          .navLeft{
            background-color: #f2f2f2!important;
            position: fixed;
            top: 55px;
            left: 0px;
            border-right: 2px solid #e5e5e5;
            padding-top: 25px;
            z-index: 9999999;
          }
          .navLeft > ul > li{
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
            cursor: pointer;
            color: #6F6F6F;
          }
          .navLeft > ul > li.active{
            border-left: 4px solid #3b7bea;
            background-color: #e5e5e5;
            border-top: 0 solid #ebebeb;
            border-bottom: 2px solid #C8C8C8;
            color: #343434;
          }
          .col-xs-2{padding: 5px;}
          .col-xs-10{
            padding-right: 5px;
            padding-left: 10px;
          }
          .navLeft > ul > li.second{            
            border-bottom: 1px solid #DADADA;
          }
         

          .navLeft > ul > li.second > ul > li > ul > li:hover{
            background-color: #E3E3E3;
          }
          .navLeft > ul > li > ul > li.third{
            text-indent : 7px;
            padding-top: 0px;
          }

          .navLeft > ul >li.second > ul a{
            position: relative;     
            height:18px;     
            width: 175px;     
            padding:0;       
            text-decoration:none;     
            overflow:hidden;     
            text-overflow:ellipsis;     
            white-space:nowrap;     
            display:inline-block;     
          }

          .navLeft > ul >li.second > ul > li.third a{
            position: relative;     
            height:18px;     
            width: 150px;     
            padding:0;       
            text-decoration:none;     
            overflow:hidden;     
            text-overflow:ellipsis;     
            white-space:nowrap;     
            display:inline-block;     
          }
          table th {background-color: #f6f6f6;}
        </style>
        <script type="text/javascript">
          jQuery(document).ready(function($) {
            var winHeight = $(window).height();
            var navLeftWidth = $(".col-xs-2").width();
          
            $(".navLeft").height(winHeight);
            $(".navLeft").width(navLeftWidth);

            $('#table').bootstrapTable();
            $('[data-toggle="tooltip"]').tooltip();
            var navHeight = winHeight - 150;
            var navUlHiehgt= $("#navUl").height();
            $(window).resize(function(event) {
              adjust();
            });

            $('.second').on("show.bs.collapse", function(e){
              if($(e.target).hasClass('second'))
              {             
                var myHeight = navHeight - navUlHiehgt;
                $(this).children("ul").height(myHeight);
                $(this).children("ul").css("overflow-y", "scroll");
              }
              
            });

            $("li.first").click(function(){
              $(this).siblings('li').removeClass('active');
              $(this).siblings('.collapse').collapse("hide");
              $(this).addClass('active');
            });

          });

          function adjust()
          {
            var winHeight = $(window).height();
            var navLeftWidth = $(".col-xs-2").width();
            $(".navLeft").height(winHeight);
            //$(".navLeft").width(navLeftWidth);
          }

          function queryParams() {
              return {
                  type: 'owner',
                  sort: 'updated',
                  direction: 'desc',
                  per_page: 100,
                  page: 1
              };
          }
          !function ($) {
              
              
              $(document).on("click","#left ul.nav li.parent > a > span.sign", function(){          
                  $(this).find('i:first').toggleClass("icon-minus");      
              }); 
              
              // Open Le current menu
              $("#left ul.nav li.parent.active > a > span.sign").find('i:first').addClass("icon-minus");
              $("#left ul.nav li.current").parents('ul.children').addClass("in");

          }(window.jQuery);
        </script>
    </head>
    <body>
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
              <img src="<?php echo $base_url?>assets/Qassets/images/logo.png" width="213"/>
            </a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">首頁 <span class="sr-only">(current)</span></a></li>
              <li><a href="#">Link</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
              <li style="padding: 8px;">
                <div class="dropdown">
                  <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    kingwang317@gmail.com
                    <span class="caret"></span>
                  </button>
                  <div class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" style="width: 250px; padding: 0px;">
                    <p class="UserInfo">
                      <span style="font-weight: 700;">King Wang</span> <br />
                      kingwang317@gmail.com
                    </p>
                    <p class="UserInfoBtn">
                      <button class="btn btn-danger">登出</button>
                    </p>
                  </div>
                </div>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

      <div class="row" style="margin-top: 55px;">
        <div class="navLeft">
          <ul class="list-unstyled" id="navUl">
            <?php foreach($index_list as $key=>$row):?>
            <li class="first <?php if($key == 0):?>active<?php endif;?>" data-toggle="collapse" data-target="#F<?php echo $row->code_id?>" aria-expanded="false" aria-controls="F<?php echo $row->code_id?>"><?php echo $row->code_name?></li>
              <?php if(count($row->sub_cate) > 0):?>
                <li class="second collapse" id="F<?php echo $row->code_id?>">
                  <ul class="list-unstyled">
                <?php foreach($row->sub_cate as $sub_row):?>
                      <li data-toggle="collapse" data-target="#S<?php echo $sub_row->code_id?>" aria-expanded="false" aria-controls="S<?php echo $sub_row->code_id?>"><a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo $sub_row->code_name;?>"><span class="glyphicon glyphicon-menu-right"></span><?php echo $sub_row->code_name;?></a></li>
                      <?php if(count($sub_row->chapters) > 0):?>
                        <li class="third collapse" id="S<?php echo $sub_row->code_id?>">
                          <ul class="list-unstyled">
                          <?php foreach($sub_row->chapters as $ch):?>
                            <li><?php echo $ch->cp_key?></li>
                          <?php endforeach;?>
                          </ul>
                        </li>
                      <?php elseif(count($sub_row->sub_cate) > 0):?>
                        <li class="third collapse" id="S<?php echo $sub_row->code_id?>">
                          <ul class="list-unstyled">
                          <?php foreach($sub_row->sub_cate as $ch):?>
                            <li><a href="#"><?php echo $ch->code_name?></a></li>
                          <?php endforeach;?>
                          </ul>
                        </li>
                      <?php endif;?>
                <?php endforeach;?>
                    </ul>
                  </li>
              <?php endif;?>
            <?php endforeach;?>
            <!-- <li class="second collapse" id="G1">
              <ul class="list-unstyled">
                <li data-toggle="collapse" data-target="#G2-1" aria-expanded="false" aria-controls="G2-1"><span class="glyphicon glyphicon-menu-right"></span>策略及分析           
                </li>
                <li class="third collapse" id="G2-1">
                  <ul class="list-unstyled">
                    <li>G4-1</li>
                    <li>G4-2</li>
                    <li>G4-3</li>
                  </ul>
                </li>
                <li data-toggle="collapse" data-target="#G2-2" aria-expanded="false" aria-controls="G2-2"><span class="glyphicon glyphicon-menu-right"></span>組織概況              
                </li>
                <li class="third collapse" id="G2-2">
                  <ul class="list-unstyled">
                    <li>G4-1</li>
                    <li>G4-2</li>
                    <li>G4-3</li>
                  </ul>
                </li>
              </ul>
            </li>
            
            <li class="first" data-toggle="collapse" data-target="#G3" aria-expanded="false" aria-controls="G3">特定標準揭露</li>
            <li class="second collapse" id="G3">
              <ul class="list-unstyled">
                <li data-toggle="collapse" data-target="#G4" aria-expanded="false" aria-controls="G4">策略及分析<span class="glyphicon glyphicon-menu-right"></span>                
                </li>
                <li class="third collapse" id="G4">
                  <ul class="list-unstyled">
                    <li>G4-1</li>
                    <li>G4-2</li>
                    <li>G4-3</li>
                  </ul>
                </li>
              </ul>
            </li> -->

          </ul>
        </div>
        <div class="col-xs-2 left"></div>
        <div class="col-xs-10" id="rightArea">
          <ol class="breadcrumb">
            <li><a href="#">首頁</a></li>
            <li><a href="#">G4 一般標準揭露</a></li>
            <li class="active">策略及分析</li>
          </ol>
            <table data-toggle="table" id="table" data-show-columns="true" ata-search="true" data-show-refresh=-"true" data-search="true" data-pagination="true" data-query-params="queryParams">
                <thead>
                    <tr>
                        <th data-field="code" data-sortable="true">代碼</th>
                        <th data-field="descp" data-sortable="true">條文摘要</th>
                        <th data-halign="center" data-align="center">條文</th>
                        <th data-halign="center" data-align="center">解說</th>
                        <th data-halign="center" data-align="center">範例</th>
                        <th data-halign="center" data-align="center">撰寫</th>
                        <th data-field="explain">註解</th>
                        <th data-field="people" data-sortable="true">當責人員</th>
                        <th data-field="deadline" data-sortable="true">當責人員應完成日期</th>
                        <th data-field="modifyDate" data-sortable="true">最後修改日期</th>
                        <th data-field="modifyBy" data-sortable="true">修改者</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>G4-1*</td>
                        <td>
                          <a href="#" data-toggle="tooltip" data-placement="top" title="提供組織最高決策者的聲明（如CEO、董事長或等同的高階職位者），內容包含判斷與組織相關的永續性議題，及針對這些對組織具相關性的面向提出永續性策略">提供組織最高決策者的聲明（如如CEO、董...
                          </a>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal1"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-pencil"></i></button>
                        </td>
                        <td>ABC</td>
                        <td>EDF</td>
                        <td>2015-06-01</td>
                        <td>2015-05-23</td>
                        <td>兆豐金-人事部</td>
                    </tr>
                    <tr>
                        <td>G4-2</td>
                        <td>
                          <a href="#" data-toggle="tooltip" data-placement="top" title="描述關鍵衝擊、風險及機會">描述關鍵衝擊、風險及機會
                          </a>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal1"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-success" class="btn btn-success" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-pencil"></i></button>
                        </td>
                        <td>ABC</td>
                        <td>EDF</td>
                        <td>2015-06-01</td>
                        <td>2015-05-23</td>
                        <td>兆豐金-人事部</td>
                    </tr>
                    <tr>
                        <td>G4-3</td>
                        <td>
                          <a href="#" data-toggle="tooltip" data-placement="top" title="說明組織名稱">說明組織名稱
                          </a>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal1"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-success" class="btn btn-success" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-pencil"></i></button>
                        </td>
                        <td>ABC</td>
                        <td>EDF</td>
                        <td>2015-06-01</td>
                        <td>2015-05-23</td>
                        <td>兆豐金-人事部</td>
                    </tr>
                    <tr>
                        <td>G4-4</td>
                        <td>
                          <a href="#" data-toggle="tooltip" data-placement="top" title="說明主要品牌、產品與服務">說明主要品牌、產品與服務
                          </a>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal1"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-success" class="btn btn-success" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-pencil"></i></button>
                        </td>
                        <td>ABC</td>
                        <td>EDF</td>
                        <td>2015-06-01</td>
                        <td>2015-05-23</td>
                        <td>兆豐金-人事部</td>
                    </tr>
                    <tr>
                        <td>G4-5</td>
                        <td>
                          <a href="#" data-toggle="tooltip" data-placement="top" title="說明組織總部所在位置">說明組織總部所在位置
                          </a>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal1"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-success" class="btn btn-success" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-pencil"></i></button>
                        </td>
                        <td>ABC</td>
                        <td>EDF</td>
                        <td>2015-06-01</td>
                        <td>2015-05-23</td>
                        <td>兆豐金-人事部</td>
                    </tr>
                    <tr>
                        <td>G4-6</td>
                        <td>
                          <a href="#" data-toggle="tooltip" data-placement="top" title="組織營運所在的國家數量及國家名(包括主要營運所在國或與永續發展議題有關的所在國) 。">組織營運所在的國家數量及國家名...
                          </a>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal1"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-question-sign"></i></button>
                        </td>
                        <td>
                          <button class="btn btn-xs btn-success" class="btn btn-success" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-pencil"></i></button>
                        </td>
                        <td>ABC</td>
                        <td>EDF</td>
                        <td>2015-06-01</td>
                        <td>2015-05-23</td>
                        <td>兆豐金-人事部</td>
                    </tr>
                </tbody>
            </table>
        </div>

      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">條文xxxx</h4>
            </div>
            <div class="modal-body">
             內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">解說xxxx</h4>
            </div>
            <div class="modal-body">
             內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">範例xxxx</h4>
            </div>
            <div class="modal-body">
             內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文內文
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">撰寫</h4>
            </div>
            <div class="modal-body">
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    </body>
</html>