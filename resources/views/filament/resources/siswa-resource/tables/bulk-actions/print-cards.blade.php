<script>
    document.addEventListener('DOMContentLoaded', function () {
        @this.on('bulkActionExecuted', response => {
            if (response.url) {
                window.open(response.url, '_blank');
            }
        });
    });
</script>
