<div id="header-title">
    <?php echo Q::translate("Home"); ?>
</div>
<div id="content-wrapper">
    <?php foreach($data["text"] as $value): ?>
        <div id="content">
            <?php echo $value["text"];?>
        </div>
    <?php endforeach ?>
</div>

