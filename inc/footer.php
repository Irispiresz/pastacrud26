    <hr>
</main> <!-- /container -->

<footer class="container">
    <?php $data = new DateTime("now", new DateTimeZone("America/Sao_Paulo")) ?>
    <p>&copy; 2025 à <?php echo $data->format("Y") ?> - Iris e Gi Salles</p>
</footer>

<!-- Bootstrap JS -->
<script src="<?php echo BASEURL; ?>js/awesome/all.min.js"></script>
<script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
<script>
const toggleSenha = document.getElementById("toggleSenha");
if (toggleSenha) {
    toggleSenha.addEventListener("click", function() {
        const campo = document.getElementById("pass");
        const icon = document.getElementById("iconSenha");

        if (!campo || !icon) return;

        if (campo.type === "password") {
            campo.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            campo.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    });
}
</script>

</body>
</html>

