<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 
 Boostrap template: http://bootswatch.com/cosmo/
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Old Guys vs. Young Studs
	</title>
	<?php
		echo $this->Html->meta('favicon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('styles');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<?
		echo $this->Html->script('bootstrap.min');
	?>
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h1>Old Guys vs. Young Studs</h1>
		</div>
		<div class="navbar navbar-inverse">
		    <div class="navbar-inner">
		      <div class="container" style="width: auto;">
		        <div class="nav-collapse">
		          <ul class="nav">
		            <li class="active"><a href="/">Home</a></li>
		            <li><a href="http://football.fantasysports.yahoo.com/f1/381794" target="_blank">Yahoo Fantasy League</a></li>
		          </ul>
		          <ul class="nav pull-right">
		            <li class="dropdown">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
		              <ul class="dropdown-menu">
		                <li><a href="/scores/retrieve">Get Scores</a></li>
			            <li><a href="/schedules/updateSchedule">Update Schedule</a></li>
			            <li><a href="/teams/updateScores">Update Team Scores</a></li>
			          </ul>
		            </li>
		          </ul>
		        </div><!-- /.nav-collapse -->
		      </div>
		    </div><!-- /navbar-inner -->
		  </div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<hr />
		<footer id="footer">
	        <p class="pull-right"><a href="#">Back to top</a></p>
	        <div class="links">
	        </div>
	        Made by <a target="_blank" href="http://www.thetimbanks.com">Tim Banks</a>. Contact him <a href="mailto:thetimbanks@gmail.com">thetimbanks@gmail.com</a>.<br>
	        Hosted on <a target="_blank" href="http://www.github.com/">GitHub</a>.
      </footer>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
