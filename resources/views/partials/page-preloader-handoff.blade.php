<script>
    (function () {
        var key = 'rr-page-preloader-handoff';
        if (window.location.pathname !== '/') return;

        var startedAt = Number(window.sessionStorage.getItem(key));
        window.sessionStorage.removeItem(key);

        if (!Number.isFinite(startedAt) || startedAt > Date.now() || Date.now() - startedAt > 15000) return;

        document.documentElement.setAttribute('data-rr-page-preloader-handoff', '');
        window.__RRPagePreloaderHandoffAt = startedAt;
    })();
</script>
