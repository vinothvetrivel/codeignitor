<div class="sidebar-nav">
  <ul>
    {assign var=url value="{$BASEURL}{$EXE}"} 
    {create_menu_string inputArray=$menu url=$url checkReference="Y"}
  </ul>
</div>