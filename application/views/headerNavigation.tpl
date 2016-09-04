<div class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <span class="navbar-brand"><a class="" href="{$BASEURL}{$EXE}"><img src="{$BASEURL}image/eatryt.png" alt="Eatryt" style="height:32px;"/></a></span>
  </div>

  <div class="navbar-collapse collapse" style="height: 1px;">
    <ul id="main-menu" class="nav navbar-nav navbar-right">
      <li class="dropdown hidden-xs">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> {$smarty.session.firstname|ucfirst}
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu">
          <li><a href="javascript:;" onclick="common.call('{$BASEURL}{$EXE}/user/view/{$smarty.session.user_id}','','popup');">My Account</a></li>
          <li class="divider"></li>
          <li><a tabindex="-1" href="{$BASEURL}{$EXE}/logout">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>