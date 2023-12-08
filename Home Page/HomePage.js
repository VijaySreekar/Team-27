const { innerHeight } = window;

const getRatio = (el) => innerHeight / (innerHeight + el.offsetHeight);

gsap.utils.toArray("section").forEach((section, i) => {
  section.bg = section.querySelector(".bg");

  gsap.fromTo(
    section.bg,
    {
      backgroundPosition: () =>
        i ? `50% ${-innerHeight * getRatio(section)}px` : "50% 0px",
    },
    {
      backgroundPosition: () =>
        `50% ${innerHeight * (1 - getRatio(section))}px`,
      ease: "none",
      scrollTrigger: {
        trigger: section,
        start: () => (i ? "top bottom" : "top top"),
        end: "bottom top",
        scrub: true,
      },
    }
  );
});

const navbar = document.querySelector("#navbar");

let lastScrollTop = 0;

window.addEventListener(
  "scroll",
  () => {
    console.log("scroll");
    var { pageYOffset } = window;
    if (pageYOffset > lastScrollTop) {
      // downward scroll
      navbar.classList.remove("visible");
    } else if (pageYOffset < lastScrollTop) {
      // upward scroll
      navbar.classList.add("visible");
    } // else was horizontal scroll
    lastScrollTop = pageYOffset <= 0 ? 0 : pageYOffset;
  },
  { passive: true }
);