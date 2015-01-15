<?php echo css($this->config->item('cpinput_css'), 'cpinput')?> 

<section class="wrapper" style="margin:0px">
	<div class="row" style="margin:10px 10px">
	    <div class="col-md-2 sheader"><h4><?php echo $view_name?></h4></div>
	    <div class="col-md-10 sheader"></div>
	</div>

	<div class="row" style="margin:10px 10px">
		<div class="span12">
			<ul class="breadcrumb">
			  <li>位置：<a href="<?php echo $module_uri?>">撰寫管理</a></li>
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
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">對應章節</label>
							<div class="col-sm-4"> 
								<input type="text" class="form-control" name="cp_key" id="cp_key" value="">  
								<select disabled name="cp_id" id="cp_id" >
									<?php
										if(isset($chapter)):
									?>	
									<?php   foreach($chapter as $key=>$rows):?>
												<option value="<?php echo $rows->id ?>" <?php if ($record->cp_id == $rows->id): ?>
											selected
										<?php endif ?>><?php echo $rows->cp_key." ".$rows->title ?></option>
										<?php endforeach;?>
									<?php endif;?>
								</select> 
							</div>
						</div>	    
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">主旨</label>
							<div class="col-sm-4">
								<input disabled type="text" class="form-control" name="title" value="<?php echo $record->title; ?>"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">說明</label>
							<div class="col-sm-8"> 
								<textarea disabled class="ckeditor" rows="10" name="content" id="content"><?php echo htmlspecialchars_decode($record->content); ?></textarea>
							</div>
						</div>	 				  
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">檔案</label>
							<div class="col-sm-4"> 
								<a href="<?php echo site_url()."assets/".$record->file_name; ?>" ></a>
							</div>
						</div>	 				  
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">作者</label>
							<div class="col-sm-4"> 
								<input disabled type="text" class="form-control" value="<?php echo $record->author ?>">  								
							</div>
						</div>	
						<div class="form-group">
							<div class="col-sm-12" style="text-align:center">
								<button type="button" class="btn btn-danger" onClick="aHover('<?php echo $module_uri?>')">取消</button>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

</section>
<!-- Tab panes -->

<?php echo js($this->config->item('cpinput_javascript'), 'cpinput')?>
<?php echo js($this->config->item('cpinput_ck_javascript'), 'cpinput')?>
 
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

	    $("#cp_id").trigger('change');

	});
</script>