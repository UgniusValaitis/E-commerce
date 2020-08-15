<footer>
<?php require_once $pathGet . "contacts.get.php";?>
        <?php if (!isset($_GET['url']) && count($subsActive) > 0 || isset($_GET['url']) && $_GET['url'] == "contacts" && count($subsActive) > 0 || isset($_GET['url']) && $_GET['url'] == "services" && count($subsActive) > 0): ?>
        <div id="subscribe">
            <a href="<?php echo $rootDir . "?url=subscriptions" ?>" class="primaryBtn"><?php echo $lang['Subscriptions'] ?> <i class="fas fa-chevron-right"></i></a>
        </div>
        <?php endif;?>
        <div id="fixedFooter">

            <div id="footerNav">
                <div class="footerNavItem">
                    <a href="<?php echo $rootDir; ?>"><?php echo $lang['Home'] ?></a>
                    <a href="<?php echo $rootDir . "?url=services"; ?>"><?php echo $lang['Services'] ?></a>
                </div>
                <div class="footerNavItem">
                    <a href="<?php echo $rootDir . "?url=shop"; ?>"><?php echo $lang['Shop'] ?></a>
                    <a href="<?php echo $rootDir . "?url=courses"; ?>"><?php echo $lang['Courses'] ?></a>
                </div>
                <div class="footerNavItem">
                    <a href="<?php echo $rootDir . "?url=contacts"; ?>"><?php echo $lang['Contacts'] ?> :</a>
                    <?php foreach ($contacts as $con): ?>
                        <?php if ($con['location'] == 'email'): ?>
                        <p><?php echo $con['title'] ?></p>
                        <?php elseif ($con['location'] == 'number'): ?>
                        <p><?php echo $con['title'] ?></p>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>
            </div>
            <div id="footer">
                <p>Copyright &copy; 2020 Ugnius Valaitis.</p>
            </div>
        </div>
</footer>
<script src="../app/js/nav.js"></script>