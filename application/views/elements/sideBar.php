<div class="menu_section">
    <!-- <h3>General</h3> -->
    <ul class="nav side-menu">
        <li><a href=''><i class="fa fa-home"></i> Dashboard </a>
        </li>
        <h3>Operation</h3>
        <?php foreach ($listMenu as $row) { ?>
            <li><a href='#<?php echo $row->controller_name; ?>' onclick="menu('<?php echo $row->controller_name; ?>')"><i class="fa <?php echo $row->script; ?>"></i> <?php echo $row->menu_title; ?> </a>
            </li>
        <?php } ?>
    </ul>
</div>