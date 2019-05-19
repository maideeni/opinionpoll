<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Opinion Poll</title>
<base href="<?php echo $base; ?>" />

<meta name="description" content="opinion poll" />

<meta name="keywords" content= "opinion poll" />

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link href="app/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="app/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

</head>
<body>
	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-12">
					<h1>Opinion Poll</h1>
					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
						<?php //echo '<pre>'.print_r($questions, true).'</pre>'; ?>
						<?php //echo '<pre>'.print_r($error, true).'</pre>'; ?>
						<?php //echo '<pre>'.print_r($vote, true).'</pre>'; ?>

						<?php foreach($questions as $question){ ?>
							<div class="form-group required">
								<div class="radio">
									<label class="col-sm-5 control-label" for="input-question<?php echo $question['question_id']; ?>"><?php echo $question['title']; ?></label>
									<div class="col-sm-5">
										<?php foreach($question['answers'] as $answer) { ?>
					                	<input type="radio" name="vote[<?php echo $question['question_id']; ?>]" value="<?php echo $answer['answer_id']; ?>" <?php if(isset($vote[$question['question_id']]) && $vote[$question['question_id']] == $answer['answer_id']) { ?> checked="checked" <?php } ?> /> <?php echo $answer['title']; ?><br />
					                	<?php } ?>
					                	<?php if (isset($error[$question['question_id']])) { ?>
							              <div class="text-danger"><?php echo $error[$question['question_id']]; ?></div>
							            <?php } ?>
						            </div>
					            </div>
							</div>
						<?php } ?>
						<div class="buttons col-sm-8" >
							<div class="pull-left">
				            	<a href="<?php echo $result; ?>" class="btn btn-primary">Results</a>
				          	</div>
				        	<div class="pull-right">
				            	<input type="submit" value="Vote" class="btn btn-primary" />
				          	</div>
				        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body></html>
