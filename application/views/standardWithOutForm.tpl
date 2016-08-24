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
	      <h1 class="page-title">{$title}</h1>
	      {if !empty($breadCrumb)}
	      <ul class="breadcrumb">
	        <li><a href="{$BASEURL}{$EXE}">Home</a> </li>
	        {foreach from=$breadCrumb item=v key=k}
	        <li>{if !empty($v)}<a href="{$BASEURL}{$EXE}{$v}">{$k|ucfirst}</a>{else}{$k|ucfirst}{/if}</li>
	        {/foreach}
	      </ul>
	      {/if}
	    </div>
    	<div class="main-content">
    		<div class="rightcontainer" style="min-height:620px;">
    		{include file="$template"}
    		</div>
	    	<footer>
	          <hr>
	          <p>© 2016 <a href="{$BASEURL}index.php">eatryt</a></p>
	      </footer>
	    </div>
  	</div>
{include file="footer.tpl"}