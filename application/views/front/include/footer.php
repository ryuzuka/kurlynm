    <!-- s : footer -->
    <footer class="footer">
      <div class="inner">
        <h2 class="logo"><span class="blind">컬리넥스트마일</span></h2>
        <div class="footer-info">
          <div class="area">
            <address>본사 : 서울시 송파구 송파대로 55, A동 701호(장지동)</address>
            <span>대표자 : 송승환</span>
          </div>
          <div class="area">
            Tel : 1833-3165 (365일 08:00 ~ 17:00 운영)
            <span>Email : <a href="mailto:kurlynextmile_@kurlynextmile.com">kurlynextmile_@kurlynextmile.com</a></span>
          </div>
        </div>
        <div class="terms_conditions">
          <a href="/main/privacy">개인정보 처리방침</a>
          <span>
            <a href="/main/terms">택배표준약관</a>
          </span>
        </div>
        <p class="copyright">© Kurlynextmile. 2022. All rights reserved.</p>
      </div>
    </footer>
    
<!-- Channel Plugin Scripts -->
<script>
  (function() {
    var w = window;
    if (w.ChannelIO) {
      return (window.console.error || window.console.log || function(){})('ChannelIO script included twice.');
    }
    var ch = function() {
      ch.c(arguments);
    };
    ch.q = [];
    ch.c = function(args) {
      ch.q.push(args);
    };
    w.ChannelIO = ch;
    function l() {
      if (w.ChannelIOInitialized) {
        return;
      }
      w.ChannelIOInitialized = true;
      var s = document.createElement('script');
      s.type = 'text/javascript';
      s.async = true;
      s.src = 'https://cdn.channel.io/plugin/ch-plugin-web.js';
      s.charset = 'UTF-8';
      var x = document.getElementsByTagName('script')[0];
      x.parentNode.insertBefore(s, x);
    }
    if (document.readyState === 'complete') {
      l();
    } else if (window.attachEvent) {
      window.attachEvent('onload', l);
    } else {
      window.addEventListener('DOMContentLoaded', l, false);
      window.addEventListener('load', l, false);
    }
  })();
  ChannelIO('boot', {
    "pluginKey": "9824b33a-da39-4137-a2b5-c5da9566155f"
  });
</script>
<!-- End Channel Plugin -->    