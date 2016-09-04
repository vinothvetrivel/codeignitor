{include file="header.tpl"}
       <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <span class="navbar-brand"><a class="" href="{$BASEURL}{$EXE}"><img src="{$BASEURL}image/eatryt.png" alt="Eatryt" style="height:32px;"/></a></span></div>
            <div class="navbar-collapse collapse" style="height: 2px;"></div>
       </div>
    </div>
      {if !empty($errorMessage)}<div class="alert alert-danger" style="text-align:center;"><i class="fa fa-frown-o fa-2x">&nbsp;</i>{$errorMessage}</div>{/if}
      {if !empty($successMessage)}<div class="alert alert-success" style="text-align:center;"><i class="fa fa-smile-o fa-2x">&nbsp;</i>{$successMessage}</div>{/if} 
       <div class="dialog">
       <div class="panel panel-default">
               <p class="panel-heading no-collapse">Forgot Password</p>
              <div class="panel-body">
                  <form name="eatrytForm" id="eatrytForm" method="post" enctype="multipart/form-data" action="{$BASEURL}{$EXE}/forgotPassword/requestPassword" onsubmit="return common.validateProcess('{$processName}','eatrytForm','')">
                       <div class="form-group">
                           <label>Username</label>
                           <input type="text" class="form-control span12" name="username" id="username" data-role="MANDATORY" data-type="username" />
                           {if isset($error.username)}<p class="text-danger">{$error.username}</p>{else} {/if}
                       </div>
                       <input type="submit" name="formSubmit" class="btn btn-primary pull-right" value="Request" />
                       <div class="clearfix"></div>
                   </form>
               </div>
           </div>
           <p><a href="{$BASEURL}{$EXE}">Back to login Page</a></p>
       </div>
{include file="footer.tpl"}
