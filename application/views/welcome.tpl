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
               <p class="panel-heading no-collapse">Sign In</p>
              <div class="panel-body">
                  <form name="eatrytForm" id="eatrytForm" method="post" enctype="multipart/form-data" onsubmit="" action="{$BASEURL}{$EXE}/authenticate">
                       <div class="form-group">
                           <label>Username</label>
                           <input type="text" class="form-control span12" name="username" id="username" />
                           {if isset($error.username)}<p class="text-danger">{$error.username}</p>{else} {/if}
                       </div>
                       <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control^Ospan12 form-control" name="userPassword" id="userPassword" />
                          {if isset($error.userPassword)}<p class="text-danger">{$error.userPassword}</p>{else} {/if}
                       </div>
                       <input type="submit" name="formSubmit" class="btn btn-primary pull-right" value="Sign In" />
                       <label class="remember-me"><input type="checkbox"> Remember me</label>
                       <div class="clearfix"></div>
                   </form>
               </div>
           </div>
           <p><a href="{$BASEURL}{$EXE}/forgotPassword">Forgot your password?</a></p>
       </div>
{include file="footer.tpl"}
