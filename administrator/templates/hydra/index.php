<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.0
 */

defined('_JEXEC') or die;

/** @var JDocumentHtml $this */

$app   = JFactory::getApplication();
$lang  = JFactory::getLanguage();
$input = $app->input;
$user  = JFactory::getUser();


// Output as HTML5
$this->setHtml5(true);


// Gets the FrontEnd Main page Uri
$frontEndUri = JUri::getInstance(JUri::root());
$frontEndUri->setScheme(((int) $app->get('force_ssl', 0) === 2) ? 'https' : 'http');
$mainPageUri = $frontEndUri->toString();

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add filter polyfill for IE8
JHtml::_('behavior.polyfill', array('filter'), 'lte IE 9');

// Add template js
JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));

// Add custom js
JHtml::_('script', 'custom.js', array('version' => 'auto', 'relative' => true));

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Stylesheets
JHtml::_('stylesheet', 'template' . ($this->direction === 'rtl' ? '-rtl' : '') . '.css', array('version' => 'auto', 'relative' => true));

// Load specific language related CSS
JHtml::_('stylesheet', 'administrator/language/' . $lang->getTag() . '/' . $lang->getTag() . '.css', array('version' => 'auto'));

// Load custom.css
JHtml::_('stylesheet', 'custom.css', array('version' => 'auto', 'relative' => true));

// Add responsive.css
JHtml::_('stylesheet', 'responsive.css', array('version' => 'auto', 'relative' => true));

// Add icons
JHtml::_('stylesheet', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'https://use.fontawesome.com/releases/latest/js/all.js', array('version' => 'auto', 'relative' => true));


// Detecting Active Variables
$option   = $input->get('option', '');
$view     = $input->get('view', '');
$layout   = $input->get('layout', '');
$task     = $input->get('task', '');
$itemid   = $input->get('Itemid', 0, 'int');
$sitename = htmlspecialchars($app->get('sitename', ''), ENT_QUOTES, 'UTF-8');
$cpanel   = $option === 'com_cpanel';

$hidden = $app->input->get('hidemainmenu');

$showSubmenu          = false;
$this->submenumodules = JModuleHelper::getModules('submenu');

foreach ($this->submenumodules as $submenumodule)
{
	$output = JModuleHelper::renderModule($submenumodule);

	if ($output !== '')
	{
		$showSubmenu = true;
		break;
	}
}

// Template Parameters
$displayHeader = $this->params->get('displayHeader', '1');
$statusFixed   = $this->params->get('statusFixed', '1');
$stickyToolbar = $this->params->get('stickyToolbar', '1');

// Header classes
$navbar_color    = $this->params->get('templateColor') ?: '';
$header_color    = $displayHeader && $this->params->get('headerColor') ? $this->params->get('headerColor') : '';
$navbar_is_light = $navbar_color && colorIsLight($navbar_color);
$header_is_light = $header_color && colorIsLight($header_color);

if ($displayHeader)
{
	// Logo file
	if ($this->params->get('logoFile'))
	{
		$logo = JUri::root() . htmlspecialchars($this->params->get('logoFile'), ENT_QUOTES);
	}
	else
	{
		$logo = $this->baseurl . '/templates/' . $this->template . '/images/logo' . ($header_is_light ? '-inverse' : '') . '.png';
	}
}

function colorIsLight($color)
{
	$r = hexdec(substr($color, 1, 2));
	$g = hexdec(substr($color, 3, 2));
	$b = hexdec(substr($color, 5, 2));

	$yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

	return $yiq >= 200;
}

// Pass some values to javascript
$offset = 20;

if ($displayHeader || !$statusFixed)
{
	$offset = 30;
}

$stickyBar = 0;

if ($stickyToolbar)
{
	$stickyBar = 'true';
}

// Template color
if ($navbar_color)
{
	$this->addStyleDeclaration('
	.navbar-inner,
	.navbar-inverse .navbar-inner,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.navbar-inverse .nav li.dropdown.open > .dropdown-toggle,
	.navbar-inverse .nav li.dropdown.active > .dropdown-toggle,
	.navbar-inverse .nav li.dropdown.open.active > .dropdown-toggle,
	#status.status-top {
		background: ' . $navbar_color . ';
	}');
}

// Template header color
if ($header_color)
{
	$this->addStyleDeclaration('
	.header {
		background: ' . $header_color . ';
	}');
}

// Sidebar background color
if ($this->params->get('sidebarColor'))
{
	$this->addStyleDeclaration('
	.nav-list > .active > a,
	.nav-list > .active > a:hover {
		background: ' . $this->params->get('sidebarColor') . ';
	}');
}

// Link color
if ($this->params->get('linkColor'))
{
	$this->addStyleDeclaration('
	a,
	.j-toggle-sidebar-button {
		color: ' . $this->params->get('linkColor') . ';
	}');
}
/*
$app   = JFactory::getApplication();
$lang  = JFactory::getLanguage();
*/



    $language = $lang->getTag();

/*
if($language === 'en-gb'){
    $lang->setLanguage( $language );
    $lang->load();
}

if($language === 'de-de'){
    $lang->setLanguage( $language );
    $lang->load();
}
    */

    if($language = 'en-GB'){
        $lang->setLanguage( $language );
        $lang->load();
    }

    if($language = 'de-DE'){
        $lang->setLanguage( $language );
        $lang->load();
    }

    var_dump($user->groups);


foreach ($user->groups as $value) {
    echo $value;
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<jdoc:include type="head" />
</head>
<body class="admin <?php echo $option . ' view-' . $view . ' layout-' . $layout . ' task-' . $task . ' itemid-' . $itemid; ?>" data-basepath="<?php echo JURI::root(true); ?>">
<!-- Top Navigation -->
<div id="navbar" class="navbar navbar-dark bg-dark">
    <div class="img-container">
        <img src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/hydra.png'?>" alt="logo.png">
    </div>
    <div class="search-container">
        <div class="app-search">
            <form>
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="mdi mdi-magnify"></span>
                </div>
            </form>
        </div>
    </div>
    <div class="icon-container">
        <i class='fas fa-home' style='font-size:36px;color: white;'></i>
        <a href="https://google.de" target="_blank"><i class='fab fa-google-plus-g' style='font-size:36px;color: white;'></i></a>
        <i class="fa fa-sun-o" style="font-size:36px; color: white"></i>
        <i class="fa fa-user-o" style="font-size:36px; color: white"></i>
        <i class="fa fa-envelope-o" style="font-size:36px; color: white"></i>
    </div>
    <div class="login-container">
        <div class="sidebar-wrapper">
            <div class="sidebar-header">
                <div class="user-pic">
                    <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                         alt="User picture">
                </div>
                <div class="user-info">
          <span class="user-name">

            <strong><?php echo $user->get('username')?></strong>

          </span>
                    <span class="user-role">Administrator</span>
                    <span class="user-status">
            <i class="fa fa-circle" style="font-size: 13px;color:green;"></i>

            <span>Online</span>
          </span>
                </div>
            </div>
        </div>
    </div>
    <div class="logout-container">
        <ul class="nav nav-user<?php echo ($this->direction == 'rtl') ? ' pull-left' : ' pull-right'; ?>">
            <li class="dropdown">
                <a class="<?php echo ($hidden ? ' disabled' : 'dropdown-toggle'); ?>" data-toggle="<?php echo ($hidden ? '' : 'dropdown'); ?>" <?php echo ($hidden ? '' : 'href="#"'); ?>>
                    <i class="fa fa-genderless" style="font-size:36px;color: white;"></i>
                </a>
                <ul class="dropdown-menu">
                    <?php if (!$hidden) : ?>
                        <li>
                            <span>
                                <strong><?php echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'); ?></strong>
                            </span>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="index.php?option=com_admin&amp;task=profile.edit&amp;id=<?php echo $user->id; ?>"><?php echo JText::_('TPL_ISIS_EDIT_ACCOUNT'); ?></a>
                        </li>
                        <li class="divider"></li>
                        <li class="">
                            <a href="<?php echo JRoute::_('index.php?option=com_login&task=logout&' . JSession::getFormToken() . '=1'); ?>"><?php echo JText::_('TPL_ISIS_LOGOUT'); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
    </div>
</div>
<div id="menu">
<nav class="navbar<?php echo $navbar_is_light ? '' : ' navbar-inverse'; ?> navbar-fixed-top">
		<div class="container-fluid">
			<?php if ($this->params->get('admin_menus') != '0') : ?>
				<a href="#" class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
					<span class="element-invisible"><?php echo JTEXT::_('TPL_ISIS_TOGGLE_MENU'); ?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
			<?php endif; ?>

			<!-- skip to content -->
			<a class="element-invisible" href="#skiptarget"><?php echo JText::_('TPL_ISIS_SKIP_TO_MAIN_CONTENT'); ?></a>


			<a class="brand hidden-desktop hidden-tablet" href="<?php echo $mainPageUri; ?>" title="<?php echo JText::sprintf('TPL_ISIS_PREVIEW', $sitename); ?>" target="_blank"><?php echo JHtml::_('string.truncate', $sitename, 14, false, false); ?>
				<span class="icon-out-2 small"></span></a>

			<div<?php echo ($this->params->get('admin_menus') != '0') ? ' class="nav-collapse collapse"' : ''; ?>>
				<jdoc:include type="modules" name="menu" style="none" />
			</div>
			<!--/.nav-collapse -->
		</div>
</nav>
</div>
<!-- Header -->
<?php if ($displayHeader) : ?>

<!------ Header ------>
<?php endif; ?>
<?php if (!$statusFixed && $this->countModules('status')) : ?>
	<!-- Begin Status Module -->
	<div id="status" class="navbar status-top hidden-phone">
		<div class="btn-toolbar">
			<jdoc:include type="modules" name="status" style="no" />
		</div>
		<div class="clearfix"></div>
	</div>
	<!-- End Status Module -->
<?php endif; ?>
<?php if (!$cpanel) : ?>
	<!-- Subheader -->
	<a class="btn btn-subhead" data-toggle="collapse" data-target=".subhead-collapse"><?php echo JText::_('TPL_ISIS_TOOLBAR'); ?>
		<span class="icon-wrench"></span></a>
	<div class="subhead-collapse collapse" id="isisJsData" data-tmpl-sticky="<?php echo $stickyBar; ?>" data-tmpl-offset="<?php echo $offset; ?>">
		<div class="subhead">
			<div class="container-fluid">
				<div id="container-collapse" class="container-collapse"></div>
				<div class="row-fluid">
					<div class="span12">
						<!-- target for skip to content link -->
						<a id="skiptarget" class="element-invisible"><?php echo JText::_('TPL_ISIS_SKIP_TO_MAIN_CONTENT_HERE'); ?></a>
						<jdoc:include type="modules" name="toolbar" style="no" />
					</div>
				</div>
			</div>
		</div>
	</div>
<?php else : ?>
	<div style="margin-bottom: 20px">
		<!-- target for skip to content link -->
		<a id="skiptarget" class="element-invisible"><?php echo JText::_('TPL_ISIS_SKIP_TO_MAIN_CONTENT_HERE'); ?></a>
	</div>
<?php endif; ?>
<!-- container-fluid -->
<div class="container-fluid container-main">
	<section id="content">
		<!-- Begin Content -->
		<jdoc:include type="modules" name="top" style="xhtml" />
		<div class="row-fluid">
			<?php if ($showSubmenu) : ?>
			<div class="span2">
				<jdoc:include type="modules" name="submenu" style="none" />
			</div>
			<div class="span10">
				<?php else : ?>
				<div class="span12">
					<?php endif; ?>
					<jdoc:include type="message" />
					<jdoc:include type="component" />
				</div>
			</div>
			<?php if ($this->countModules('bottom')) : ?>
				<jdoc:include type="modules" name="bottom" style="xhtml" />
			<?php endif; ?>
			<!-- End Content -->
	</section>

	<?php if (!$this->countModules('status') || (!$statusFixed && $this->countModules('status'))) : ?>
		<footer class="footer">
			<p class="text-center">
				<jdoc:include type="modules" name="footer" style="no" />
				&copy; <?php echo $sitename; ?> <?php echo date('Y'); ?></p>
		</footer>
	<?php endif; ?>
</div>
<?php if ($statusFixed && $this->countModules('status')) : ?>
	<!-- Begin Status Module -->

			<!---- <jdoc:include type="modules" name="status" style="no" /> --->

	<!-- End Status Module -->
<?php endif; ?>
<jdoc:include type="modules" name="debug" style="none" />

<?php
/*
function onAfterInitialise()
{
    $app = &JFactory::getApplication();
    $lang =& JFactory::getLanguage();

    $language = $app->getUserStateFromRequest("plgSystemMultilingual.language", 'language', $lang->_default);
    $language = JRequest::getCmd('lang', $language);

    if ($language) {
        $lang->setLanguage( $language );
        $lang->load();
    }
}
*/



?>
</body>
</html>
