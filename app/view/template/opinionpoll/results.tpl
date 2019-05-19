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
					<h1>Poll Results</h1>
					<?php //echo '<pre>'.print_r($results, true).'</pre>'; ?>
					<?php foreach($results as $question) { ?>
						<p><?php echo $question['title']; ?>: (<b><?php echo $question['total_vote']; ?></b>)</p>
						<ul>
							<?php foreach($question['answers'] as $answer){ ?>
								<li><?php echo $answer['title']; ?>: <b><?php echo $answer['vote_count']; ?></b> Votes</li>
							<?php } ?>
						</ul>
					<?php } ?>
					<div class="buttons col-sm-8" >
			        	<div class="pull-left">
			            	<a href="<?php echo $back; ?>" class="btn btn-primary">Return to voting page</a>
			          	</div>
			        </div>
					
				</div>
			</div>
		</div>
	</div>
</body></html>
