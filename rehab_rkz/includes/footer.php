<?php if(isset($_SESSION['user_id'])): ?>
            </main>
        </div>
    </div>
<?php else: ?>
    </div>
<?php endif; ?>

<!-- Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<!-- SweetAlert2 (Local for alerts) -->
<script src="<?= $base_url ?>/assets/vendor/js/sweetalert2.all.min.js"></script>
<script src="<?= $base_url ?>/assets/vendor/js/jquery.min.js"></script>

<script>
    lucide.createIcons();
    <?php if(isset($_SESSION['user_id'])): ?>
    const sidebar = document.getElementById('main-sidebar');
    const toggleBtn = document.getElementById('toggle-sidebar');
    const toggleIcon = document.getElementById('toggle-icon');
    const textElements = document.querySelectorAll('.sidebar-text');
    let isCollapsed = false;

    toggleBtn.addEventListener('click', () => {
        isCollapsed = !isCollapsed;
        if (isCollapsed) {
            sidebar.classList.remove('w-72');
            sidebar.classList.add('w-20');
            textElements.forEach(el => el.classList.add('hidden'));
            toggleIcon.setAttribute('data-lucide', 'panel-left-open');
        } else {
            sidebar.classList.remove('w-20');
            sidebar.classList.add('w-72');
            textElements.forEach(el => el.classList.remove('hidden'));
            toggleIcon.setAttribute('data-lucide', 'panel-left-close');
        }
        lucide.createIcons();
    });
    <?php endif; ?>
</script>
<?= isset($extra_js) ? $extra_js : '' ?>
</body>
</html>
