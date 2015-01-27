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
.sub{
    width:90%;
    margin: 5px 75px;
}
body{
    background-color:#fff;
}

/*left side css*/
.sub_left{
    min-width:550px;
    margin:10px 20px 0 0;
    width:70%;
    display:inline-block;
    vertical-align:top;
}
.title{
    font-size:20px;
    line-height:30px;
    margin:20px 450px 20px 5px;

}
.tag_list{
    min-width:550px;
}
.tag{
    margin-left:5px;
    text-align:center;
    font-size:16px;
    display:inline-block;
    width:120px;
    height:40px;
    line-height:40px;
    border:solid 1px #ccc;
    border-radius: 2px;
    cursor: pointer;
}
.tag_click{
    color:#E54040;
    border-bottom:0;
    height:47px;
    line-height:40px;
    position: relative;
    margin-bottom:-15px;
    background-color:white;
    cursor: auto;
}
.left_content{
    min-width: 550px;
    margin: 5px 0 10px 0;
    border-top: solid 1px #ccc;
    padding-top: 20px;
    line-height: 25px;
    padding-left: 10px;
}
.content_title{
    font-size:20px;
    margin-top: 30px;
}
.content_detail{
    font-size:16px;
    color:#4c4c4c;
}
.content_block{
    margin:10px 0 20px 0;
}
.content_slide{
    font-size:16px;
    padding-left:10px;
    margin:5px;
    border:solid 1px #ccc;
    border-radius: 2px;
    /*border-width: 1px 0 1px 0;*/
    background:#F6F6F6;
}
.fa{
    margin-right:5px;
}

.slide_title{
    cursor: pointer;
}
.slide_title_hover{
    color:#E54040;
}
.slide_title_click{
    color:#E54040;
}
.slide_text{
    color:#4c4c4c;
    font-size:15px;
    padding:0 20px 0 20px;
}
li{
      list-style-type: disc;
      margin-left: 40px;
}
/*left side css - END*/

/*right side css*/
.sub_right{
    min-width:200px;
    margin:55px 0px 20px 20px;
    padding:20px;
    font-size:18px;
    width:20%;
    display:inline-block;
    background:#F6F6F6;
    border:solid 1px #ccc;
    border-radius: 2px;
    font-width:normal;
}
.fa-file-text-o{
    color:#E54040;
}
.right_line{
    padding:20px 0px 10px 5px;
    font-size:15px;
    color:#E54040;
    cursor: pointer;
    line-height:20px;
}
.line_title{
    display:inline-block;
    vertical-align:top;
    font-width:bold;
}
.line_title_mouseover{
    color:#E57D7D;
}
.line_text{
    /*width:60%;*/
    min-width:135px;
    display:inline-block;
    vertical-align:top;
}
.author_style{
    color: gray;
}
/*right side css - END*/
* {
    margin: 0;
    padding: 0;
}

#iviewer {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: url('<?php echo site_url() ?>assets/templates/images/bg_transblack.png');
    display: none;
    z-index: 1;
}

#iviewer .controls {
    position: fixed;
    top: 0;
    right: 0;
    width: 40px;
}

#iviewer .controls li {
    float: right;
    clear: right;
    position: relative;
    width: 40px;
    height: 40px;
    background-repeat: no-repeat;
    background-position: center center;
    display: block;
    cursor: pointer;
    z-index: 3;
}

    #iviewer .controls:hover {
        cursor: pointer;
    }

    #iviewer .controls .close { background-image: url('<?php echo site_url() ?>assets/templates/images/btn_close.png'); }
    #iviewer .controls .zoomin { background-image: url('<?php echo site_url() ?>assets/templates/images/btn_zoomin.png'); }
    #iviewer .controls .zoomout { background-image: url('<?php echo site_url() ?>assets/templates/images/btn_zoomout.png'); }

#iviewer .info {
    position: fixed;
    bottom: 0;
    width: 100%;
    text-align: center;
    color: #ccc;
    font-size: 16px;
    padding: 0;
}

#iviewer .viewer {
    position: fixed;
    top: 0;
    left: 40px;
    z-index: 2;
    display: none;
}

#iviewer .loader {
    position: fixed;
    width: 100%;
    height: 100%;
    background: url('<?php echo site_url() ?>assets/templates/images/spinner.gif') no-repeat center center;
    z-index: 2;
}
</style>
</head>
<body>
<!-- 上方檔案 ↓ -->
<?php  $this->load->view('top') ?>
<!-- Navigation -->
<div id="nav" class="main_width"><div class="nav_mv">
You are in <a href="<?php echo site_url() ?> ">首頁</a>
<?php echo $breadcrumb.'&nbsp; &gt; &nbsp;'.$chapter_detail[0]->cp_key; ?>
</div></div>



<!-- 中間內容區 ↓ -->
<div class="sub">
    <div class="title"><?php echo $chapter_detail[0]->cp_key?>：<?php echo  $chapter_detail[0]->title?></div>
    <div class="sub_left">
        
        <div class="tag_list">
            <div id="content1" class="tag" onclick="javascript:location.href='#1'">原文</div>
            <div id="content2" class="tag" onclick="javascript:location.href='#2'">解析</div>
            <div id="content3" class="tag" onclick="javascript:location.href='#3'">範例</div>
            <div id="content4" class="tag" onclick="javascript:location.href='#4'">撰寫</div>
        </div>
        <div class="left_content content1">
            <?php echo  htmlspecialchars_decode($chapter_detail[0]->description) ?>
        </div>
        <div class="left_content content2" style="display:none;">
            <?php echo htmlspecialchars_decode($chapter_detail[0]->parse) ?>
        </div>
        <div class="left_content content3" style="display:none;">
            <?php foreach ($sample_list as $s_key => $s_value) {
                ?>
            <div class="content_block">
                <span class="author_style"><?php echo "the category (".htmlspecialchars_decode($s_value->kind_name).")" ?></span>
                <div class="content_title"><?php echo htmlspecialchars_decode($s_value->title); ?></div>
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
<!-- 內容 end -->
</div></div>
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

            }))

    
    
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

        

        });

    
        }
    );
    
    
</script>
<script type="text/javascript" src="<?php echo site_url() ?>assets/templates/js/initbox.js" ></script>