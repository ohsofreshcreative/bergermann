document.querySelectorAll('.b-switcher .__nav').forEach((nav) => {
  let isDown = false;
  let dragged = false;
  let startX = 0;
  let scrollStart = 0;

  nav.addEventListener('mousedown', (e) => {
    isDown = true;
    dragged = false;
    startX = e.pageX;
    scrollStart = nav.scrollLeft;
  });

  nav.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    if (Math.abs(e.pageX - startX) > 5) dragged = true;
    nav.scrollLeft = scrollStart - (e.pageX - startX);
  });

  nav.addEventListener('mouseup', () => { isDown = false; });
  nav.addEventListener('mouseleave', () => { isDown = false; });

  // Blokujemy kliknięcie w zakładkę, jeśli użytkownik faktycznie przeciągał nav
  nav.addEventListener('click', (e) => {
    if (dragged) {
      e.stopImmediatePropagation();
      e.preventDefault();
    }
  }, true);

  // Po kliknięciu w zakładkę doprowadzamy ją w pełni do widoku
  nav.querySelectorAll('[role="tab"]').forEach((tab) => {
    tab.addEventListener('click', () => {
      tab.scrollIntoView({ behavior: 'smooth', inline: 'nearest', block: 'nearest' });
    });
  });
});
