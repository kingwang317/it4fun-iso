<!DOCTYPE html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0" /> <!-- 於手機觀看時不會自動放大 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <!-- 最佳的IE兼容模式 -->
<title>Isoleader GRI Training System</title>
<link href="<?php echo site_url() ?>assets/templates/css/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo site_url() ?>assets/templates/css/screen.css">
<link rel="stylesheet" href="<?php echo site_url() ?>assets/templates/css/jquery-ui-1.9.2.custom.min.css">
<!--link font awesome to use the icon-->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="shortcut icon" type="image/png" href="<?php echo site_url() ?>assets/templates/images/iso_icon.png"/>
<script type="text/javascript" src="<?php echo site_url() ?>assets/templates/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo site_url() ?>assets/templates/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="<?php echo site_url() ?>assets/templates/js/jquery.mousewheel.min.js" ></script>
<script type="text/javascript" src="<?php echo site_url() ?>assets/templates/js/jquery.iviewer.min.js" ></script>
<style>

</style>
</head>
<body>
<!-- 上方檔案 ↓ -->

<!-- Navigation -->
<div id="detail_top">
    <div id="top_title">GRI G4 中英雙語全文查詢系統</div>
    <div id="top_phone"><span class="fa fa-phone"></span>&nbsp;0800-222-007</div>
</div>
<div id="nav" class="main_width"><div class="nav_mv">
You are in <a href="<?php echo site_url() ?> ">首頁</a>
<?php echo $breadcrumb.'&nbsp; &gt; &nbsp;'.$chapter_detail[0]->cp_key; ?>
</div></div>



<!-- 中間內容區 ↓ -->
<div class="sub">
    
    <div class="sub_left">
        <div class="title"><?php echo $chapter_detail[0]->cp_key?>：<?php echo  $chapter_detail[0]->title?></div>
        <div class="tag_list">
            <div id="content1" class="tag" onclick="javascript:location.href='#1'">原文</div>
            <div id="content2" class="tag" onclick="javascript:location.href='#2'">解析</div>
<!--暫時隱藏 wei 2015-05-29
            <div id="content3" class="tag" onclick="javascript:location.href='#3'">範例</div>
            <div id="content4" class="tag" onclick="javascript:location.href='#4'">撰寫</div>
-->
        </div>
        <div class="left_content content1">
            <div class="volume"><a href="#"><span id="volume_text"><img src="<?php echo site_url() ?>assets/templates/images/media-volume-2.png"/>文案有聲朗讀</span></a></div>
            <?php echo  htmlspecialchars_decode($chapter_detail[0]->description) ?>
        </div>
        <div class="left_content content2" style="display:none;">
            <?php echo htmlspecialchars_decode($chapter_detail[0]->parse) ?>
        </div>
        <div class="left_content content3" style="display:none;">
            <?php foreach ($sample_list as $s_key => $s_value) {
                ?>
            <div class="content_block">
                <span class="author_style"><?php echo "Category：".htmlspecialchars_decode($s_value->kind_name)."" ?></span>
                <div class="sample_content_title"><?php echo "Subject：".htmlspecialchars_decode($s_value->title); ?></div>
                <div class="content_detail"><?php echo htmlspecialchars_decode($s_value->content); ?></div>
            </div>

                <?php
                
            } ?>
        </div>
        <div class="left_content content4" style="display:none;">
            <?php foreach ($input_list as $i_key => $i_value) {
                ?>
            <div class="content_block">
                <span class="author_style"><?php echo "the author (".htmlspecialchars_decode($i_value->author).") edit at ".htmlspecialchars_decode($i_value->create_date)." Edition ".htmlspecialchars_decode($i_value->version); ?></span>
                <div class="content_title"><?php echo htmlspecialchars_decode($i_value->title); ?></div>
                <div class="content_detail"><?php echo htmlspecialchars_decode($i_value->content); ?></div>
            </div>

                <?php
                
            } ?>
        </div>
    </div>
    <div class="sub_right">
        <div class="right_title"><?php echo $kind_name[0]->code_name; ?></div>
        <?php foreach ($chapter_list as $key => $value) {

            ?>
            <div class="right_line" onClick="location.href = '<?php echo site_url()."/home/detail?id=$value->id" ?>';"><div class="line_title"><i class="fa fa-file-text-o"></i><?php echo $value->cp_key ?>：</div><div class="line_text"><?php echo mb_substr($value->title , 0, 95);echo strlen($value->title) > 95?"...":""; ?></div></div>
            <?php 
        }?>
          </div>
<?php  $this->load->view('foot') ?>
</div>
<!-- <div id="gzoomoverlay">
</div>
<div id="gzoomlbox">
    <div id="imagebox">
        <div id="gzoom-cont-img">
            <img id="zoomedimage">
            <div id="gzoomloading">
                <a href="#" id="gzoomloadinglink">
                    <img  src="<?php echo site_url() ?>assets/templates/images/loading.gif">
                </a>
            </div>
        </div>
    </div>
    <div id="gzoomlbox-con-imgdata">
        <div id="lboximgdatacontainer">
            <div id="gzoomlbox-image-details" class="zoomPic">
                <span id="gzoom-image-caption"></span>
            </div>
        </div>
    </div>
</div> -->

<a href="#" id="back-to-top" title="Back to top"><span class="fa fa-chevron-up"></span></a>
<!-- 內容 end -->

</div>

</div>
<!-- 最底宣告 -->

    <div id="iviewer">
        <div class="loader"></div>

        <div class="viewer"></div>

        <ul class="controls">
            <li class="close"></li>
            <li class="zoomin"></li>
            <li class="zoomout"></li>
        </ul>

    </div>
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
    })
    /* control right block link's effects */
    $('.right_line').on({
        mouseover: function() {
            $(this).addClass('line_title_mouseover', 200);
        },
        mouseleave: function() {
            $(this).removeClass('line_title_mouseover', 200);
        }
    });
    /* control tags css and switch content1/2/3/4 */
    $(".tag").click(function() {
        $(".tag").each(function() {
            $(this).removeClass('tag_click');
        });
        $(this).addClass('tag_click');
        $(".left_content").hide();
        $("."+$(this).attr('id')).show();
    });
    /* control the slide_title to show their own text */
    $('.slide_title').click(function() {
        if ($(this).next().attr("id") !== 'open') {
            $(this).next().slideDown(500);
            $(this).addClass("slide_title_click");
            $('> i',this).removeClass("fa-plus-square-o").addClass("fa-minus-square-o");
            $(this).next().attr('id', 'open');
        } else {
            $(this).next().slideUp(300);
            $(this).removeClass("slide_title_click");
            $('> i',this).removeClass("fa-minus-square-o").addClass("fa-plus-square-o");
            $(this).next().removeAttr("id");
        }
    });
    /* control slide_title effects */
    $('.slide_title').on({
        mouseover: function() {
            $(this).addClass('slide_title_hover', 200);
        },
        mouseleave: function() {
            $(this).removeClass('slide_title_hover', 200);
        }
    });

    $(".sub_left img").each(function(){
            $(this).wrap($('<a>',{
               href:  this.src,
               class:'imagebox'

            })) });

    
    
    $( document ).ready(function() {
        var ss = window.location.href.split("#");
        if(ss.length > 1){
            console.log(ss.length);
            $("#content"+ss[1]).addClass("tag_click");
                
        }else{
            ss[1] = "1";
            $("#content1").addClass("tag_click");
        }

        $(".left_content").hide();
        $("."+$("#content"+ss[1]).attr('id')).show();

        

       

    
        }
    );
    
    /* back to top */
    if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}
</script>
<script type="text/javascript" src="<?php echo site_url() ?>assets/templates/js/initbox.js" ></script>