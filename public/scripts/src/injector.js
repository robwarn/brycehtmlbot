document.addEventListener('DOMContentLoaded', function(){
  const _ = selector => document.querySelector(selector);
  const _All = selector => document.querySelectorAll(selector);
  let loadScript = (condition, path)  => {
    if (condition) {
      let script = document.createElement('script');
      script.type = 'text/javascript';
      script.src = DIST + '/' + path;
      document.body.appendChild(script);
    }
  }

}, false);
