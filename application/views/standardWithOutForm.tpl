{include file="header.tpl"}
  <!-- Sticky header navigation-->
  {include file="headerNavigation.tpl"}
  <!-- Side Bar -->
  {include file="sideMenu.tpl"}

   	<div class="content">
	    <div class="header">
	      <!--<div class="stats">
	        <p class="stat"><span class="label label-info">5</span> Tickets</p>
	        <p class="stat"><span class="label label-success">27</span> Tasks</p>
	        <p class="stat"><span class="label label-danger">15</span> Overdue</p>
	      </div>-->
	      	{if !empty($errorMessage)}<div class="alert alert-danger" style="text-align:center;"><i class="fa fa-frown-o fa-2x">&nbsp;</i>{$errorMessage}</div>{/if}
      		{if !empty($successMessage)}<div class="alert alert-success" style="text-align:center;"><i class="fa fa-smile-o fa-2x">&nbsp;</i>{$successMessage}</div>{/if}
	      <h1 class="page-title">Dashboard</h1>
	      <ul class="breadcrumb">
	        <li><a href="index.html">Home</a> </li>
	        <li class="active">Dashboard</li>
	      </ul>
	    </div>
    	<div class="main-content">
    		{include file="$template"}
	    	<footer>
	          <hr>
	          <p>© 2016 <a href="{$BASEURL}index.php">eatryt</a></p>
	      </footer>
	    </div>
  	</div>
{include file="footer.tpl"}