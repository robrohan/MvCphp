<p>Welcome to the MvCphp Framework.</p>

<p>To get started you might want to read 
<a href="http://thoth.robrohan.com/client/index.cfm/2006/11/9/Simple-MVC-PHP-Framework">this</a> 
post on how the whole framework goes
together (<a href="http://thoth.robrohan.com/client/index.cfm/2007/1/9/Simple-MVC-PHP-Framework-15">here</a>
is a follow up posting as well).</p>

<p>To get started you'll probably want to edit the file <i>AppCore/Settings.php</i>. This
file contains all the framework settings. The ones you'll likely want to mess with
are the follow:</p>

<p class="code">
$USING_REWRITE - if you want SEF URLs and have mod_rewrite turned on.<br />
$DB_USER, $DB_PASS, $DB_NAME, and $DB_HOST for database access. <br />
</p>

<p>And later on you'll probably want to change the following:</p>

<p class="code">
$APP_DEBUG - To turn off all the debug output, and trancing<br />
$APP_STATE - To toggle settings between servers<br />
</p>
