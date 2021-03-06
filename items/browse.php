<?php
$db = get_db();
$itemTypeName = '';
$extra = '';
if($itemTypeId = Zend_Controller_Front::getInstance()->getRequest()->getParam('type')) { 
    $extra = '';
    if(is_numeric($itemTypeId)) {
        $itemTypeName = $db->getTable('ItemType')->find($itemTypeId)->name;
    } else {
        $itemTypeName = $itemTypeId;
    }
    if($itemTypeName == 'people') {
        $title = ucfirst($itemTypeName);
        queue_js_file('people');
    } else {
        $title = ucfirst($itemTypeName) . 's';
    }
} else {
    if(isset($_GET['advanced'][0]['terms'])) {
        $title = $_GET['advanced'][0]['terms'] . ' Items';
    } else {
        $title = 'Browse Items';
    }
}

echo head(array('title'=>$title,'bodyclass' => 'items browse ' . $itemTypeName . ' ' . $extra));
?>

<?php if($itemTypeName == 'event'): ?>

    <?php include('events.php'); ?>
    
<?php elseif($itemTypeName == 'people'): ?>

    <?php include('people-image.php'); ?>
    
<?php elseif(isset($_GET['tags'])): ?>

    <?php include('tags.php'); ?>

<?php else: ?>

    <?php include('default.php'); ?>

<?php endif; ?>

<?php echo foot(); ?>
