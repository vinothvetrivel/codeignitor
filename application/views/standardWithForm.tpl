{include file="header.tpl"}
  <!-- Sticky header navigation-->
  {include file="headerNavigation.tpl"}
  <!-- Side Bar -->
  {include file="sideMenu.tpl"}

   	<div class="content">
	    <div class="header">
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
    		<form name="eatrytForm" id="eatrytForm" method="post" enctype="multipart/form-data" action="{$BASEURL}{$EXE}{$postUrl}" onsubmit="return common.validateProcess('{$processName}','eatrytForm','{$methodName}')">
    			{include file="$template"}
    		</form>
    		</div>
	    	<footer>
	          <hr>
	          <p>© 2016 <a href="{$BASEURL}{$EXE}">eatryt</a></p>
	      </footer>
	    </div>
  	</div>
{include file="footer.tpl"}