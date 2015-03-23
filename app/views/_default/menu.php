<ul class="menu">
    <?php foreach($menuElements as $id => $element):?>
        <?php echo "<li><a href='" . DS . PROJECT_NAME . DS . strtolower($element["name"]) . "'>" . Q::translate($element["name"]) . "</a></li>"; ?>
    <?php endforeach;?>
</ul>
