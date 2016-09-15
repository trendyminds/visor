(function () {
  var overlayEnabled = false;
  var $button = document.querySelector('[data-craft-visor-toggle]');
  var $overlay = document.querySelector('[data-craft-visor-overlay]');
  var $close = document.querySelector('[data-craft-visor-close]');

  events();
  shortcutKeys();

  function events () {
    $button.addEventListener('click', checkVisorStatus);
    $close.addEventListener('click', closeOverlay);
  }

  function shortcutKeys () {
    document.onkeydown = function (evt) {
      evt = evt || window.event;
      var isEscape = false;
      var isToggle = false;
      var isOnBody = evt.target.tagName.toLowerCase() == 'body';
      var isOnButton = evt.target.tagName.toLowerCase() == 'button';

      if ('key' in evt) {
        isEscape = evt.key == 'Escape';
        isToggle = evt.key == '`';
      } else {
        isEscape = evt.keyCode == 27;
        isToggle = evt.keyCode == 192;
      }

      if (isEscape && (isOnBody || isOnButton)) {
        closeOverlay();
      }

      if (isToggle && (isOnBody || isOnButton)) {
        checkVisorStatus();
      }
    };
  }

  function checkVisorStatus () {
    if (overlayEnabled === true) {
      closeOverlay();
    } else {
      openOverlay();
    }
  }

  function openOverlay () {
    $overlay.classList.add('is-open');
    overlayEnabled = true;
  }

  function closeOverlay () {
    $overlay.classList.remove('is-open');
    overlayEnabled = false;
  }
})();
