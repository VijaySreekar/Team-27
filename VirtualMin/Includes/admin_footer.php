<footer class="footer pt-5">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-12">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="" class="nav-link pe-0 text-muted" target="_blank">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link pe-0 text-muted" target="_blank">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link pe-0 text-muted" target="_blank">Service</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link pe-0 text-muted" target="_blank">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

    </main>
    <script src="../../Assets/JS/jquery-3.7.1.js"></script>
    <script src="../../Assets/JS/bootstrap.bundle.min.js"></script>
    <script src="../../Assets/JS/perfect-scrollbar.min.js"></script>
    <script src="../../Asserts/JS/smooth-scrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../Assets/JS/custom.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>

        <?php if(isset($_SESSION['message'])) { ?>
        alertify.set('notifier','position', 'top-right');
        alertify.success('<?php echo $_SESSION['message']; ?>');
        <?php } ?>
    </script>

</body>
</html>