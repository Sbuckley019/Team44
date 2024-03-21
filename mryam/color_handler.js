
        // Function to set default mode
        function setDefaultMode() {
            document.body.classList.remove("high-contrast", "dark-mode", "color-blind");
        }

        // Function to set high contrast mode
        function setHighContrast() {
            document.body.classList.remove("dark-mode", "color-blind");
            document.body.classList.add("high-contrast");
        }

        // Function to set dark mode
        function setDarkMode() {
            document.body.classList.remove("high-contrast", "color-blind");
            document.body.classList.add("dark-mode");
        }

        // Function to set color blind mode
        function setColorBlindMode() {
            document.body.classList.remove("high-contrast", "dark-mode");
            document.body.classList.add("color-blind");
        }
