import "./bootstrap";
import FormsAlpinePlugin from "../../vendor/filament/forms/dist/module.esm";
import NotificationsAlpinePlugin from "../../vendor/filament/notifications/dist/module.esm";
import Alpine from "alpinejs";
import focus from "@alpinejs/focus";
window.Alpine = Alpine;

Alpine.plugin(focus);
Alpine.plugin(FormsAlpinePlugin);
Alpine.plugin(NotificationsAlpinePlugin);

Alpine.data("otpInput", () => ({
    otp: ["", "", "", "", "", ""],

    onInput(index) {
        if (this.otp[index - 1] !== "") {
            focusNextInput(index);
        }
    },

    onKeydown(event, index) {
        if (event.key === "Backspace" && this.otp[index - 1] === "") {
            event.preventDefault();
            focusPrevInput(index);
        }
    },
}));

Alpine.start();
