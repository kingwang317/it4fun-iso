var formArray = [];
jQuery(document).ready(function($) {
  
  MainPage();
  GriFormField();

  $("#myModal1").on("show.bs.modal", function(){
    var altura = $(window).height() - 180; //value corresponding to the modal heading + footer
    var modalWidth = $(window).width() - 100;
    $(this).find(".modal-body").css({"height":altura,"overflow-y":"auto"});
    $(this).find(".modal-lg").css({"width": modalWidth});
  });

});

function MainPage()
{
  var WinHeight = $(window).height() - 87;

  $(".LeftMenu").height(WinHeight);

  $("#OpenMenuBtn").click(function(){
    var LeftMenuWidth = $(".LeftMenu").width();
    $(".LeftMenu").fadeIn(100);
    $("#TableContent").animate({
      "margin-left": LeftMenuWidth + "px"},
      200, function(){
        $(this).removeClass('pure-u-sm-24-24').addClass('pure-u-sm-20-24');

      });
  });

  $("#CloseMenuBtn").click(function() {
    $(".LeftMenu").fadeOut(100);
    $("#TableContent").removeClass('pure-u-sm-20-24').addClass('pure-u-sm-24-24');
    $("#TableContent").animate({
      "margin-left": 0},
      200);
  });


  $("#GriTable tbody tr").mouseover(function(event) {
    $(this).find(".ulMenu").show();
    //$(this).siblings('tr').find(".ulMenu").hide();
  });

  $("#GriTable tbody tr").mouseleave(function(event) {
    $(this).find(".ulMenu").hide();
  });

  $("#GriTable th").click(function(){
    if($(this).find("i").attr("nowStatus") == "bottom")
    {
      $(this).find("i").removeClass('glyphicon-triangle-bottom');
      $(this).find("i").addClass('glyphicon-triangle-top');
      $(this).find("i").attr("nowStatus", "top");
    }
    else
    {
      $(this).find("i").removeClass('glyphicon-triangle-top');
      $(this).find("i").addClass('glyphicon-triangle-bottom');
      $(this).find("i").attr("nowStatus", "bottom");
    }
  });

  $(".ulMenu li").click(function(){
    $(this).addClass('active');
    $(this).siblings('li').removeClass('active');
  });

  $('#GriTable').DataTable({
    "paging": false,
    "searching": false,
    "info": false
  });
}

function GriFormField()
{
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
}