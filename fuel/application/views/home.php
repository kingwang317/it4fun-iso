<!DOCTYPE html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0" /> <!-- 於手機觀看時不會自動放大 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <!-- 最佳的IE兼容模式 -->
<title>Isoleader GRI Training System</title>
<link href="<?php echo site_url() ?>assets/templates/css/main.css" rel="stylesheet" type="text/css" />
<!--link font awesome to use the icon-->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="shortcut icon" type="image/png" href="<?php echo site_url() ?>assets/templates/images/iso_icon.png"/>
<script type="text/javascript" src="<?php echo site_url() ?>assets/templates/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo site_url() ?>assets/templates/js/jqueryUI-1.11.1.js"></script>
<style type="text/css">
.list {
    max-width:1200px;
    margin: 0px auto;
    width:80%;
    font-size:17px;
}
.show_button{
    font-size:18px;
    margin-bottom:20px;
}
.h1_button {
    color:white;
    background:black;
    font-weight: normal;
    font-size:14px;
    margin:10px 10px 10px 0;
    text-align:center;
    display:inline-block;
    height:40px;
    line-height:40px;
    border:solid 1px #ccc;
    border-radius: 2px;
    cursor: pointer;
}
.button_hover{
    transition: opacity 8000 ease-in-out;
    color:white;
    background:#E54040;
    cursor: pointer;
}
.button_click{
    transition: opacity 8000 ease-in-out;
    color:white;
    background:#E54040;
    cursor: auto;
}
.list_block{
    margin-bottom:30px;
    padding-bottom:10px;
    border:solid 1px #ccc;
    background:#F6F6F6;
    border-radius: 2px;
}
.list_title{
    width: -moz-calc(100%-1px);
    width: -webkit-calc(100%-1px);
    width: calc(100%-1px);
    font-size:22px;
    background:#E54040;
    margin-left:-1px;
    height:60px;
    color:white;
    text-indent:20px;
    line-height:60px;
    border-radius: 2px 2px 0 0;
    padding-left:4px;
    color:#fff;
}
.detail_block{
    padding:20px 0 10px 40px;
}
.detail_link{
    margin:10px 10px 10px 0;
    color:#Db3a3a;
    display:inline-block;
    border:solid 1px #ccc;
    border-radius: 2px;
    cursor: pointer;
    height:30px;
    line-height:30px;
    width:100px;
    text-align:center;
    background:#FFF;
    font-weight:100;
    font-size:16px;
}
.fa-file-text-o{
    color:#DB3a3a;
    margin-right:5px;
}
.category{
    font-size:20px;
    margin:10px 0 10px 0;
}
</style>
</head>

<body>
<!-- 上方檔案 ↓ -->
<?php  $this->load->view('top')?>
<!-- Navigation -->
<div id="nav" class="main_width"><div class="nav_mv">
You are in <a href="index.php">首頁</a> &gt; <a href="sub1.php">索引總表</a> 
</div></div>
<!-- Visual -->
<div id="visual" class="main_width">
<img src="<?php echo site_url() ?>assets/templates/images/vs01.jpg"/>
</div>
<!-- 內容 start -->
<div class="list">
<div style="font-size:25px;margin-top:20px;margin-bottom:20px;color:#333;">
Global Reporting Initiative Sustainability Reporting Guidelines Version 4
</div>
<div class="show_button">
顯示：
<div class="h1_button core_button" style="width:80px">CORE</div>
<div class="h1_button com_button button_click" style="width:150px">COMPREHENSIVE</div>
</div>
<!-- list start -->
<?php
//echo "<pre>";
//print_r($index_list);
//echo "</pre>";
foreach ($index_list as $key => $root_value) {

?>
<div class="list_block">
    <div class="list_title"><?php echo $root_value->code_name ?></div>
    <?php
    if(isset($root_value->sub_cate ))
    foreach ($root_value->sub_cate as $key => $sub_cate_value) {

    ?>
     <div class="detail_block">
        <div class="detail_title category"><?php echo $sub_cate_value->code_name ?></div>

            <?php
            if(isset($sub_cate_value->chapters))
            foreach ($sub_cate_value->chapters as $key => $sub_chapter_value) {

            ?>

            <div class="detail_link" onClick="location.href = '<?php echo site_url()."/home/detail?id=$sub_chapter_value->id" ?>';" ><i class="fa fa-file-text-o"></i><?php echo $sub_chapter_value->cp_key ?></div>
            
            <?php 

            } 

            ?>


            <?php
            if(isset($sub_cate_value->sub_cate))
            foreach ($sub_cate_value->sub_cate as $key => $third_cate_value) {

            ?>

            <div class="detail_title category"></i><?php echo $third_cate_value->code_name ?></div>


            <?php
            if(isset($third_cate_value->chapters))
            foreach ($third_cate_value->chapters as $key => $third_chapter_value) {

            ?>

            <div class="detail_link" onClick="location.href = '<?php echo site_url()."/home/detail?id=$third_chapter_value->id" ?>';" ><i class="fa fa-file-text-o"></i><?php echo $third_chapter_value->cp_key ?></div>
            
            <?php 

            } 

            ?>

            <?php
            if(isset($third_cate_value->sub_cate))
            foreach ($third_cate_value->sub_cate as $key => $fourth_cate_value) {

            ?>

            <div class="detail_title category"></i><?php echo $fourth_cate_value->code_name ?></div>


            <?php
            if(isset($fourth_cate_value->chapters))
            foreach ($fourth_cate_value->chapters as $key => $fourth_chapter_value) {

            ?>

            <div class="detail_link" onClick="location.href = '<?php echo site_url()."/home/detail?id=$fourth_chapter_value->id" ?>';" ><i class="fa fa-file-text-o"></i><?php echo $fourth_chapter_value->cp_key ?></div>
            
            <?php 

            } 

            ?>
            
            <?php 

            } 

            ?>
            
            <?php 

            } 

            ?>




    </div>


    <?php

    }

    ?>
</div>
<?php

}

?>


<!-- 最底宣告 -->
<?php  $this->load->view('foot') ?>

</body>
</html>

<!--Script放後面加速頁面產生-->
<script type="text/javascript">
    var $log = $("#login"),
            $log_a = $(".login"),
            $content = $("#content"),
            $vis_h = $("#visual").height(),
            $h = $(window).height(),
            $b_h = $h - $vis_h - 101;

    $log_a.click(function() {
        if ($log.hasClass("none")) {
            $log.removeClass("none");
        } else {
            $log.addClass("none");
        }
    }).mouseleave(function() {
        $("#nav ,#visual ,#foot ,#content ,.close").click(function() {
            $log.addClass("none");
        })
    });
    /*control CORE COMPREHENSIVE effects*/
    $('.h1_button').on({
        mouseover: function() {
            $(this).addClass('button_hover', 200);
        },
        mouseleave: function() {
            $(this).removeClass('button_hover', 200);
        }        
    });
    
    /*use core_button and com_button to hide/show the class=core */
    $(".core_button").click(function(){
        $(".core_button").addClass('button_click');
        $(".com_button").removeClass('button_click');
        $(".core").hide();
    });
    $(".com_button").click(function(){
        $(".com_button").addClass('button_click');
        $(".core_button").removeClass('button_click');
        $(".core").show();
    });
</script>