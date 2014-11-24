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
<script type="text/javascript" src="<?php echo site_url() ?>assets/templates/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo site_url() ?>assets/templates/js/jqueryUI-1.11.1.js"></script>
<style>
.sub{
    width:90%;
    max-width:1200px;
    margin: 5px 75px;
}

/*left side css*/
.sub_left{
    min-width:550px;
    margin:10px 20px 0 0;
    width:70%;
    display:inline-block;
    vertical-align:top;
}
.left_title{
    font-size:20px;
    line-height:30px;
    margin:5px 0 20px 5px;

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
    min-width:550px;
    margin:5px 0 10px 0;
    border-top:solid 1px #ccc;
    padding-top:10px;
    line-height:35px;
}
.content_title{
    font-size:20px;
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
/*left side css - END*/

/*right side css*/
.sub_right{
    min-width:200px;
    margin:200px 0px 20px 20px;
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
/*right side css - END*/

</style>
</head>
<body>
<!-- 上方檔案 ↓ -->
<?php  $this->load->view('top') ?>
<!-- Navigation -->
<div id="nav" class="main_width"><div class="nav_mv">
You are in <a href="<?php echo site_url() ?> ">首頁</a>
<?php echo $breadcrumb.'&gt;'.$chapter_detail[0]->cp_key; ?>
</div></div>



<!-- 中間內容區 ↓ -->
<div class="sub">
    <div class="sub_left">
        <div class="left_title"><?php echo $chapter_detail[0]->cp_key?>：<?php echo  $chapter_detail[0]->title?></div>
        <div class="tag_list">
            <div id="content1" class="tag tag_click">原文</div>
            <div id="content2" class="tag">解析</div>
            <div id="content3" class="tag">範例</div>
            <div id="content4" class="tag">撰寫</div>
        </div>
        <div class="left_content content1">
            <?php echo  htmlspecialchars_decode($chapter_detail[0]->description) ?>
        </div>
        <div class="left_content content2" style="display:none;">
            <?php echo htmlspecialchars_decode($chapter_detail[0]->parse) ?>
        </div>
        <div class="left_content content3" style="display:none;">
            <?php echo htmlspecialchars_decode($chapter_detail[0]->sample_content) ?>
        </div>
        <div class="left_content content4" style="display:none;">
            <div class="content_block">
                <div class="content_title">彙編要領</div>
                <div class="content_detail">銷售淨額等於產品和服務銷售總額減去銷貨退回、折扣及折讓金融投資收入包括金融貸款的利息、股東的股利收入、專利使用費及來自資產產生的直接收益（例如：資產租賃）等現金收入資產銷售收入包括有形資產（例如：房地產、基礎設施、設備）和無形資產（例如：智慧財產權、設計和品牌）</div>
            </div>
            <div class="content_block">
                <div class="content_title">收入</div>
                <div class="content_detail">為購買原物料、產品零件、場地設施及服務而發生於組織外的現金支出。包括租金、牌照費、場地設備使用費（因為這些費用具有明確的商業目的）、專利使用費、外包勞務費、員工教育訓練費用（若使用了外部培訓專家），或員工防護服裝費用等。</div>
            </div>
            <div class="content_block">
                <div class="content_title">營運成本</div>
                <div class="content_detail">為購買原物料、產品零件、場地設施及服務而發生於組織外的現金支出。包括租金、牌照費、場地設備使用費（因為這些費用具有明確的商業目的）、專利使用費、外包勞務費、員工教育訓練費用（若使用了外部培訓專家），或員工防護服裝費用等。</div>
            </div>
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
<!-- 內容 end -->
</div></div>
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
    
    
    
    
</script>