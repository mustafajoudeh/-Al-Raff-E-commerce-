const root = document.documentElement;

document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebar-overlay");

    const toggleSidebar = (open) => {
        sidebar?.classList.toggle("open", open);
        if (overlay) overlay.hidden = !open;
    };

    document
        .getElementById("mobile-menu")
        ?.addEventListener("click", () => toggleSidebar(true));
    overlay?.addEventListener("click", () => toggleSidebar(false));
    sidebar
        ?.querySelectorAll("a")
        .forEach((link) =>
            link.addEventListener("click", () => toggleSidebar(false)),
        );

    document.querySelectorAll("[data-pending='true']").forEach((link) => {
        link.addEventListener("click", (event) => event.preventDefault());
    });

    document.getElementById("theme-toggle")?.addEventListener("click", () => {
        const next = root.dataset.theme === "dark" ? "light" : "dark";
        root.dataset.theme = next;
        try {
            localStorage.setItem("alraff-theme", next);
        } catch (e) {}
        document
            .querySelector('meta[name="theme-color"]')
            ?.setAttribute("content", next === "dark" ? "#130E11" : "#F6F3EE");
    });

    document.querySelectorAll("[data-toggle-password]").forEach((button) => {
        button.addEventListener("click", () => {
            const input = document.getElementById(
                button.dataset.togglePassword,
            );
            if (input)
                input.type = input.type === "password" ? "text" : "password";
        });
    });

    document.querySelectorAll(".toast-root .toast").forEach((toast) => {
        setTimeout(() => toast.remove(), 4000);
    });
});
