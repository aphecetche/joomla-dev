<?php
// No direct access.
defined('_JEXEC') or die;

function getBannerImageName() 
{
  $db =& JFactory::getDBO();
  $thisArticle=JRequest::getInt('id');
  $query = 'SELECT title FROM #__categories WHERE id IN (SELECT catid from #__content WHERE id = ' . $thisArticle . ')';
  $db->setQuery($query, 0, 1);
  $categoryName = $db->loadResult();
  $searchDir = 'images/bandeaux/' . $categoryName;
  if ( JFolder::exists($searchDir) )
  {
    $files=JFolder::files($searchDir,'(.jpg|.JPG)', false, true);
    if ( count($files) > 0 )
    {
      $id = rand(0,count($files)-1);
      return $files[$id];
    }
  }
  
  return 'images/bandeaux/plasma/001.jpg';
}

// check modules
$showRightColumn   = ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
$showbottom        = ($this->countModules('position-9') or $this->countModules('position-10') or $this->countModules('position-11') or $this->countModules('position-14'));
$showleft          = ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));

jimport('joomla.environment.browser');

$browser = &JBrowser::getInstance();
        
if ($showRightColumn==0 and $showleft==0) {
        $showno = 0;
}

JHtml::_('behavior.framework', true);

// get params
$app                = JFactory::getApplication();
$body = '';
  $user =& JFactory::getUser();
  $userGroups = $user->getAuthorisedGroups();
  if (count($userGroups))
  {
    rsort($userGroups);
    foreach ( $userGroups as $groupId )
    {
      $db =& JFactory::getDBO();
      $query = 'SELECT title FROM #__usergroups WHERE id = ' . $groupId;
      $db->setQuery($query,0,1);
      $groupName = $db->loadResult();
      $body .= 'group-' . $groupName;
      break;
    }
  }
$doc        = JFactory::getDocument();
$templateparams     = $app->getTemplate(true)->params;
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/subatech2/css/screen.css" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/subatech2/css/print.css" type="text/css" media="print" />
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<body class="<?php echo $body;?>">

<div id="all">
  <div id="back">
    <div id="header">
      
      <div id="logo">
      <ul>
      <li>
        <a href="<?php echo $this->baseurl ?>" class="logo"><img src="<?php echo $this->baseurl ?>/templates/subatech2/images/logo_subatech.png"/></a>
      </li>
      <li>
      <ul>
      <li><jdoc:include type="modules" name="logofooter" /></li>
      </ul>
      </li>
      </ul>
        </div>
        
      <div id="textheader">
	    <h1>Laboratoire de physique subatomique et des technologies associées</h1>
        <jdoc:include type="modules" name="topmenu" />
      </div>
      <!-- end logoheader -->
      <jdoc:include type="modules" name="position-1" />
      <div id="bannerimage">                                    
        <?php if ( substr_count($this->toString(),"JDocument") ) : ?>
          <img src="<?php echo $this->baseurl.'/'.getBannerImageName() ?>" width="100%" />
        <?php endif; ?>
      </div>
      <div id="line">
        <jdoc:include type="modules" name="position-0" />
      </div> <!-- end line -->
        </div> 
        <!-- end header -->
        
        <div id="<?php echo $showRightColumn ? 'contentarea2' : 'contentarea'; ?>">
      <div id="breadcrumbs">
        <jdoc:include type="modules" name="position-2" />
      </div>
       <?php if ($showleft) : ?>
        <div class="left1 <?php if ($showRightColumn==NULL){ echo 'leftbigger';} ?>" id="nav">
          <jdoc:include type="modules" name="position-7" style="beezDivision" headerLevel="3" />
          <jdoc:include type="modules" name="position-4" style="beezHide" headerLevel="3" state="0 " />
          <jdoc:include type="modules" name="position-5" style="beezTabs" headerLevel="2"  id="3" />
        </div>
        <!-- end navi -->
            <?php endif; ?>
      <div id="<?php echo $showRightColumn ? 'wrapper' : 'wrapper2'; ?>" <?php if (isset($showno)){echo 'class="shownocolumns"';}?>>
      <div id="main">
        <?php if ($this->countModules('position-12')): ?>
          <div id="top"><jdoc:include type="modules" name="position-12"   />
          </div>
        <?php endif; ?>
        <jdoc:include type="message" />
        <jdoc:include type="component" />
            </div>
            <!-- end main -->
    </div><!-- end wrapper -->

    <?php if ($showRightColumn) : ?>
      <div id="right">
        <jdoc:include type="modules" name="position-6" style="beezDivision" headerLevel="3"/>
        <jdoc:include type="modules" name="position-8" style="beezDivision" headerLevel="3"  />
        <jdoc:include type="modules" name="position-3" style="beezDivision" headerLevel="3"  />
      </div>
      <!-- end right -->
    <?php endif; ?>

        </div> <!-- end contentarea -->

    <div id="footer">
      <div id="footer-logos">
         <jdoc:include type="modules" name="position-10" />
       </div>
      <div id="footer-all-width">
        <jdoc:include type="modules" name="position-11" />
      </div>
    </div>
  </div>
  <!-- back -->
</div>

<!-- all -->

<div id="endnote">
  <jdoc:include type="modules" name="position-13" />
  <p><?php echo $browser->getAgentString(); ?></p>
</div>

<jdoc:include type="modules" name="debug" />

</body>
</html>

