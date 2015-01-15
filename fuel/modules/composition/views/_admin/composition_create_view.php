<?php echo css($this->config->item('chapter_css'), 'chapter')?> 

<section class="wrapper" style="margin:0px">
	<div class="row" style="margin:10px 10px">
	    <div class="col-md-2 sheader"><h4>新增</h4></div>
	    <div class="col-md-10 sheader"></div>
	</div>

	<div class="row" style="margin:10px 10px">
		<div class="span12">
			<ul class="breadcrumb">
			  <li>位置：<a href="<?php echo $module_uri?>">章節管理</a></li>
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
							<label class="col-sm-2 col-sm-2 control-label">章節分類</label>
							<div class="col-sm-4">
								<select name="cp_kind">
									<?php
										if(isset($chapter)):
									?>	
									<?php   foreach($chapter as $key=>$rows):?>
												<option value="<?php echo $rows->code_id ?>"><?php echo $rows->code_name ?></option>
										<?php endforeach;?>
									<?php endif;?>
								</select>
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">章節代號</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="cp_key" value=""> 
							</div>
						</div>    
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">主旨</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="title" value=""> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">原文</label>
							<div class="col-sm-8"> 
								<textarea class="ckeditor" rows="10" name="description" id="description"></textarea>
							</div>
						</div>	
						<div class="form-group" style="display:none">
							<label class="col-sm-2 col-sm-2 control-label">解析</label>
							<div class="col-sm-8"> 
								<textarea class="ckeditor" rows="10" name="parse" id="parse"></textarea>
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

<?php echo js($this->config->item('chapter_javascript'), 'chapter')?>
<?php echo js($this->config->item('chapter_ck_javascript'), 'chapter')?>
 
<script>
	function aHover(url)
	{
		location.href = url;
	}

	
</script>