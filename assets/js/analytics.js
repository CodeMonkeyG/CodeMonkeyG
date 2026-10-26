(function (window, document) {
  'use strict';

  var siteName = 'codemonkeyg.com';

  function track(eventName, params) {
    var eventParams = Object.assign({ site_name: siteName }, params || {});
    if (typeof window.gtag === 'function') {
      window.gtag('event', eventName, eventParams);
    } else if (Array.isArray(window.dataLayer)) {
      window.dataLayer.push(Object.assign({ event: eventName }, eventParams));
    }
  }

  function trackLink(event) {
    var target = event.target;
    if (!(target instanceof Element)) return;

    var link = target.closest('a[href]');
    if (!link) return;

    var href = link.getAttribute('href') || '';
    if (href.indexOf('mailto:') === 0) track('contact_email_click', { link_type: 'email' });
    else if (/linkedin\.com/i.test(href)) track('linkedin_click', { link_type: 'social' });
    else if (/github\.com\/CodeMonkeyG/i.test(href)) track('github_click', { link_type: 'social' });
    else if (/\.pdf(?:$|\?)/i.test(href) && link.hasAttribute('download')) track('resume_download', { link_type: 'download' });
    else if (/(^|\/)blog(?:\/|$)/i.test(href)) track('blog_cta_click', { cta_location: 'site_navigation' });
  }

  function trackArticleRead() {
    var hasRead = false;
    var timer = window.setTimeout(emitRead, 30000);

    function emitRead() {
      if (hasRead) return;
      hasRead = true;
      window.clearTimeout(timer);
      window.removeEventListener('scroll', checkScroll);
      track('article_read', { content_type: 'article' });
    }

    function checkScroll() {
      var scrollable = document.documentElement.scrollHeight - window.innerHeight;
      if (scrollable > 0 && window.scrollY / scrollable >= 0.5) emitRead();
    }

    window.addEventListener('scroll', checkScroll, { passive: true });
    checkScroll();
  }

  document.addEventListener('click', trackLink);
  window.CodeMonkeyAnalytics = { track: track, trackArticleRead: trackArticleRead };
})(window, document);
