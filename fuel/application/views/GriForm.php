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
        <script type="text/javascript" src="<?php echo $base_url?>assets/Qassets/js/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <!--<![endif]-->
        <!--<![endif]-->
        <style type="text/css">
          #wrapper{
            width: 1000px;
            margin: 0 auto;
          }
          #SelectItem ul li{font-size: 12px;}
          .control-label{padding-top: 7px;}
          .form-edit{
            display: block;
            background-color:#fbfbfb;
            padding:.5em 2em 1.5em;
            -webkit-box-shadow: 0px 0px 5px 2px rgba(209,209,209,1);
            -moz-box-shadow: 0px 0px 5px 2px rgba(209,209,209,1);
            box-shadow: 0px 0px 5px 2px rgba(209,209,209,1);
            margin-bottom: 10px;
          }
          .form-edit:hover{cursor: move;}
          .show-area:hover{cursor: move; background-color: #F4F4F4;}
          .show-area{
            position: relative;
            display: block;
            margin-bottom: 10px;
            margin-top: 10px;
            background-color: #fff;
            width: 100%;
            height: 100%;
            padding: 10px 20px 10px 20px;
          }
          .show-area h3{margin-top: 5px; margin-bottom: 5px; font-size: 20px;}
          .show-area h4{color:#B5B5B5; margin-top: 5px; font-size: 16px; padding-left: 5px;}
          .ShadowBox{
            -webkit-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
            box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
            background-color: #FFFFFF !important;
          }
          .show-area-btn-group{position: absolute; top:10px; right: 20px;}
          .pure-g{margin-bottom: 5px; letter-spacing: 0em;}
          p.LINE{border-top: 1px solid #ddd; margin-top: 5px;}
          label{font-size: 12px;}
          .radio, .checkbox label{line-height: 23px;}
          .panel-body{padding: 0px;}
        </style>
        <script type="text/javascript">
          var formArray = [];
          jQuery(document).ready(function($) {
            $("a[tpl='Grid']").click(function(event) {
              $(".form-edit").remove();
              var source   = $("#grid-template").html();
              var template = Handlebars.compile(source);
              var context = {name: "Grid"};
              var html    = template(context);

              $(".panel-body").append(html);
              $(".form-edit input").eq(0).focus();
            });

            $(document).on("click", "button[name='AddRow']", function(){
              $(this).parents(".pure-g").remove();
              var SeqNo = $(".row-list input").length + 1;
              var source   = $("#grid-label-input-template").html();
              var template = Handlebars.compile(source);
              var context = {RowCol: "Row", SeqNo: SeqNo, LabelName: "Row"};
              var html    = template(context);

              $(".row-list").append(html);
              $(".row-list input").eq(SeqNo - 1).focus().select();

              var source   = $("#grid-label-button-template").html();
              var template = Handlebars.compile(source);
              var context = {RowCol: "Row", SeqNo: SeqNo + 1, LabelName: "Row"};
              var html    = template(context);
              $(".row-list").append(html);

            });

            $(document).on("click", "button[name='AddCol']", function(){
              $(this).parents(".pure-g").remove();
              var SeqNo = $(".col-list input").length + 1;
              var source   = $("#grid-label-input-template").html();
              var template = Handlebars.compile(source);
              var context = {RowCol: "Col", SeqNo: SeqNo, LabelName: "Column"};
              var html    = template(context);

              $(".col-list").append(html);
              $(".col-list input").eq(SeqNo - 1).focus().select();

              var source   = $("#grid-label-button-template").html();
              var template = Handlebars.compile(source);
              var context = {RowCol: "Col", SeqNo: SeqNo + 1, LabelName: "Column"};
              var html    = template(context);
              $(".col-list").append(html);

            });

            $(document).on("click", "button[name='RmvRowCol']", function(){
              $(this).parents(".pure-g").remove();
              $("label[btnLabel='Row']").find("span").text($(".row-list input").length + 1);
              $("label[btnLabel='Col']").find("span").text($(".col-list input").length + 1);
              
            });

            $(document).on("click", "button[name='showRm']", function(){
              $(this).parents(".show-area").remove();
            });   

            /*這裡是Option*/
            $("a[tpl='MultipleChoice']").click(function(event) {
              $(".form-edit").remove();
              var source   = $("#Multiple-template").html();
              var template = Handlebars.compile(source);
              var context = {name: "Option", FormType: 0};
              var html    = template(context);

              $(".panel-body").append(html);
              $(".form-edit input").eq(0).focus();
              
            });

            $("a[tpl='Checkboxs']").click(function(event) {
              $(".form-edit").remove();
              var source   = $("#Multiple-template").html();
              var template = Handlebars.compile(source);
              var context = {name: "Option", FormType: 1};
              var html    = template(context);

              $(".panel-body").append(html);
              $(".form-edit input").eq(0).focus();
              
            });

            $(document).on("click", "button[name='AddOption']", function(){
              $(this).parents(".pure-g").remove();
              var Name = "";
              var FormType = parseInt($("#FormType").val());
              var SeqNo = $(".option-list input[type='text']").length + 1;
              var source   = $("#checkbox-input-template").html();
              var template = Handlebars.compile(source);

              var context = {"Name": "Option", "SeqNo": SeqNo, "FormType": FormType};
              var html    = template(context);

              $(".option-list").append(html);
              $(".option-list input[type='text']").eq(SeqNo - 1).focus().select();

              var source   = $("#AddOption-template").html();
              var template = Handlebars.compile(source);
              //var context = {RowCol: "Row", SeqNo: SeqNo + 1, LabelName: "Row"};
              var html    = template(context);
              $(".option-list").append(html);

            });


            $(document).on("click", "button[name='Option']", function(){
              var QT = $("div[name='Option']").find("input[name='QT']").val();
              var HT = $("div[name='Option']").find("input[name='HT']").val();
              var FormType = parseInt($("#FormType").val());
              var OptObj = {};

              OptObj.QT = QT;
              OptObj.HT = HT;
              OptObj.FormType = 'option';

              if(FormType == 0)
              {
                OptObj.InputType = "radio";
              }
              else
              {
                OptObj.InputType = "checkbox";
              }

              OptObj.opt = [];

              $(".option-list input[type='text']").each(function(index, el) {
                var opt = $(this).val();
                var obj = {};
                obj.InputType = (FormType == 0)?"radio":"checkbox";
                obj.val = opt;
                OptObj.opt.push(obj);
              });

              console.log(OptObj);
              formArray.push(OptObj);
              var source   = $("#option-show-template").html();
              var template = Handlebars.compile(source);
              var html     = template(OptObj);

              $(".panel-body").append(html); 

              $("div[name='Option']").remove();
            });

            $(document).on("click", "button[name='Grid']", function(){
              var QT = $("div[name='Grid']").find("input[name='QT']").val();
              var HT = $("div[name='Grid']").find("input[name='HT']").val();
              var GridObj = {};

              GridObj.QT = QT;
              GridObj.HT = HT;
              GridObj.FormType = 'grid';

              GridObj.Row = [];
              GridObj.Col = [];
              GridObj.Val = [];

              $(".row-list input").each(function(i, val) {
                var RowName  = $(this).val();
                var RowData  = {};
                RowData.Name = RowName;
                RowData.Val  = [];
                GridObj.Row.push(RowData);
              });

              $(".col-list input").each(function(index, el) {
                var ColName = $(this).val();
                GridObj.Col.push(ColName);
                
              });

              $.each(GridObj.Row, function(i, val) {
                 $.each(GridObj.Col, function(index, value) {
                    var idName = i.toString() + index.toString();
                    var obj = {};
                    obj.id = idName;
                    obj.Name = GridObj.Row[i].Name;
                    GridObj.Row[i].Val.push(obj);
                 });
              });

              console.log(GridObj);
              formArray.push(GridObj);
              var source   = $("#grid-show-template").html();
              var template = Handlebars.compile(source);
              var html     = template(GridObj);

              $(".panel-body").append(html); 

              $("div[name='Grid']").remove();
            });  
            /*這裡是Option end*/

            function logArrayElements(element, index, array) {
              console.log('a[' + index + '] = ' + element);
            }

            $(document).on("click", "button[name='Save']", function(){
              
                formArray.forEach(logArrayElements);

                var url = '<?php echo $base_url?>FormSave';   
                
                $.ajax({
                  url: url,
                  type: 'POST',
                  dataType: 'json',
                  data: {data : formArray},
                  success: function(data)
                  {
                    console.log(data);
                    if(data.status == 1)
                    { 

                    } 
                  }
                });
            });

            $( "#FormArea" ).sortable({
              placeholder: "show-area",
              out: function( event, ui ) {
                ui.item.removeClass('ShadowBox');
              },
              over: function(event, ui)
              {
                ui.item.addClass('ShadowBox');
              }

            });
          });
        </script>
    </head>
    <body>
      <div id="wrapper">
        <div class="panel panel-default">
          <div class="panel-heading">Panel heading without title</div>
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
                      <li><a href="#">Text</a></li>
                      <li><a href="#">Paragraph Text</a></li>
                      <li><a href="#" tpl="MultipleChoice">Multiple Choice</a></li>
                      <li><a href="#" tpl="Checkboxs">Checkboxs</a></li>
                      <li><a href="#">Choose from a list</a></li>
                    </ul>
                  </div>
                  <div class="pure-u-sm-8-24">
                    <ul class="list-unstyled">
                      <li>ADVANCED</li>
                      <li><a href="#">Scale</a></li>
                      <li><a href="#" tpl="Grid">Grid</a></li>
                      <li><a href="#">Date</a></li>
                      <li><a href="#">Time</a></li>
                    </ul>
                  </div>
                  <div class="pure-u-sm-8-24">
                    <ul class="list-unstyled">
                      <li>LAYOUT</li>
                      <li><a href="#">Section header</a></li>
                      <li><a href="#">Page break</a></li>
                      <li><a href="#">Image</a></li>
                      <li><a href="#">Video</a></li>
                    </ul>
                  </div>
                </div>
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
