<?php if (isset($message)): ?>
    <script>
        alert("<?= htmlspecialchars($message) ?>");
    </script>
<?php endif; ?>
