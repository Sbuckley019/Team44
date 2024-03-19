export const numericOnlyDirective = {
    beforeMount(el) {
        el.addEventListener("keydown", (e) => {
            // Allow: backspace, delete, tab, escape, enter, and numeric keys
            if (
                [46, 8, 9, 27, 13].includes(e.keyCode) ||
                // Allow: Ctrl/cmd+A, Ctrl/cmd+C, Ctrl/cmd+X
                ((e.keyCode === 65 || e.keyCode === 67 || e.keyCode === 88) &&
                    (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)
            ) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress if not
            if (
                (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
                (e.keyCode < 96 || e.keyCode > 105)
            ) {
                e.preventDefault();
            }
        });
    },
};
