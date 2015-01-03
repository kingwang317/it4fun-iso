<?php echo css($this->config->item('sample_css'), 'sample')?>  
<section class="wrapper" style="margin:0px">
	<div class="row" style="margin:10px 10px">
	    <div class="col-md-2 sheader"><h4>新增</h4></div>
	    <div class="col-md-10 sheader"></div>
	</div>

	<div class="row" style="margin:10px 10px">
		<div class="span12">
			<ul class="breadcrumb">
			  <li>位置：<a href="<?php echo $module_uri?>">範例管理</a></li>
			  <li class="active"><?php echo $view_name?></li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					<?php echo $view_name?>
				</header>
				<div class="panel-body">
					<div class="form-horizontal tasi-form">	
						<input type="hidden" value="-1" name="cps_kind" />
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">對應章節</label>
							<div class="col-sm-4"> 
								<input type="text" class="form-control" name="cp_key" id="cp_key" <?php if (isset($cp_key)): ?>
									value="<?php echo $cp_key ?>"
								<?php endif ?> >  
								<select name="cp_id" id="cp_id" >
									<?php
										if(isset($chapter)):
									?>	
									<?php   foreach($chapter as $key=>$rows):?>
												<option value="<?php echo $rows->id ?>"><?php echo $rows->cp_key." ".$rows->title ?></option>
										<?php endforeach;?>
									<?php endif;?>
								</select> 
							</div>
						</div>	     
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">主旨</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="title" value=""> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">解析內容</label>
							<div class="col-sm-8"> 
								<textarea class="form-control" rows="10" name="content" id="content"></textarea>
							</div>
						</div>	 				  
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">檔案</label>
							<div class="col-sm-4">
								<input type="file" class="form-control" name="file_name" value=""> 
							</div>
						</div>	
						<div class="form-group">
							<div class="col-sm-12" style="text-align:center">
								<button type="submit" class="btn btn-info">新增</button>
								<button type="button" class="btn btn-danger" onClick="aHover('<?php echo $module_uri?>')">取消</button>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

</section>

<?php echo js($this->config->item('sample_javascript'), 'sample')?>
<?php echo js($this->config->item('sample_ck_javascript'), 'sample')?>
 
<script>
	function aHover(url)
	{
		location.href = url;
	}
 

	jQuery(document).ready(function($) {
	 
	    $("#cp_key").blur(function() {
	     
	        $("#cp_id option:contains('" + $(this).val() + "')").attr("selected", true);
	    });

	    $("#cp_id").change(function() { 
	    	// console.log($(this).find("option:selected").text()); 
	    	var selectedValue = $(this).find("option:selected").text();
	    	var ary = selectedValue.split(" ");
	    	$("#cp_key").val(ary[0]);
	    })

	    $("#cp_key").trigger('blur');

	    var config =
            {
                height: 380,
                width: 850,
                linkShowAdvancedTab: false,
                scayt_autoStartup: false,
                enterMode: Number(2),
                toolbar_Full: [
                				[ 'Styles', 'Format', 'Font', 'FontSize', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ],
                				['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList'],
                                ['Link', 'Unlink'], ['Undo', 'Redo', '-', 'SelectAll'], [ 'TextColor', 'BGColor' ],['Checkbox', 'Radio', 'Image' ], ['Source']
                              ]

            };
		$( 'textarea#content' ).ckeditor(config);

	});
</script>