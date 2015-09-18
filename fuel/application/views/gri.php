<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A layout example that shows off a responsive product landing page.">
        <title>Landing Page &ndash; Layout Examples &ndash; Pure</title>
        <link rel="stylesheet" type="text/css" href="<?php echo $base_url?>assets/Qassets/bootstrap/css/bootstrap.css">

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="http://yui.yahooapis.com/combo?pure/0.6.0/base-min.css&pure/0.6.0/grids-min.css&pure/0.6.0/grids-responsive-old-ie-min.css">
        <![endif]-->
        <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="http://yui.yahooapis.com/combo?pure/0.6.0/base-min.css&pure/0.6.0/grids-min.css&pure/0.6.0/grids-responsive-min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $base_url?>assets/Qassets/css/style.css">
        <script type="text/javascript" src="<?php echo $base_url?>assets/Qassets/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo $base_url?>assets/Qassets/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript">
          var base_url = "<?php echo $base_url;?>";
        </script>
        <script type="text/javascript" src="<?php echo $base_url?>assets/Qassets/js/gri.js"></script>
        <!--<![endif]-->
        <!--<![endif]-->
    </head>
    <body>
    <div id="wrapper">
      <div class="pure-g" style="margin-top: 5px; margin-bottom: 10px; padding-left:10px;">
        <div class="pure-u-sm-4-24" style="">
          <img src="<?php echo $base_url?>assets/images/logo.jpg" width="213" />
        </div>
        <div class="pure-u-sm-16-24" style="padding-left: 10px;">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search GRI G4" id="SearText" name="SearTextd">
            <span class="input-group-btn">
              <button class="btn btn-gray" type="button"><span class="glyphicon glyphicon-search"></span></button>
            </span>
          </div>
        </div>
        <div class="pure-u-sm-4-24"></div>
      </div>

      <nav class="navbar navbar-default" style="margin-bottom:0px;">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header" style="padding: 10px;">
            <button class="btn btn-sm btn-gray" id="OpenMenuBtn"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          
            <ul class="nav navbar-nav">
              <?php foreach ($index_list as $key => $root_value):?>
              <li class="active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <?php echo $root_value->code_name ?> <span class="caret"></span>
                </a>
                
                <ul class="dropdown-menu">
                  <?php if(isset($root_value->sub_cate )):?>
                    <?php foreach ($root_value->sub_cate as $key => $sub_cate_value):?>
                      <li class="dropdown-submenu">
                        <a tabindex="-1" href="#" CodeId="<?php echo $sub_cate_value->code_id ?>" ParentId="<?php echo $sub_cate_value->parent_id ?>" Level="1"><?php echo $sub_cate_value->code_name ?></a>
                        <ul class="dropdown-menu">
                          <?php if(isset($sub_cate_value->chapters)):?>
                            <?php foreach ($sub_cate_value->chapters as $key => $sub_chapter_value):?>
                              <li><a href="#" CpId="<?php echo $sub_chapter_value->id?>" Level="1"><?php echo $sub_chapter_value->cp_key ?></a></li>
                            <?php endforeach;?>
                          <?php endif;?>
                          <?php if(isset($sub_cate_value->sub_cate)):?>
                            <?php foreach ($sub_cate_value->sub_cate as $key => $third_cate_value):?>
                              <li class="dropdown-submenu">
                                <a tabindex="-1" href="#" CodeId="<?php echo $third_cate_value->code_id ?>" ParentId="<?php echo $third_cate_value->parent_id ?>" Level="2"><?php echo str_replace("Sub- Categories:", "", $third_cate_value->code_name) ?></a>
                                <ul class="dropdown-menu">
                                  <?php if(isset($third_cate_value->chapters)):?>
                                    <?php foreach ($third_cate_value->chapters as $key => $third_chapter_value):?>
                                      <li><a href="#" CpId="<?php echo $third_chapter_value->id?>" Level="2"><?php echo $third_chapter_value->cp_key ?></a></li>
                                    <?php endforeach;?>
                                  <?php endif;?>
                                  <?php if(isset($third_cate_value->sub_cate)):?>
                                    <?php foreach ($third_cate_value->sub_cate as $key => $fourth_cate_value):?>
                                      <li class="dropdown-submenu">
                                        <a tabindex="-1" href="#" CodeId="<?php echo $fourth_cate_value->code_id ?>" ParentId="<?php echo $fourth_cate_value->parent_id ?>" Level="3"><?php echo str_replace("Aspect:", "", $fourth_cate_value->code_name); ?></a>
                                        <ul class="dropdown-menu">
                                          <?php if(isset($fourth_cate_value->chapters)):?>
                                            <?php foreach ($fourth_cate_value->chapters as $key => $fourth_chapter_value):?>
                                              <li><a href="#" CpId="<?php echo $fourth_chapter_value->id?>" Level="3"><?php echo $fourth_chapter_value->cp_key ?></a></li>
                                            <?php endforeach;?>
                                          <?php endif;?>
                                        </ul>
                                      </li>
                                    <?php endforeach;?>
                                  <?php endif;?>
                                </ul>
                              </li>
                            <?php endforeach;?>
                          <?php endif;?>
                        </ul>
                      </li>
                    <?php endforeach;?>
                  <?php endif;?>
                </ul>
              </li>
              <li><a>|</a></li>
            <?php endforeach;?>
            </ul>
          
        </div><!-- /.container-fluid -->
      </nav>

      <div class="pure-g">
        <div class="pure-u-sm-4-24 LeftMenu">
          <div class="MenuClose">
            <a href="#" class="btn btn-gray1 btn-circle" id="CloseMenuBtn"><i class="glyphicon glyphicon-remove"></i></a>
          </div>
          <ul class="nav navLeft">
            <?php foreach ($index_list as $key => $root_value):?>
            <li class="dropdown-submenu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <?php echo $root_value->code_name ?>
              </a>

              <ul class="dropdown-menu">
                <?php if(isset($root_value->sub_cate )):?>
                  <?php foreach ($root_value->sub_cate as $key => $sub_cate_value):?>
                    <li class="dropdown-submenu">
                      <a tabindex="-1" href="#" CodeId="<?php echo $sub_cate_value->code_id ?>" ParentId="<?php echo $sub_cate_value->parent_id ?>" Level="1"><?php echo $sub_cate_value->code_name ?></a>
                      <ul class="dropdown-menu">
                        <?php if(isset($sub_cate_value->chapters)):?>
                          <?php foreach ($sub_cate_value->chapters as $key => $sub_chapter_value):?>
                            <li><a href="#" href="#" CpId="<?php echo $sub_chapter_value->id?>" Level="1"><?php echo $sub_chapter_value->cp_key ?></a></li>
                          <?php endforeach;?>
                        <?php endif;?>
                        <?php if(isset($sub_cate_value->sub_cate)):?>
                          <?php foreach ($sub_cate_value->sub_cate as $key => $third_cate_value):?>
                            <li class="dropdown-submenu">
                              <a tabindex="-1" href="#" CodeId="<?php echo $third_cate_value->code_id ?>" ParentId="<?php echo $third_cate_value->parent_id ?>" Level="2"><?php echo str_replace("Sub- Categories:", "", $third_cate_value->code_name) ?></a>
                              <ul class="dropdown-menu">
                                <?php if(isset($third_cate_value->chapters)):?>
                                  <?php foreach ($third_cate_value->chapters as $key => $third_chapter_value):?>
                                    <li><a href="#" CpId="<?php echo $third_chapter_value->id?>" Level="2"><?php echo $third_chapter_value->cp_key ?></a></li>
                                  <?php endforeach;?>
                                <?php endif;?>
                                <?php if(isset($third_cate_value->sub_cate)):?>
                                  <?php foreach ($third_cate_value->sub_cate as $key => $fourth_cate_value):?>
                                    <li class="dropdown-submenu">
                                      <a tabindex="-1" href="#" CodeId="<?php echo $fourth_cate_value->code_id ?>" ParentId="<?php echo $fourth_cate_value->parent_id ?>" Level="3"><?php echo str_replace("Aspect:", "", $fourth_cate_value->code_name); ?></a>
                                      <ul class="dropdown-menu">
                                        <?php if(isset($fourth_cate_value->chapters)):?>
                                          <?php foreach ($fourth_cate_value->chapters as $key => $fourth_chapter_value):?>
                                            <li><a href="#" CpId="<?php echo $fourth_chapter_value->id?>" Level="3"><?php echo $third_chapter_value->cp_key ?></a></li>
                                          <?php endforeach;?>
                                        <?php endif;?>
                                      </ul>
                                    </li>
                                  <?php endforeach;?>
                                <?php endif;?>
                              </ul>
                            </li>
                          <?php endforeach;?>
                        <?php endif;?>
                      </ul>
                    </li>
                  <?php endforeach;?>
                <?php endif;?>
              </ul>
            </li>
            <?php endforeach;?>
          </ul>
        </div>
        <div class="pure-u-sm-24-24" id="TableContent">
          <table class="table table-hover" id="GriTable" width="100%">
            <thead>
              <tr>
                <th>Indicator<br /> Numbers<i class="glyphicon glyphicon-triangle-bottom" nowStatus="bottom"></i></th>
                <th>Indicator<br /> Description<i class="glyphicon glyphicon-triangle-bottom" nowStatus="bottom"></i></th>
                <th>Disclosure<br /> Status<i class="glyphicon glyphicon-triangle-bottom" nowStatus="bottom"></i></th>
                <th>Composition<br /> Annotation<i class="glyphicon glyphicon-triangle-bottom" nowStatus="bottom"></i></th>
                <th>Responsible<br /> Person<i class="glyphicon glyphicon-triangle-bottom" nowStatus="bottom"></i></th>
                <th>Last<br /> Modified<i class="glyphicon glyphicon-triangle-bottom" nowStatus="bottom"></i></th>
                <th>Pages(s)<i class="glyphicon glyphicon-triangle-bottom" nowStatus="bottom"></i></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>G4-3</td>
                <td>
                    說明組織名稱<br />
                    <ul class="ulMenu list-inline">
                      <li><a href="#" data-toggle="modal" data-target="#myModal" CPID="1">indicator</a></li>
                      <li>|</li>
                      <li><a href="#" data-toggle="modal" data-target="#myModal1" CPID="1">implantation</a></li>
                      <li>|</li>
                      <li><a href="#" data-toggle="modal" data-target="#myModal3" CPID="1">composition</a></li>
                    </ul>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>G4-4</td>
                <td>
                  說明主要品牌、產品與服務<br />
                  <ul class="ulMenu list-inline">
                    <li><a href="#" data-toggle="modal" data-target="#myModal">indicator</a></li>
                    <li>|</li>
                    <li><a href="#" data-toggle="modal" data-target="#myModal1">implantation</a></li>
                    <li>|</li>
                    <li><a href="#" data-toggle="modal" data-target="#myModal3">composition</a></li>
                  </ul>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>G4-5</td>
                <td>
                  說明組織總部所在位置
                  <ul class="ulMenu list-inline">
                    <li><a href="#" data-toggle="modal" data-target="#myModal">indicator</a></li>
                    <li>|</li>
                    <li><a href="#" data-toggle="modal" data-target="#myModal1">implantation</a></li>
                    <li>|</li>
                    <li><a href="#" data-toggle="modal" data-target="#myModal3">composition</a></li>
                  </ul>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
        <div class="modal-dialog modal-lg">
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

      <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Implantation</h4>
            </div>
            <div class="modal-body">
              <div class="panel panel-default">
                <!-- <div class="panel-heading">Panel heading without title</div> -->
                <div class="panel-body" id="FormArea">
                  
                </div>
                <div class="panel-footer">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-default">Add Item</button>
                    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-primary" name="Save">Save</button>
                    <div class="dropdown-menu" style="width: 400px; padding: 10px;">
                      <div class="pure-g" id="SelectItem">
                        <div class="pure-u-sm-8-24">
                          <ul class="list-unstyled">
                            <li>Basic</li>
                            <!-- <li><a href="#">Text</a></li>
                            <li><a href="#">Paragraph Text</a></li> -->
                            <li><a href="#" tpl="MultipleChoice">Multiple Choice</a></li>
                            <li><a href="#" tpl="Checkboxs">Checkboxs</a></li>
                            <!-- <li><a href="#">Choose from a list</a></li> -->
                          </ul>
                        </div>
                        <div class="pure-u-sm-8-24">
                          <ul class="list-unstyled">
                            <li>ADVANCED</li>
                            <!-- <li><a href="#">Scale</a></li> -->
                            <li><a href="#" tpl="Grid">Grid</a></li>
                            <!-- <li><a href="#">Date</a></li>
                            <li><a href="#">Time</a></li> -->
                          </ul>
                        </div>
                        <!-- <div class="pure-u-sm-8-24">
                          <ul class="list-unstyled">
                            <li>LAYOUT</li>
                            <li><a href="#">Section header</a></li>
                            <li><a href="#">Page break</a></li>
                            <li><a href="#">Image</a></li>
                            <li><a href="#">Video</a></li>
                          </ul>
                        </div> -->
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div></div>

      <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">解析</h4>
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

      <script id="grid-template" type="text/x-handlebars-template">
        <div class="form-edit" name="{{name}}">
          <div class="pure-g">
            <div class="pure-u-sm-4-24">
              <label class="control-label" for="QT">Question Title</label>
            </div>
            <div class="pure-u-sm-20-24">
              <input class="form-control input-sm" id="QT" name="QT" />
            </div>
          </div>
          <div class="pure-g">
            <div class="pure-u-sm-4-24">
              <label class="control-label" for="HT">Help Text</label>
            </div>
            <div class="pure-u-sm-20-24">
              <input class="form-control input-sm" id="HT" name="HT" />
            </div>
          </div>
          <div class="pure-g">
            <div class="pure-u-sm-4-24">
              <label class="control-label" for="Qtype">Question Type</label>
            </div>
            <div class="pure-u-sm-4-24">
              <select class="form-control input-sm" id="Qtype" name="Qtype">
                <option value="a">Grid</option>
                <option value="b">Text</option>
                <option value="c">Scale</option>
                <option value="d">Grid</option>
                <option value="e">Grid</option>
              </select>
            </div>
          </div>
          <br />
          <div class="row-list">
            <div class="pure-g">
              <div class="pure-u-sm-4-24">
                <label class="control-label" for="QT">Row 1 Label</label>
              </div>
              <div class="pure-u-sm-4-24">
                <input class="form-control input-sm" id="QT" name="QTRow[]" value="Row 1"/>
              </div>
            </div>
            <div class="pure-g">
              <div class="pure-u-sm-4-24">
                <label class="control-label" for="QT">Row 2 Label</label>
              </div>
              <div class="pure-u-sm-4-24">
                <button class="btn btn-sm btn-default" name="AddRow"> Click add row</button>
              </div>
            </div>
          </div>
          <div class="pure-g">
            <div class="pure-u-sm-8-24"><p class="LINE"></p></div>
          </div>
          <div class="col-list">
            <div class="pure-g">
              <div class="pure-u-sm-4-24">
                <label class="control-label" for="QT">Column 1 Label</label>
              </div>
              <div class="pure-u-sm-4-24">
                <input class="form-control input-sm" id="QT" name="QTCol[]" value="Col 1"/>
              </div>
            </div>
            <div class="pure-g">
              <div class="pure-u-sm-4-24">
                <label class="control-label" for="QT">Column 2 Label</label>
              </div>
              <div class="pure-u-sm-4-24">
                <button class="btn btn-sm btn-default" name="AddCol"> Click add row</button>
              </div>
            </div>
          </div>
          <div class="pure-g">
            <button class="btn btn-sm btn-primary" name="{{name}}">Done</button>
          </div>
        </div>
      </script>

      <script id="grid-label-input-template" type="text/x-handlebars-template">
        <div class="pure-g">
          <div class="pure-u-sm-4-24">
            <label class="control-label" for="QT{{SeqNo}}">{{LabelName}} {{SeqNo}} Label</label>
          </div>
          <div class="pure-u-sm-4-24">
            <div class="input-group">
              <input class="form-control input-sm" id="QT{{SeqNo}}" name="QT{{RowCol}}[]" value="{{RowCol}}{{SeqNo}}"/>
              <span class="input-group-btn">
                <button class="btn btn-sm btn-default" type="button" name="RmvRowCol"><i class="glyphicon glyphicon-remove"></i></button>
              </span>
            </div>
          </div>
        </div>
      </script>
      <script id="grid-label-button-template" type="text/x-handlebars-template">
        <div class="pure-g">
          <div class="pure-u-sm-4-24">
            <label class="control-label" for="QT{{SeqNo}}" btnLabel="{{RowCol}}">{{LabelName}} <span>{{SeqNo}}</span> Label</label>
          </div>
          <div class="pure-u-sm-4-24">
            <button class="btn btn-sm btn-default" name="Add{{RowCol}}"> Click add row</button>
          </div>
        </div>
      </script>
      <script id="grid-show-template" type="text/x-handlebars-template">
        <div class="show-area">
          <div class="btn-group show-area-btn-group" role="group">
            <button type="button" class="btn btn-sm btn-default" name="showEdit"><i class="glyphicon glyphicon-pencil"></i></button>
            <button type="button" class="btn btn-sm btn-default" name="showRm"><i class="glyphicon glyphicon-remove"></i></button>
            <button type="button" class="btn btn-sm btn-default" name="showCopy"><i class="glyphicon glyphicon-copy"></i></button>
          </div>
          <h3>{{QT}}</h3>
          <h4>{{HT}}</h4>
          <table class="table table-striped">
            <thead>
              <tr>
                <th></th>
                {{#each Col}}
                  <th>{{this}}</th>
                {{/each}}
              </tr>
            </thead>
            <tbody>
              {{#each Row}}
              <tr>
                <td>{{this.Name}}</td>
                {{#each Val}}
                  <td>
                    
                    <input class="form-control input-sm" name="{{this.Name}}[]" id="{{this.id}}"/>
                  </td>
                {{/each}}
              </tr>
              {{/each}}
            </tbody>
          </table>
        </div>
      </script>

      <!--這裡是Option-->
      <script id="option-show-template" type="text/x-handlebars-template">
        <div class="show-area">
          <div class="btn-group show-area-btn-group" role="group">
            <button type="button" class="btn btn-sm btn-default" name="showEdit"><i class="glyphicon glyphicon-pencil"></i></button>
            <button type="button" class="btn btn-sm btn-default" name="showRm"><i class="glyphicon glyphicon-remove"></i></button>
            <button type="button" class="btn btn-sm btn-default" name="showCopy"><i class="glyphicon glyphicon-copy"></i></button>
          </div>
          <h3>{{QT}}</h3>
          <h4>{{HT}}</h4>
          {{#each opt}}
            <div class="{{this.InputType}}">
              
                <label>
                  <input name="radio[]" type="{{this.InputType}}" value="{{this.val}}">
                  {{val}}
                </label>
              
            </div>
          {{/each}}
        </div>
      </script>

      <script id="Multiple-template" type="text/x-handlebars-template">
        <div class="form-edit" name="{{name}}">
              <div class="pure-g">
                <div class="pure-u-sm-4-24">
                  <label class="control-label" for="QT">Question Title</label>
                </div>
                <div class="pure-u-sm-20-24">
                  <input class="form-control input-sm" id="QT" name="QT" />
                  <input type="hidden" id="FormType" value="{{FormType}}" />
                </div>
              </div>
              <div class="pure-g">
                <div class="pure-u-sm-4-24">
                  <label class="control-label" for="HT">Help Text</label>
                </div>
                <div class="pure-u-sm-20-24">
                  <input class="form-control input-sm" id="HT" name="HT" />
                </div>
              </div>
              <div class="pure-g">
                <div class="pure-u-sm-4-24">
                  <label class="control-label" for="Qtype">Question Type</label>
                </div>
                <div class="pure-u-sm-4-24">
                  <select class="form-control input-sm" id="Qtype" name="Qtype">
                    <option value="a">Grid</option>
                    <option value="b">Text</option>
                    <option value="c">Scale</option>
                    <option value="d">Grid</option>
                    <option value="e">Grid</option>
                  </select>
                </div>
              </div>
              <br />
              <div class="option-list">
                <div class="pure-g">
                  <div class="pure-u-sm-4-24"></div>
                  <div class="pure-u-sm-6-24">
                    <div class="form-inline">
                      <div class="form-group">
                        {{#if FormType}}
                          <input type="checkbox" disabled/>
                        {{else}}
                          <input type="radio" disabled/>
                        {{/if}}
                        <input type="text" class="form-control input-sm" name="QTOption[]" value="Option 1"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pure-g">
                  <div class="pure-u-sm-4-24"></div>
                  <div class="pure-u-sm-6-24">
                    {{#if FormType}}
                      <input type="checkbox" disabled/>
                    {{else}}
                      <input type="radio" disabled/>
                    {{/if}}
                    <button class="btn btn-sm btn-default" name="AddOption"> Click add to option</button>
                  </div>
                </div>
              </div>
              <div class="pure-g">
                <button class="btn btn-sm btn-primary" name="{{name}}">Done</button>
              </div>
            </div>
      </script>
      <script id="checkbox-input-template" type="text/x-handlebars-template">
        <div class="pure-g">
          <div class="pure-u-sm-4-24"></div>
          <div class="pure-u-sm-6-24">
            <div class="form-inline">
              <div class="form-group">
                {{#if FormType}}
                  <input type="checkbox"/>
                {{else}}
                  <input type="radio" />
                {{/if}}
                <div class="input-group">
                  <input type="text" class="form-control input-sm" id="QT{{SeqNo}}" name="QT{{Name}}[]" value="{{Name}} {{SeqNo}}"/>
                  <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button" name="RmvRowCol"><i class="glyphicon glyphicon-remove"></i></button>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </script>
      <script id="AddOption-template" type="text/x-handlebars-template">
      <div class="pure-g">
        <div class="pure-u-sm-4-24"></div>
        <div class="pure-u-sm-6-24">
          {{#if FormType}}
            <input type="checkbox" disabled/>
          {{else}}
            <input type="radio" disabled/>
          {{/if}}
          <button class="btn btn-sm btn-default" name="AddOption"> Click add to option</button>
        </div>
      </div>
      </script>
      <!--這裡是Option end-->
    </body>
</html>
