try {
    ScrollReveal().reveal(".bottomToTopAnimation", {
        distance: "150%",
        origin: "bottom",
        opacity: 0.2,
        scale: 0.5,
    })

    ScrollReveal().reveal(".scale-in", {
        opacity: 0.2,
        scale: 0.5,
    })

    ScrollReveal().reveal(".leftToRightAnimation", {
        distance: "150%",
        origin: "left",
        opacity: 0.2,
        scale: 0.5,
    })

    ScrollReveal().reveal(".TopToBottomAnimation", {
        duration: 2000,
        origin: "top",
        distance: "50px",
    })

    ScrollReveal().reveal(".rotateYAnimation", {
        duration: 2000,
        rotate: {
            x: 1,
            y: 180,
        },
    })

    ScrollReveal().reveal(".bottomToTopRotateAnimation", {
        duration: 2000,
        origin: "bottom",
        distance: "100px",
        rotate: {
            x: 1,
            y: 180,
        },
    })
} catch (error) {
    // console.log("")
}
