(() => {
  // If the browser does not support fetch, exit out (modern only!)
  const fetchSupport = "fetch" in window;

  if (!fetchSupport) {
    return false;
  }

  fetch("/actions/visor/default/access")
    .then((res) => {
      // Did we encounter a non 200 status code? If so, exit
      if (res.status !== 200) {
        return false;
      }

      // Proceed if the page ran
      return res.text();
    })
    .then((data) => {
      // Only output something to the page if we received data
      if (data) {
        document.body.insertAdjacentHTML("beforeend", data);
        import("./init").then((module) => new module.default());
      }
    });
})();
