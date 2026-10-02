/* Consistent loading feedback for regular form submissions and AJAX actions. */
(function () {
  var minimumPreloaderDuration = 4200;
  var preloader = document.querySelector('[data-rr-page-preloader]');

  if (preloader) {
    var message = preloader.querySelector('[data-rr-page-preloader-message]');
    var showOnLoad = preloader.hasAttribute('data-rr-page-preloader-on-load');
    var handoffKey = 'rr-page-preloader-handoff';
    var transitionTimeout;
    var finishTimeout;
    var loadTimeout;
    var visibleSince = showOnLoad ? (window.__RRPagePreloaderHandoffAt || Date.now()) : 0;

    if (showOnLoad) document.body.classList.add('rr-page-transition-active');

    function hidePreloader() {
      window.clearTimeout(transitionTimeout);
      window.clearTimeout(loadTimeout);
      var remaining = minimumPreloaderDuration - (Date.now() - visibleSince);

      if (remaining > 0) {
        window.clearTimeout(finishTimeout);
        finishTimeout = window.setTimeout(finishHiding, remaining);
        return;
      }

      finishHiding();
    }

    function finishHiding() {
      window.clearTimeout(finishTimeout);
      document.body.classList.remove('rr-page-transition-active');
      preloader.classList.remove('rr-page-preloader--animating');
      preloader.setAttribute('aria-hidden', 'true');
    }

    function showPreloader(nextMessage) {
      if (nextMessage && message) message.textContent = nextMessage;
      visibleSince = Date.now();
      window.clearTimeout(finishTimeout);
      preloader.classList.remove('rr-page-preloader--animating');
      void preloader.offsetWidth;
      preloader.classList.add('rr-page-preloader--animating');
      preloader.setAttribute('aria-hidden', 'false');
      document.body.classList.add('rr-page-transition-active');

      window.clearTimeout(transitionTimeout);
      transitionTimeout = window.setTimeout(hidePreloader, 12000);
    }

    function handoffToHome() {
      window.sessionStorage.setItem(handoffKey, String(Date.now()));
    }

    function continueFormSubmission(form, submitter) {
      window.setTimeout(function () {
        form.removeAttribute('data-rr-preloader-waiting');
        form.setAttribute('data-rr-preloader-continue', '');
        if (submitter && submitter.form === form) {
          form.requestSubmit(submitter);
        } else {
          form.requestSubmit();
        }
      }, Math.max(0, minimumPreloaderDuration - (Date.now() - visibleSince)));
    }

    if (showOnLoad) {
      if (document.readyState === 'complete') {
        window.requestAnimationFrame(hidePreloader);
      } else {
        window.addEventListener('load', hidePreloader, { once: true });
        loadTimeout = window.setTimeout(hidePreloader, 10000);
      }
    }

    document.addEventListener('click', function (event) {
      if (event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;

      var link = event.target.closest && event.target.closest('a[href]');
      if (!link || link.hasAttribute('download')) return;
      if ((link.getAttribute('href') || '').trim().charAt(0) === '#' && !link.hasAttribute('data-rr-page-preloader-home-handoff')) return;

      var target = link.getAttribute('target');
      if (target && target !== '_self') return;

      var destination = new URL(link.href, window.location.href);
      var goesHome = destination.origin === window.location.origin && destination.pathname.replace(/\/+$/, '') === '';
      var shouldShow = link.hasAttribute('data-rr-page-preloader-trigger');
      if (!shouldShow) {
        shouldShow = goesHome;
      }
      if (!shouldShow) return;

      event.preventDefault();
      if (goesHome || link.hasAttribute('data-rr-page-preloader-home-handoff')) handoffToHome();
      showPreloader(link.dataset.rrPreloaderMessage);

      var formId = link.dataset.rrPagePreloaderSubmitForm;
      window.setTimeout(function () {
        if (formId) {
          var form = document.getElementById(formId);
          if (form) form.submit();
          return;
        }
        window.location.assign(link.href);
      }, Math.max(0, minimumPreloaderDuration - (Date.now() - visibleSince)));
    });

    document.addEventListener('submit', function (event) {
      var form = event.target;
      if (event.defaultPrevented || !(form instanceof HTMLFormElement)) return;
      if (!form.matches('[data-rr-page-preloader]')) return;

      if (form.hasAttribute('data-rr-preloader-continue')) {
        form.removeAttribute('data-rr-preloader-continue');
        return;
      }
      if (form.hasAttribute('data-rr-preloader-waiting')) return;

      event.preventDefault();
      form.setAttribute('data-rr-preloader-waiting', '');
      var destination = new URL(form.action, window.location.href);
      if (destination.origin === window.location.origin && destination.pathname.replace(/\/+$/, '') === '/logout') handoffToHome();
      showPreloader(form.dataset.rrPreloaderMessage);
      continueFormSubmission(form, event.submitter);
    });

    window.addEventListener('pageshow', function (event) {
      if (event.persisted) hidePreloader();
    });
  }

  function start(button, label) {
    if (!button || button.disabled || button.dataset.rrLoading === 'true') return;

    button.dataset.rrLoading = 'true';
    button.dataset.rrOriginalHtml = button.innerHTML;
    button.disabled = true;
    button.setAttribute('aria-busy', 'true');
    button.classList.add('rr-is-loading');

    var spinner = document.createElement('span');
    spinner.className = 'rr-button-spinner';
    spinner.setAttribute('aria-hidden', 'true');

    var message = document.createElement('span');
    message.textContent = label || 'Processing…';

    button.replaceChildren(spinner, message);
  }

  function stop(button) {
    if (!button || button.dataset.rrLoading !== 'true') return;

    button.innerHTML = button.dataset.rrOriginalHtml || '';
    button.disabled = false;
    button.removeAttribute('aria-busy');
    button.classList.remove('rr-is-loading');
    delete button.dataset.rrLoading;
    delete button.dataset.rrOriginalHtml;
  }

  window.RRButtonLoading = { start: start, stop: stop };

  document.addEventListener('submit', function (event) {
    var form = event.target;
    if (!(form instanceof HTMLFormElement) || event.defaultPrevented) return;
    if (form.hasAttribute('data-rr-preloader-waiting')) return;
    if (form.matches('[data-loading="off"]') || form.method.toLowerCase() === 'get') return;

    var button = event.submitter || form.querySelector('button[type="submit"], button:not([type]), input[type="submit"]');
    if (!button || button.tagName !== 'BUTTON') return;

    start(button, button.dataset.loadingText || 'Processing…');
  });
})();
